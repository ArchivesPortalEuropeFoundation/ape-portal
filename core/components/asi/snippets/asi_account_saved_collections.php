<?php
// load asi
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

// grab the (this user) searches
$collections = asi::listCollections();

$html = null;
foreach($collections AS $c) { // each db search row

    //var_dump($search);
    $c['date_sort'] = strtotime($c['created_at']);

    // format the date for the view (modx config)
    $c['created_at'] = date($modx->getOption("date_format_short"), strtotime($c['created_at']) );

    // add a full url
    $c['full_url'] = $modx->getOption("site_url").substr($c['url'], 1);

    // inject the chunk with the database row
    if($c['total_searches'] < 1 && $c['total_bookmarks'] < 1) {
        $html .= $modx->getChunk("asi_account_saved_collection_item_empty", $c);
    } else {
        $html .= $modx->getChunk("asi_account_saved_collection_item", $c);
    }

}

return $html;