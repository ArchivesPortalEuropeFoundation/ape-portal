<?php
/**
 * asi_widget
 *
 * Renders the embeddable search widget (resource widget/search/, shown in an iframe on other sites).
 *
 * GET parameters:
 * - ai             numeric id of an archival institution (optional)
 * - repositoryCode repository code of an archival institution, used if "ai" is not given (optional)
 * - recent         1 = also show the latest finding aids of the institution
 *
 * Without a (known) institution the widget shows the general search of the portal.
 * All links and the search form open the portal in a new tab.
 */
require_once MODX_CORE_PATH . 'components/asi/autoload.php';

use asi\WidgetManager;

$lang = $modx->getOption('cultureKey') ?: 'en';
$modx->lexicon->load($lang . ':asi:default', $lang . ':asi:solr');

$widget = new WidgetManager($modx);
$recentLimit = 5;

$aiParam = isset($_GET['ai']) ? trim((string) $_GET['ai']) : '';
$repoParam = isset($_GET['repositoryCode']) ? trim((string) $_GET['repositoryCode']) : '';
$showRecent = isset($_GET['recent']) && (string) $_GET['recent'] === '1';

$institution = null;
if ($aiParam !== '' && ctype_digit($aiParam) && strlen($aiParam) <= 10) {
    $institution = $widget->getInstitution((int) $aiParam);
} elseif ($repoParam !== '' && preg_match('/^[A-Za-z0-9._\-]{1,64}$/', $repoParam)) {
    $institution = $widget->getInstitution(null, $repoParam);
}

// HTML escaping. Square brackets, braces and backticks are encoded too, so that values from Solr
// (names and titles from content providers) can never be parsed as MODX tags.
$e = function ($value) {
    $html = htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return str_replace(['[', ']', '{', '}', '`'], ['&#91;', '&#93;', '&#123;', '&#125;', '&#96;'], $html);
};
// URLs from makeUrl(): already contain &amp; when xhtml_urls is on, so existing entities are kept
$u = function ($url) {
    $html = htmlspecialchars((string) $url, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);
    return str_replace(['[', ']', '`'], ['&#91;', '&#93;', '&#96;'], $html);
};
$siteStart = (int) $modx->getOption('site_start', null, 1);
$searchId = 50; // advanced-search/search-in-archives/
$archiveDetailId = 60; // advanced-search/search-in-archives/results-(archives)/
$institutionDetailId = 62; // advanced-search/search-in-institutions/results-(institutions)/

$placeholders = [
    'home_url' => $u($modx->makeUrl($siteStart, 'web', '', 'full')),
    'logo_url' => $e($modx->getOption('site_url') . 'assets/images/logo.jpg'),
    'search_url' => $u($modx->makeUrl($searchId, 'web', '', 'full')),
    'search_hidden' => '',
    'search_placeholder' => $e($modx->lexicon('asi.search_archives_portal_europe')),
    'institution' => '',
    'recent' => '',
    'mode' => 'general',
];

if ($institution) {
    $placeholders['mode'] = 'institution';
    $stats = $widget->getStats($institution['id']);
    $aiFilter = $stats['ai_filter'] ?? null;

    // Search only in this institution: same filter as the institution facet of the advanced search
    if ($aiFilter) {
        $placeholders['search_hidden'] = '<input type="hidden" name="institutions[]" value="' . $e($aiFilter) . '">';
        $placeholders['search_placeholder'] = $e($modx->lexicon('asi.widget_search_institution'));
    }

    $statItems = '';
    foreach (['fa' => 'asi.finding_aids', 'hg' => 'asi.holding_guides', 'sg' => 'asi.source_guides'] as $type => $labelKey) {
        $count = (int) ($stats[$type] ?? 0);
        $label = $e($modx->lexicon($labelKey));
        $number = $e(number_format($count, 0, '.', ','));
        if ($count > 0 && $aiFilter) {
            $url = $modx->makeUrl($searchId, 'web', 'term=&institutions[]=' . rawurlencode($aiFilter) . '&types[]=' . $type, 'full');
            $statItems .= '<li><a href="' . $u($url) . '" target="_blank" rel="noopener"><span class="apew-count">' . $number . '</span><span class="apew-label">' . $label . '</span></a></li>';
        } else {
            $statItems .= '<li><span class="apew-stat"><span class="apew-count">' . $number . '</span><span class="apew-label">' . $label . '</span></span></li>';
        }
    }

    $placeholders['institution'] = $modx->getChunk('asi_widget_institution', [
        'name' => $e($institution['name']),
        'country' => $e($widget->countryLabel($institution['country'])),
        'url' => $u($modx->makeUrl($institutionDetailId, 'web', ['repositoryCode' => $institution['repositoryCode']], 'full')),
        'stats' => $statItems,
    ]);

    if ($showRecent) {
        $items = '';
        foreach (($widget->getRecentFindingAids($institution['id'], $recentLimit) ?? []) as $fa) {
            $url = $modx->makeUrl($archiveDetailId, 'web', [
                'repositoryCode' => $fa['repositoryCode'],
                'term' => '',
                'levelName' => 'archdesc',
                't' => 'fa',
                'recordId' => $fa['recordId'],
                'c' => $fa['id'],
            ], 'full');
            $items .= $modx->getChunk('asi_widget_recent_item', [
                'url' => $u($url),
                'title' => $e($fa['title']),
                'reference' => $e($fa['unitId']),
            ]);
        }
        if ($items !== '') {
            $placeholders['recent'] = '<section class="apew-recent" aria-labelledby="apew-recent-title">'
                . '<h3 id="apew-recent-title">' . $e($modx->lexicon('asi.widget_latest_finding_aids')) . '</h3>'
                . '<ol>' . $items . '</ol></section>';
        }
    }
}

return $modx->getChunk('asi_widget', $placeholders);