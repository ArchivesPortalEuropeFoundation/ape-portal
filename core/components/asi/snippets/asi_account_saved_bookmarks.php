<?php
// load asi
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

//var_dump($request);

// grab the (this user) bookmarks
$bms = asi::listBookmarks($request);

// switch template for collection drill-down
$tpl = (isset($request['template']) && $request['template'] == "collection_drill") ? "asi_account_saved_collection_bookmark_item" : "asi_account_saved_bookmark_item" ;

$html = null;
foreach($bms AS $bm) { // each db search row

    //var_dump($search);
    $bm['date_sort'] = strtotime($bm['created_at']);

    // format the date for the view (modx config)
    $bm['created_at'] = date($modx->getOption("date_format_short"), strtotime($bm['created_at']) );

    // add a full url
    $bm['full_url'] = $modx->getOption("site_url").substr($bm['url'], 1);

    // inject the chunk with the database row
    $html .= $modx->getChunk($tpl, $bm);
}

return $html;