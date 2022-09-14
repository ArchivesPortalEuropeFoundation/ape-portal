<?php
// loads the details of a collection for the landing page from the token
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);
$token = $_REQUEST['token'];

// grab the data
$collection = asi::getCollectionByToken($token);
$searches = asi::getCollectionSearches($collection['id']);
$bookmarks = asi::getCollectionBookmarks($collection['id']);

// total counts for items
$collection['count_searches'] = count($searches);
$collection['count_bookmarks'] = count($bookmarks);

// fetch owner
$collection_owner = $modx->getObject("modUser", $collection['user_id']);
$profile = $collection_owner->getOne('Profile');

// Check if this is the owner
if ($modx->getUser()->get('id') != 0 && $modx->getUser()->get('id') == $collection['user_id'] && 1==2) { // check with Carly - this seems overkill
    $owner = true;
}
else {
    $owner = false;
}

//For firstname/lastname splitting
$parts = explode(" ", $profile->get('fullname'));
$collection['owner_lastname'] = array_pop($parts);
$collection['owner_firstname'] = implode(" ", $parts);

// populate HTML for items
$searches_html = null;
foreach($searches AS $s) {

    // format the date for the since
    $s['since'] = date("Y-m-d", strtotime($s['created_at']) );

    // add a full url
    $s['full_url'] = $modx->getOption("site_url").substr($s['url'], 1);

    // add owner
    $s['owner'] = $owner;

    $searches_html.=$modx->getChunk("asi_landing_collection_search_item", $s);
}

$bookmarks_html = null;
foreach($bookmarks AS $b) {

    //var_dump($search);
    $b['date_sort'] = strtotime($b['created_at']);

    // format the date for the view (modx config)
    $b['created_at'] = date($modx->getOption("date_format_short"), strtotime($b['created_at']) );

    // add a full url
    $b['full_url'] = $modx->getOption("site_url").substr($b['url'], 1);

    // add owner
    $b['owner'] = $owner;

    $bookmarks_html.=$modx->getChunk("asi_landing_collection_bookmark_item", $b);
}

// set placeholders for the page
$modx->setPlaceholders($collection, "collection.");
$modx->setPlaceholder("collection.searches_html", $searches_html);
$modx->setPlaceholder("collection.bookmarks_html", $bookmarks_html);
return null;