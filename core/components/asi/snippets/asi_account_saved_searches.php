<?php
// load asi
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

// grab the (this user) searches
$searches = asi::listSearches($request);

// switch template for collection drill-down
$tpl = (isset($request['template']) && $request['template'] == "collection_drill") ? "asi_account_saved_collection_search_item" : "asi_account_saved_search_item" ;

$html = null;
foreach($searches AS $search) { // each db search row

    //echo "<pre>".print_r($search, 1)."</pre>";

    // format the date for the sort (timestamp)
    $search['date_sort'] = strtotime($search['created_at']);

    // format the date for the view (modx config)
    $search['created_at'] = date($modx->getOption("date_format_short"), strtotime($search['created_at']) );

    // format the date for the since
    $search['since'] = date("Y-m-d", strtotime($search['created_at']) );

    // add a full url
    $search['full_url'] = $modx->getOption("site_url").substr($search['url'], 1);

    // format the parameters
    $search['params_html'] = asi::renderParametersHtmlFull($search, "ACCOUNT_SAVED_SEARCH");

    // inject the chunk with the database row
    $html .= $modx->getChunk($tpl, $search);
}

return $html;