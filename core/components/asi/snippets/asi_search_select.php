<?php
/**
 * Gel Studios Ape API select helper
 *
 * This helper takes an 'entity' var and queries the API for it
 * checks the user for existing settings and adds JS for search
 * etc if there are lots of results
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
/**
 * Gel Studios Ape API select helper
 *
 * This helper takes an 'entity' var and queries the API for it
 * checks the user for existing settings and adds JS for search
 * etc if there are lots of results
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

// populate label / identifier etc...
$label = (isset($label)) ? $label : ucfirst($entity);
$identifier = $entity;
//$identifier = strtolower(str_replace(" ", "_", $entity));

// check for tiptitle
if(!isset($tiptitle)) $tiptitle = true;

// check for tip id
$tip_id = (isset($tip_id)) ? $tip_id : $identifier;

// check for exclusive selection
$exclusive = (isset($exclusive)) ? true : false;

// check for existing setting
$selecteds = asi::getSelectedFilterValue($identifier);
//var_dump($selecteds);

// load items and check if lots
$results = asi::query($entity);
$lots = (count($results) > 8) ? true : false;

if($lots == true) { // if lots then split the array
    $items = array_slice($results, 0,8);
    $more_items = array_slice($results,8);
} else {
    $items = $results;
}

// populate option rows
$tpl = ( isset($option_tpl) ) ? $option_tpl : "asi_search_select_option";
$options = null;
foreach($items AS $i) {
    $selected = (in_array($i['value'], $selecteds))?true:false;
    //echo $i['value']. ": ".$selected;
    $options.=$modx->getChunk($tpl, array(
        'name'   => $i['name'],
        'value'  => $i['value'],
        'selected' => $selected,
        'filter_type'       => 'boolean',
        'filter_field'      => $identifier,
        'filter_value'      => $i['value'],
        'exclusive' => $exclusive,
        'set_identifier'    => $identifier,
        'result_count' => "(".rand(1,70).")",
    ));
}

// populate more options (if applicable)
$more_options = null;
if($lots == true) {
    // populate option rows
    $tpl = ( isset($more_option_tpl) ) ? $more_option_tpl : "asi_search_select_option";
    foreach($more_items AS $i) {
        $selected = (isset($i['selected'])) ? $i['selected'] : NULL;
        $more_options.=$modx->getChunk($tpl, array(
            'name'   => $i['name'],
            'value'  => $i['value'],
            'selected' => $selected,
            'exclusive' => $exclusive,
            'set_identifier'    => $identifier,
            'result_count' => "(".rand(1,70).")",
        ));
    }
}



// check for find label
$find_label = (isset($findLabel)) ? $findLabel."..." : "Find ".$label."..." ;

// populate wrapper
$tpl = ( isset($select_tpl) ) ? $select_tpl : "asi_search_select";
$html = $modx->getChunk($tpl, array(
    'options'       => $options,
    'lots'          => $lots,
    'more_options'  => $more_options,
    'label'         => $label,
    'entity'        => $entity,
    'identifier'    => $identifier,
    'tiptitle'      => $tiptitle,
    'tip_id'        => $tip_id,
    'exclusive' => $exclusive,
    'find_label' => $find_label,
));

// if lots, then add the search filter JS...
if($lots == true) {

    $filter = <<<hereDoc123
    
<script>

$(document).ready(function(){

    $('[data-g="search-select-%s"] [data-g="search-filter"]').keyup(function(){
        
        
        var term = $(this).val().toLowerCase();
        var n = term.length;
        
        if(n==0) {
            $('[data-g="search-select-%s"] li.checkbox').removeClass('hidden');
            $('[data-g="search-select-%s"] .moreDropdown').removeClass("open");
            $('[data-g="search-select-%s"] .title').removeClass("hidden");
            return;
        }
        
        $('[data-g="search-select-%s"] .moreDropdown').addClass("open");
        $('[data-g="search-select-%s"] .title').addClass("hidden");
        
        $('[data-g="search-select-%s"] input[type="checkbox"]').each(function(){
        
            var name = $(this).prop('name').toLowerCase();
            var check = name.substring(0, n);
            
            log("term is "+term);
            
            log("checking ["+term+"] against ["+check+"]");
        
            if( term == check ) {
                log("match!");
                $(this).parent('li.checkbox').removeClass('hidden');
            }else{
                $(this).parent('li.checkbox').addClass('hidden');
            }
        });
        
    });
});

</script>

hereDoc123;

    // MH - this JS has been moved to a global function in search.js

    //$filterJs = sprintf($filter, $identifier, $identifier, $identifier, $identifier, $identifier, $identifier, $identifier);
    //$modx->regClientHTMLBlock(GelTools::minifyJs($filterJs));

}

// add ajax triggers
$triggers = <<<hereDoc123

<script>

$(document).ready(function(){
    $('[data-g="search-select-%s"] input[type="checkbox"]').click(function(){
       //updateSearchResults();
    });
});

</script>

hereDoc123;

$triggersJs = sprintf($triggers, $identifier);
$modx->regClientHTMLBlock(GelTools::minifyJs($triggersJs));

return $html;