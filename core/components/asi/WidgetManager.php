<?php

/**
 * Data for the embeddable search widget (resource widget/search/) and its
 * code builder on the Tools > Search widget page.
 *
 * Reads the Solr cores directly, like the rest of the ASI search:
 * - eags (solr_core_inst): institution name, repository code, country
 * - ead3s (solr_core_archives): number of finding aids, holding guides and
 *   source guides, and the latest finding aids of an institution
 *
 * Results are cached for an hour, because the widget is public and can be
 * embedded on many sites.
 *
 * @package    GEL ASI
 */

namespace asi;

class WidgetManager
{
    const CACHE_PARTITION = 'asi_widget';
    const CACHE_TTL = 3600;
    const SOLR_TIMEOUT = 5;

    /** @var \MODX\Revolution\modX */
    protected $modx;

    /** @var \Apache_Solr_Service[] */
    protected $solr = [];

    public function __construct($modx)
    {
        $this->modx = $modx;
    }

    /**
     * Institution by numeric id (aiId) or repository code.
     *
     * @return array|null [id, repositoryCode, name, country] or null if not found / Solr unavailable
     */
    public function getInstitution(?int $aiId, ?string $repositoryCode = null): ?array
    {
        if ($aiId !== null && $aiId > 0) {
            $fq = 'id:' . $aiId;
        } elseif ($repositoryCode !== null && $repositoryCode !== '') {
            $fq = 'repositoryCode:' . AsiManager::escapeSolrValue($repositoryCode);
        } else {
            return null;
        }

        return $this->cached('inst_' . md5($fq), function () use ($fq) {
            $response = $this->query($this->modx->getOption('solr_core_inst'), 1, [
                'fq' => [$fq],
                'fl' => 'id,repositoryCode,name,country',
            ]);
            if ($response === null) {
                return null;
            }
            if (empty($response->response->docs)) {
                return $this->getInstitutionFromArchives($fq);
            }
            $doc = $response->response->docs[0];
            return [
                'id' => (int) $doc->id,
                'repositoryCode' => (string) $doc->repositoryCode,
                'name' => (string) $doc->name,
                'country' => (string) $doc->country,
            ];
        });
    }

    /**
     * Fallback when the institution has archival material but no document in the institutions core:
     * name and id from the "ai" field ("Name:aiId") of one of its archives.
     */
    protected function getInstitutionFromArchives(string $instFq): ?array
    {
        // the institutions core uses "id", the archives core "aiId"
        $fq = strpos($instFq, 'id:') === 0 ? 'aiId:' . substr($instFq, 3) : $instFq;
        $response = $this->query($this->modx->getOption('solr_core_archives'), 1, [
            'fq' => [$fq],
            'fl' => 'ai,aiId,repositoryCode,country',
        ]);
        if ($response === null || empty($response->response->docs)) {
            return null;
        }
        $doc = $response->response->docs[0];
        $ai = (string) $doc->ai;
        $pos = strrpos($ai, ':');
        $id = $pos !== false ? (int) substr($ai, $pos + 1) : 0; // aiId is indexed but not stored
        if ($id <= 0) {
            return null;
        }
        return [
            'id' => $id,
            'repositoryCode' => (string) $doc->repositoryCode,
            'name' => $pos !== false ? substr($ai, 0, $pos) : $ai,
            'country' => (string) ($doc->country ?? ''),
        ];
    }

    /**
     * Number of finding aids, holding guides and source guides of an institution
     * (top-level documents only), and the value of the "ai" facet that the
     * advanced search uses as institution filter ("Name:aiId").
     *
     * @return array|null [fa, hg, sg, ai_filter]
     */
    public function getStats(int $aiId): ?array
    {
        return $this->cached('stats_' . $aiId, function () use ($aiId) {
            $response = $this->query($this->modx->getOption('solr_core_archives'), 0, [
                'fq' => ['aiId:' . $aiId, 'levelName:archdesc'],
                'facet' => 'true',
                'facet.field' => ['recordType', 'ai'],
                'facet.mincount' => 1,
                'facet.limit' => 10,
            ]);
            if ($response === null) {
                return null;
            }
            $stats = ['fa' => 0, 'hg' => 0, 'sg' => 0, 'ai_filter' => null];
            $fields = $response->facet_counts->facet_fields ?? null;
            if ($fields) {
                foreach (($fields->recordType ?? []) as $type => $count) {
                    if (array_key_exists($type, $stats)) {
                        $stats[$type] = (int) $count;
                    }
                }
                foreach (($fields->ai ?? []) as $value => $count) {
                    // there is only one value for one aiId
                    $stats['ai_filter'] = (string) $value;
                    break;
                }
            }
            return $stats;
        });
    }

    /**
     * Latest finding aids of an institution, by Solr index time (timestamp).
     *
     * @return array|null list of [id, recordId, title, unitId, repositoryCode, date]
     */
    public function getRecentFindingAids(int $aiId, int $limit = 5): ?array
    {
        return $this->cached('recent_' . $aiId . '_' . $limit, function () use ($aiId, $limit) {
            $response = $this->query($this->modx->getOption('solr_core_archives'), $limit, [
                'fq' => ['aiId:' . $aiId, 'recordType:fa', 'levelName:archdesc'],
                'sort' => 'timestamp desc',
                'fl' => 'id,recordId,unitTitle,unitId,repositoryCode,timestamp',
            ]);
            if ($response === null) {
                return null;
            }
            $items = [];
            foreach ($response->response->docs as $doc) {
                $items[] = [
                    'id' => (string) $doc->id,
                    'recordId' => (string) $doc->recordId,
                    'title' => (string) ($doc->unitTitle ?? $doc->recordId),
                    'unitId' => (string) ($doc->unitId ?? ''),
                    'repositoryCode' => (string) $doc->repositoryCode,
                    'date' => isset($doc->timestamp) ? substr((string) $doc->timestamp, 0, 10) : '',
                ];
            }
            return $items;
        });
    }

    /**
     * All institutions with searchable content, sorted by name (for the code builder).
     *
     * @return array list of [id, name, country]
     */
    public function getInstitutionList(): array
    {
        $list = $this->cached('inst_list', function () {
            $response = $this->query($this->modx->getOption('solr_core_inst'), 100000, [
                'fq' => ['hasSearchableContent:true'],
                'fl' => 'id,name,country',
                'sort' => 'name asc',
            ]);
            if ($response === null) {
                return null;
            }
            $items = [];
            foreach ($response->response->docs as $doc) {
                $items[] = [
                    'id' => (int) $doc->id,
                    'name' => (string) $doc->name,
                    'country' => (string) $doc->country,
                ];
            }
            return $items;
        });
        return $list ?? [];
    }

    /**
     * Country label from a Solr value such as "NETHERLANDS:G:7"
     * (lexicon topic asi:solr must be loaded).
     */
    public function countryLabel(string $solrCountry): string
    {
        $key = explode(':', $solrCountry)[0];
        if ($key === '') {
            return '';
        }
        $label = $this->modx->lexicon('asi.' . $key);
        return ($label === 'asi.' . $key) ? AsiManager::cleanLabel($solrCountry) : $label;
    }

    protected function query(string $core, int $rows, array $params)
    {
        try {
            return $this->getSolr($core)->search('*:*', 0, $rows, $params);
        } catch (\Exception $e) {
            $this->modx->log(\xPDO\xPDO::LOG_LEVEL_ERROR, '[asi widget] Solr query on ' . $core . ' failed: ' . $e->getMessage());
            return null;
        }
    }

    protected function getSolr(string $core): \Apache_Solr_Service
    {
        if (!isset($this->solr[$core])) {
            require_once __DIR__ . '/lib/solr-php/Apache/Solr/Service.php';
            $solr = new \Apache_Solr_Service(
                $this->modx->getOption('solr_address'),
                $this->modx->getOption('solr_port'),
                '/solr/' . $core . '/'
            );
            $solr->setDefaultTimeout(self::SOLR_TIMEOUT);
            $this->solr[$core] = $solr;
        }
        return $this->solr[$core];
    }

    /**
     * Cache wrapper. Failed lookups (null) are not cached, so that the widget
     * recovers as soon as Solr is back.
     */
    protected function cached(string $key, callable $loader)
    {
        $options = [\xPDO\xPDO::OPT_CACHE_KEY => self::CACHE_PARTITION];
        $cache = $this->modx->getCacheManager();
        $value = $cache->get($key, $options);
        if ($value !== null) {
            return $value['data'];
        }
        $data = $loader();
        if ($data !== null) {
            $entry = ['data' => $data]; // set() takes the value by reference
            $cache->set($key, $entry, self::CACHE_TTL, $options);
        }
        return $data;
    }
}
