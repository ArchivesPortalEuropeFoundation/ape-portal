<?php
// load the api manager
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

$entity = "countries";

// check for existing setting
$selecteds = asi::getSelectedFilterValue($entity);
//var_dump($selecteds);

// load items
//$results = asi::query($entity);

$xml_countries = array(
    "Austria" => "AU",
    "Belgium" => "BE",
    "Bulgaria" => "BG",
    "Croatia" => "HR",
    "Cyprus" => "CY",
    "Czechia" => "CZ",
    "Denmark" => "DK",
    "Estonia" => "EE",
    "Finland" => "FI",
    "France" => "FR",
    "Germany" => "DE",
    "Greece" => "GR",
    "Hungary" => "HU",
    "Ireland" => "IE",
    "Italy" => "IT",
    "Latvia" => "LV",
    "Lithuania" => "LT",
    "Luxembourg" => "LU",
    "Malta" => "MT",
    "Netherlands" => "NL",
    "Poland" => "PL",
    "Portugal" => "PT",
    "Romania" => "RO",
    "Slovakia" => "SK",
    "Slovenia" => "SI",
    "Spain" => "ES",
    "Sweden" => "SE",
    "United Kingdom" => "GB"
);

$solr_countries = ["AUSTRIA:G:30", "BELGIUM:G:8", "BULGARIA:G:17", "CROATIA:G:37", "CZECH_REPUBLIC:G:18", "ESTONIA:G:19", "FINLAND:G:14", "FRANCE:G:2", "GEORGIA:G:41", "GERMANY:G:3", "GREECE:G:4", "HUNGARY:G:22", "ICELAND:G:25", "IRELAND:G:10", "ISLE_OF_MAN:G:43", "ITALY:G:34", "LATVIA:G:11", "LITHUANIA:G:35", "LUXEMBOURG:G:26", "MALTA:G:12", "MULTINATIONAL_INSTITUTIONS:G:42", "NETHERLANDS:G:7", "NORWAY:G:33", "POLAND:G:5", "PORTUGAL:G:13", "ROMANIA:G:36", "SLOVAKIA:G:32", "SLOVENIA:G:9", "SPAIN:G:1", "SWEDEN:G:6", "SWITZERLAND:G:28", "UNITED_KINGDOM:G:27"];

//echo "<pre>".print_r($results, 1)."</pre>";

/*
 *
 * XML
 *
$tpl = ( isset($country_tpl) ) ? $country_tpl : "asi_institution_country_item";
$html = null;
foreach($countries AS $k => $v) {
    //$selected = (in_array($i['value'], $selecteds))?true:false; @todo
    //echo $i['value']. ": ".$selected;
    $html.=$modx->getChunk($tpl, array(
        'country_name' => $k,
        'country_id' => $v,
    ));
}
*/


// SOLR
$tpl = ( isset($country_tpl) ) ? $country_tpl : "asi_institution_country_item";
$html = null;
foreach($solr_countries AS $k => $v) {

    $parts = explode(":", $v);
    $label = $parts[0];
    $label = trim($label);
    $label = strtolower($label);
    $label = str_replace("_", " ", $label);
    $label = ucwords($label);

    $html.=$modx->getChunk($tpl, array(
        'country_name' => $label,
        'country_id' => $v,
    ));
}

return $html;