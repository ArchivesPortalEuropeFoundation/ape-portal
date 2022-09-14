<?php
// load the api manager
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

require MODX_CORE_PATH . 'components/asi/fixtures/data/fixtures.php';

$allCountries = $fixtures['countrys'];
$selected_countries = $_REQUEST['countries'];

$countries = array();
foreach($selected_countries AS $k => $v) {
    $countries[$v] = $allCountries[$v];
}

$landscapes = asi::searchLandscapes($countries);

if(is_array($landscapes) AND count($landscapes) > 0) {

    $html = null;
    $items = null;

    foreach($landscapes AS $cK => $cV) {
        $country = explode(':', $cK);
        $countryLabel = $country[0];
        $countryLabel = trim($countryLabel);
        $countryLabel = strtolower($countryLabel);
        $countryLabel = str_replace("_", " ", $countryLabel);
        $countryLabel = ucwords($countryLabel);
        // item(s)
//        var_dump($landscapes[$cK]['landscapes'][$cK]);
        foreach($landscapes[$cK]['landscapes'][$cK] AS $lK => $lV) {
            $landscape = explode(':', $lV);
            $country = implode(':', $landscapes[$cK]['country']);
            $items .= $modx->getChunk("asi_institution_landscape_item", array(
                'country_name' => $countryLabel,
                'country_id' => $cK,
                'landscape_name' => $landscape[0],
                'landscape_id' => $lV,
                'items'=>$items,
            ));
        }

        // set
        $html.=$modx->getChunk("asi_institution_landscape_set", array(
            'country_name' => $countryLabel,
            'country_id' => $cK,
            'items' => $items,
        ));
        $items = null;
    }
    return $html;
}
else {
    return "<p>No landscapes found</p>";
}