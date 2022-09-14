<?php
// prepares the output for the user to see the search they are going to save

// load the api manager
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

$request = $_REQUEST['search_request']; // this is the slugified version of the search request
$params = asi::buildParams($request); // sorts the params into an array for response

header('Content-Type: application/json');
echo json_encode($data);