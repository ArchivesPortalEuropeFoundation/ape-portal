<?php
/**
 * Gel Studios Ape API date helper
 *
 * This helper takes an 'entity' var and queries the API for it
 * checks the user for existing settings and adds JS for more if
 * there are lots of results
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     Gel Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 * @param      string $entity the name of the entity to be queried
 * @param      string $label (optional) override for entity label
 * @return     string $html the output html, registers footer JS
 */

// load the api manager
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

// load items and check if lots
$results = asi::query($entity);

//echo "<pre>".print_r($results, 1)."</pre>";

// populate label / identifier etc...
$label = (isset($label)) ? $label : ucfirst($entity);
$identifier = strtolower(str_replace(" ", "_", $entity));

// check for tip id
$tip_id = (isset($tip_id)) ? $tip_id : $identifier;

// check for existing setting
$selecteds = asi::getSelectedFilterValue($identifier);
//var_dump($selecteds);

// for a date query, we get 4 sets of results for the filters
// lets loop through them and populate each set of check boxes
$options = array();
foreach($results AS $period => $value) {

    $lots = (count($results[$period]) > 8) ? true : false;

    if($lots == true) { // if lots then split the array
        $items = array_slice($results[$period], 0,8);
        $more_items = array_slice($results[$period],8);
    } else {
        $items = $results[$period];
    }

    $options[$period] = null;

    // populate the options
    foreach($items AS $item) {
        $tpl = ( isset($select_tpl) ) ? $select_tpl : "asi_search_select_option";
        $selected = (in_array($item, $selecteds))?true:false;
        $options[$period] .= $modx->getChunk($tpl, array(
            'name'       => $item,
            'value'      => $item,
            'selected'   => $selected,
            'filter_type'       => 'date_range',
            'filter_field'      => $identifier,
            'filter_value'      => $item,
        ));
    }

    // populate more options (if applicable)
    $more_options[$period] = null;
    if($lots == true) {
        // populate option rows
        $tpl = ( isset($more_option_tpl) ) ? $more_option_tpl : "asi_search_select_option";
        foreach($more_items AS $i) {
            $selected = (in_array($i, $selecteds))?true:false;
            $more_options[$period].=$modx->getChunk($tpl, array(
                'name'       => $i,
                'value'      => $i,
                'selected'   => $selected,
                'filter_type'       => 'date_range',
                'filter_field'      => $identifier,
                'filter_value'      => $i,
            ));
        }
    }
}

//echo "<pre>".print_r($options, 1)."</pre>";

// populate the checkbox sets...

$sets = array(
    "centuries" => "Century",
    "decades" => "Decade",
    "years" => "Year",
    "months" => "Month"
);

$tpl = ( isset($select_tpl) ) ? $select_tpl : "asi_search_date_set"; // you could extend this for the keys
foreach($sets AS $key => $val) {
    //$options = (isset($options[$key]))?$options[$key]:null;
    //$more_options = (isset($more_options[$key]))?$more_options[$key]:null;
    $varName = "set_".$key;

    //echo "HERE [$key] ".var_dump($options[$key]);

    $$varName = $modx->getChunk($tpl, array(
        'options'       => $options[$key],
        'lots'          => (strlen($more_options[$key]) > 0)?true:false,
        'more_options'  => $more_options[$key],
        'label'         => $val,
        'enabled'       => true
    ));
}

// populate the container
$tpl = ( isset($select_tpl) ) ? $select_tpl : "asi_search_date";
$html = $modx->getChunk($tpl, array(
    'label'       => $label,
    'set_century' => $set_centuries,
    'set_decade' => $set_decades,
    'set_year' => $set_years,
    'set_month' => $set_months,
    'identifier' => $identifier,
    'tip_id' => $tip_id,
));

// add ajax triggers
$triggers = <<<hereDoc123

<script>

$(document).ready(function(){
    $('[data-g="search-date-%s"] input[type="checkbox"]').click(function(){
       updateSearchResults();
    });
});

</script>

hereDoc123;
    
$triggersJs = sprintf($triggers, $identifier);
$modx->regClientHTMLBlock(GelTools::minifyJs($triggersJs));

return $html;