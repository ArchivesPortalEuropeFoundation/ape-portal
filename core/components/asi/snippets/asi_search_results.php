<?php
/**
 * Gel Studios Ape API results processor (ajax)
 *
 * This helper takes a term and query parameters and returns
 * retuits
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     Gel Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 * @param      string $term the term to be queried
 * @param      array $criteria (optional)
 * @return     string $html the output html, registers footer JS
 */

// (global scope)
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;

// for dev we can spoof solr data as we can't connect locally...
if($modx->getOption('search_spoof_solr') == 1) {

    $sample_base = MODX_CORE_PATH . 'components/asi/samples/solr/';

    switch ($_REQUEST['section']) {
        case "search-in-names":
            $filename = "sample_response_names.json";
            break;
        case "search-in-institutions":
            $filename = "sample_response_institutions.json";
            break;
        default: // search-in-archives
            $filename = "sample_response_archives.json";
            break;
    }

    $path = $sample_base.$filename;

    if(!file_exists($path)) {
        throw new \Exception("Can't find sample solr results file ".$path);
        exit();
    }
    header('Content-Type: application/json');
    $file = file_get_contents($path);
    echo $file;
}
else {
    $lang         = $_REQUEST['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
    $modx->lexicon->load($lang.':asi:solr');
    asi::init($modx);

    $params = asi::buildParams($_REQUEST);
    $results = asi::fetchResults($params);
    $filters = asi::fetchFiltersFromResults($params);

    $html = null;
    $aid_html = null;
    $checks = null;

    switch ($_REQUEST['section']) {
        case "search-in-names":
            foreach ($results AS $r) {
                $relatedHtml = '';
                if($r['material_count'] > 0 || $r['name_count'] > 0) {
                    $relatedHtml .= "<p><strong>[[!%asi.title_is_related_to? &topic=`default` &namespace=`asi`]]:</strong>";
                    if($r['material_count'] > 0) {
                        $relatedHtml .= "[[!+material_count]] archival material(s)";
                    }
                    if($r['material_count'] > 0 && $r['name_count'] > 0) {
                        $relatedHtml .= ' - ';
                    }
                    if($r['name_count'] > 0) {
                        $relatedHtml .= "[[!+name_count]] [[!%asi.title_names? &topic=`default` &namespace=`asi`]]";
                    }
                    $relatedHtml .= "</p>";
                }

                $nameType = $r['entityTypeFacet'];
                $nameIcon = 'fa-landmark';
                if($nameType === 'person') {
                    $nameIcon = 'fa-user';
                }
                if($nameType === 'family') {
                    $nameIcon = 'fa-users';
                }
                $instituteArray = explode(':',$r['institution_value']);
                $instituteName = $instituteArray[0];
                $countryName = $modx->lexicon('asi.'.$r['country_value']);
                $html .= $modx->getChunk("asi_search_result_name_list", array(
                    'record_id' => $r['recordId'],
                    'id' => $r['id'],
                    'term' => $r['matching_term'],
                    'name' => $r['sample_name_value'],
                    'date' => $r['date_display_value'],
                    'date_type' => $r['dateType'],
                    'description' => $r['description_value'],
                    'country' => $r['country_value'],
                    'country_name' => $countryName,
                    'other' => $r['other_value'],
                    "code" => $r['code_value'],
                    "material_count" => $r['material_count'],
                    "name_count" => $r['name_count'],
                    "related_chunk" => $relatedHtml,
                    'institution' => $r['institution_value'],
                    'institution_name' => $instituteName,
                    'name_icon' => $nameIcon,
                    'name_description' => $nameType
                ));
            }
            break;
        case "search-in-institutions":
            foreach ($results AS $r) {
                // transform the country 
                $c = explode(":",$r['country_value']);
                $country = $c[0];
                $html .= $modx->getChunk("asi_search_result_institution_list", array(
                    'id' => $r['id'],
                    'term' => $r['matching_term'],
                    'name' => $r['institution_value'],
                    'country' => $country,
                    'archive_type' => ucwords(ASI::camelToSpace($r['type_value'])),
                    'date' => $r['date_display_value'],
                    'description' => $r['description_value'],
                    'image' => $r['image_value'],
                    'digital' => $r['digital_value'],
                    'address' => $r['address_value'],
                    'code' => $r['code_value'],
                    'searchable_content' => $r['hasSearchableContent']
                ));

                
                $checks.=$modx->getChunk("asi_search_result_institution_checkbox", array(
                    'id' => $r['id'],
                    'name' => $r['institution_value'],
                    'country' => $r['country_value'], // Unsure if this is needed, keeping incase
                    'country_split' => $country ,
                ));
            }
            break;
        default: // search-in-archives

            foreach ($results AS $r) {
                if ($r['levelName'] == 'archdesc'){
                    $extraCLevelIdPart = '';
                }
                else {
                    if (isset($r['reference_value']) && $r['reference_value']!=null) {
                        $idField = 'unitid';
                        $clevelId = $r['reference_value'];
                    }
                    else {
                        $idField = 'dbid';
                        $clevelId = $r['id'];
                    }
                    $extraCLevelIdPart = '/' . $idField . '/' . $clevelId;
                }

                $html .= $modx->getChunk("asi_search_result_archive_list", array(
                    'type'=>'Hitting Here',
                    'id' => $r['id'],
                    'fa_id' => $r['recordId'],
                    'term' => $r['matching_term'],
                    'title' => $r['title_value'],
                    'reference' => $r['reference_value'],
                    'date' => $r['date_display_value_archive'],
                    'description' => $r['description_value'],
                    'image' => $r['image_value'],
                    'digital' => $r['digital_value'],
                    'country' => asi::cleanLabel($r['country_value']),
                    'institution' => asi::cleanLabel($r['institution_value']),
                    'link_term' => urlencode($r['matching_term']),
                    'link_data' => "&t=" . urlencode($r['recordType']) . "&recordId=" . urlencode($r['recordId']) . (substr( $r['id'], 0, 1 ) === "C" ? ("&c=" . urlencode($r['id'])) : ""),
                    "dao" => $r['dao'],
                    "daoType" => $r['daoType'],
                    "fa_title" => asi::cleanLabel($r['description_value']),
                    "extract" => asi::highlightTermInExtract($r['scopeContent'], $_REQUEST['term']),
                    'other_value' => asi::highlightTermInExtract($r['other_value'], $_REQUEST['term']),
                    'code' => $r['code_value'],
                    'levelName' => $r['levelName'],
                    'recordId' => urlencode($r['recordId']),
                    'recordType' => urlencode($r['recordType']),
                    'referenceId'=> urlencode($r['reference_value']),
                    'extraCLevelIdPart'=> $extraCLevelIdPart
                ));

                $aid_html .= $modx->getChunk("asi_search_result_archive_context", array(
                    'id' => $r['id'],
                    'fa_id' => $r['recordId'],
                    'term' => $r['matching_term'],
                    'title' => $r['title_value'],
                    'reference' => $r['reference_value'],
                    'date' => $r['date_display_value'],
                    'description' => $r['description_value'],
                    'image' => $r['image_value'],
                    'digital' => $r['digital_value'],
                    'country' => $r['country_value'],
                    'institution' => $r['institution_value'],
                    'link_term' => urlencode($r['matching_term']),
                    'link_data' => "&t=" . urlencode($r['recordType']) . "&recordId=" . urlencode($r['recordId']) ."&c=" . urlencode($r['id']),
                ));
            }
            break;
    }

    //Due to the curated nature of these filters where some are directly from SOLR and others require custom curated titles,
    // we handle them individually below for custom items.

    $translatedTopics = array();
    foreach($filters['topics'] as $topic => $topicCount) {
        $translated = $modx->lexicon('asi.'.$topic);
        $translatedTopics[$topic]['translated'] = $translated;
        $translatedTopics[$topic]['count'] = $topicCount;
    }
    if($translatedTopics) {
        $filters['topics'] = $translatedTopics;
    }
    
    $translatedCountries = array();
    foreach($filters['countries'] as $country => $countryCount) {
        $pos = strpos($country, ':');
        $countryKey = substr($country, 0, $pos);
        $translated = $modx->lexicon('asi.'.$countryKey);
        $translatedCountries[$country]['translated'] = $translated;
        $translatedCountries[$country]['count'] = $countryCount;
    }
    if($translatedCountries) {
        $filters['countries'] = $translatedCountries;
    }

    $translatedLevels = array();
    foreach($filters['levels'] as $level => $levelCount) {
        $translated = $modx->lexicon('asi.'.$level);
        $translatedLevels[$level]['translated'] = $translated;
        $translatedLevels[$level]['count'] = $levelCount;
    }
    if($translatedLevels) {
        $filters['levels'] = $translatedLevels;
    }

    $translatedTypes = array();
    foreach($filters['types'] as $type => $typeCount) {
        $translated = $modx->lexicon('asi.'.$type);
        $translatedTypes[$type]['translated'] = $translated;
        $translatedTypes[$type]['count'] = $typeCount;
    }
    if($translatedTypes) {
        $filters['types'] = $translatedTypes;
    }

    $translatedDigitalTypes = array();
    foreach($filters['digitaltypes'] as $digitalType => $digitalTypeCount) {
        $translated = $modx->lexicon('asi.'.$digitalType);
        $translatedDigitalTypes[$digitalType]['translated'] = $translated;
        $translatedDigitalTypes[$digitalType]['count'] = $digitalTypeCount;
    }
    if($translatedDigitalTypes) {
        $filters['digitaltypes'] = $translatedDigitalTypes;
    }

    $translatedRepositoryTypeFacets = array();
    foreach($filters['repositoryTypeFacet'] as $typeFacet => $typeFacetCount) {
        $translated = $modx->lexicon('asi.'.$typeFacet);
        $translatedRepositoryTypeFacets[$typeFacet]['translated'] = $translated;
        $translatedRepositoryTypeFacets[$typeFacet]['count'] = $typeFacetCount;
    }
    if($translatedRepositoryTypeFacets) {
        $filters['repositoryTypeFacet'] = $translatedRepositoryTypeFacets;
    }

    $translatedDatetypes = array();
    foreach($filters['datetypes'] as $dateType => $dateTypeCount) {
        $translated = $modx->lexicon('asi.'.$dateType);
        $translatedDatetypes[$dateType]['translated'] = $translated;
        $translatedDatetypes[$dateType]['count'] = $dateTypeCount;
    }
    if($translatedDatetypes) {
        $filters['datetypes'] = $translatedDatetypes;
    }

    $translatedEntityTypeFacets = array();
    foreach($filters['entityTypeFacet'] as $entityTypeFacet => $entityTypeFacetCount) {
        $translated = $modx->lexicon('asi.'.$entityTypeFacet);
        $translatedEntityTypeFacets[$entityTypeFacet]['translated'] = $translated;
        $translatedEntityTypeFacets[$entityTypeFacet]['count'] = $entityTypeFacetCount;
    }
    if($translatedDatetypes) {
        $filters['entityTypeFacet'] = $translatedEntityTypeFacets;
    }

    $translatedLanguages = array();
    foreach($filters['language'] as $language => $languageCount) {
        $translated = $modx->lexicon('asi.'.$language);
        $translatedLanguages[$language]['translated'] = $translated;
        $translatedLanguages[$language]['count'] = $languageCount;
    }
    if($translatedDatetypes) {
        $filters['language'] = $translatedLanguages;
    }
    
    $response = array(
        "filters" => $filters,
        "results" => $html,
        "checks" => $checks,
        "aids" => $aid_html,
        "count" => asi::getCount(),
        "start" => asi::getStart(),
        "end" => asi::getEnd(),
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}