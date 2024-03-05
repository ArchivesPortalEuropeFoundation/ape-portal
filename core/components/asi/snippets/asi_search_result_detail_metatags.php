<?php
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

require_once(MODX_CORE_PATH . 'components/geltools/autoload.php');
use GelTools AS Tools;

require_once(MODX_CORE_PATH . 'components/apef/metatags.class.php');

if (!function_exists('console_log')) {
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
//    $js_code .= 'history.replaceState(\'page2\', \'Title\', \'/archive/test1/test3\');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
}

$APIbase      = $modx->getOption("ape_api");
$siteUrl      = $modx->getOption('site_url');

$params       = $modx->sanitize($_REQUEST);
$repoCode     = $params['repositoryCode'] ?? null;

//Try to get metatags only for the actual content pages... those with at least a "repositoryCode" url parameter

    $placeholders = [];
    $placeholders['URI'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    ini_set('max_execution_time', 0);

//    $result = asi::fetchSingleResult($section);

//    $metaTags = new MetaTags();
//    $placeholders['metaTags'] = $metaTags;

    if (substr( $_SERVER['REQUEST_URI'], 0, 9 ) === "/archive/") {
//parse path to produce the various sub-params
        $path = str_replace('/archive/', '', rawurldecode(strtok($_SERVER["REQUEST_URI"], '?')));
        $parts = explode('/' , $path);

        $validParams = ['aicode','type','id','dbid','unitid'];
        $params = [];
        $previousPart = '';
        foreach ($parts as $part){
            if ($part != '') {
                if (in_array($part, $validParams)) {
                    $params[$part] = '';
                    $previousPart = $part;
                } else {
                    if ($params[$previousPart] == '') {
                        $params[$previousPart] = $part;
                    } else {
                        $params[$previousPart] = $params[$previousPart] . '/' . $part;
                    }
                }
            }
        }
        if (array_key_exists('aicode', $params)){
            $repoCode = $params['aicode'];
        }
        if (array_key_exists('type', $params)){
            $type = $params['type'];
        }
        if (array_key_exists('id', $params)){
            $id = rawurlencode($params['id']);
        }
        if (array_key_exists('dbid', $params)){
            $treeId = $params['dbid'];
            $cLevelId = $treeId;
            $_REQUEST['c'] = $treeId;
            $clevelPartPart = "clevelId=".substr($cLevelId,1);
        }
        if (array_key_exists('unitid', $params)){
            $unitId = rawurlencode($params['unitid']);
            $clevelPartPart = "clevelUnitId=".$unitId;
        }
        if (array_key_exists('dbid', $params) || array_key_exists('unitid', $params)){
            $levelName = 'clevel';
            $clevelPart = "&".$clevelPartPart;
        }
        else {
            $levelName = 'archdesc';
            $clevelPart = "";
        }

        $metaContent = json_decode(file_get_contents("{$APIbase}Dashboard/metatagsApi.action?aiRepositoryCode=".$repoCode."&recordId=".$id."&xmlType=".$type.$clevelPart));
    }
    else if (substr( $_SERVER['REQUEST_URI'], 0, 6 ) === "/name/") {
        //parse path to produce the various sub-params
        $path = str_replace('/name/', '', rawurldecode(strtok($_SERVER["REQUEST_URI"], '?')));
        $parts = explode('/' , $path);

        $validParams = ['aicode','id'];
        $params = [];
        $previousPart = '';
        foreach ($parts as $part){
            if ($part != '') {
                if (in_array($part, $validParams)) {
                    $params[$part] = '';
                    $previousPart = $part;
                } else {
                    if ($params[$previousPart] == '') {
                        $params[$previousPart] = $part;
                    } else {
                        $params[$previousPart] = $params[$previousPart] . '/' . $part;
                    }
                }
            }
        }
        if (array_key_exists('aicode', $params)){
            $repoCode = $params['aicode'];
        }
        if (array_key_exists('id', $params)){
            $id = rawurlencode($params['id']);
        }

        $metaContent = json_decode(file_get_contents("{$APIbase}Dashboard/metatagsApi.action?aiRepositoryCode=".$repoCode."&recordId=".$id."&xmlType=ec "));
    }
    else if (substr( $_SERVER['REQUEST_URI'], 0, 13 ) === "/institution/") {
        //parse path to produce the various sub-params
        $path = str_replace('/name/', '', rawurldecode(strtok($_SERVER["REQUEST_URI"], '?')));
        $parts = explode('/' , $path);

        $validParams = ['aicode'];
        $params = [];
        $previousPart = '';
        foreach ($parts as $part){
            if ($part != '') {
                if (in_array($part, $validParams)) {
                    $params[$part] = '';
                    $previousPart = $part;
                } else {
                    if ($params[$previousPart] == '') {
                        $params[$previousPart] = $part;
                    } else {
                        $params[$previousPart] = $params[$previousPart] . '/' . $part;
                    }
                }
            }
        }
        if (array_key_exists('aicode', $params)){
            $repoCode = $params['aicode'];
        }

        $metaContent = json_decode(file_get_contents("{$APIbase}Dashboard/metatagsApi.action?aiRepositoryCode=".$repoCode));
    }

//    $metaContent = json_decode(file_get_contents("{$APIbase}Dashboard/metatagsApi.action?aiRepositoryCode=DE-1958&recordId=NL-BwdADRKF-2&xmlType=fa"));

//    if (!is_null($repoCode)) {
//        $instDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&preview=false"));
//    }

    $placeholders['metacontent'] = $metaContent;
    console_log($metaContent);

//    $aiId = $instDetails->aiId;
//    $repoCode = $instDetails->aiRepositoryCode;
//    $instDoc = asi::domHTML($instDetails->html);
//    $instFinder = new DomXPath($instDoc);
// Placeholders for institutions
//    $placeholders['institution']['name'] = $instFinder->query("//h2[@class='blockHeader']")[0]->nodeValue;
//    $placeholders['institution']['country'] = $instFinder->query("//*[contains(@class, 'gel_country gel_contactDetails')]")[0]->nodeValue;
//    $placeholders['institution']['repositoryCode'] = $repoCode;
//    $placeholders['suggestion_request_uri'] = $_SERVER[REQUEST_URI];
//    $placeholders['sharing_uri'] = urlencode($placeholders['URI']);


//    $metaTags->description = "test description";
//    $metaTags->title = $placeholders['institution']['name'];


//if($section == "search-in-institutions") {
//    $placeholders['result_type'] = "Institutions";
//
//    //Set the variables we will be filling in the call
//    $finding_aids = '';
//    $holding_guides = '';
//    $source_guides = '';
//    $names_items = '';
//    $branchDetails = array();
//    //Set the branch count to 1 as there will always be a main branch to start with.
//    $count = 1;
//    //Fill in the first branch variable for processing before we start the while loop
//    $div = $instDoc->getElementById('repository_'.$count);
//    //Get the map details for main branch from the API for institution.
//    $instMapDetails = json_decode(file_get_contents("{$APIbase}Dashboard/geoApi.action?aiRepositoryCode={$repoCode}"));
//    //Set the lat and long placeholders to 0 for processing.
//    $placeholders['coords']['lat']      = 0;
//    $placeholders['coords']['lng']      = 0;
//
//    //Start the while loop that will process each branch info 1 by 1 until there are no more for this institute
//    while (!is_null($div)) {
//        $branch = array();
//        $branch['counter'] = $count;
//
//        //Initiate a new DOMDoc instance for processing the HTML for the branch
//        $branchItem = new DOMDocument();
//        $branchItem->loadHTML(mb_convert_encoding($div->C14N(), 'HTML-ENTITIES', 'UTF-8'));
//        $finder = new DomXPath($branchItem);
//        //Get the 3 sections that need processing for branch by their class name.
//        $contactDetails = $finder->query("//*[contains(@class, 'aiSection contactDisplay')]")[0];
//        $accessDisplay  = $finder->query("//*[contains(@class, 'aiSection accessDisplay')]")[0];
//        $archiveHolding = $finder->query("//*[contains(@class, 'aiSection archivesDisplay')]")[0];
//
//        //Check if the finder finds any info for contact, archives or access and fills in the branch variables based on what is returned.
//        if (!is_null($contactDetails)) {
//            $branch['institution']['contact'] = $contactDetails->C14N();
//        }
//        if(!is_null($archiveHolding)) {
//            $branch['institution']['archives'] = $archiveHolding->C14N();
//        }
//        if (!is_null($accessDisplay)) {
//            $branch['institution']['access'] = $accessDisplay->C14N();
//        }
//
//        //Take the rest of the branch info and process accordingly
//        foreach ($div->childNodes as $node) {
//            if($node->tagName == 'h3' && $node->getAttribute('class') == 'repositoryName') {
//                $branch['label'] = $node->nodeValue;
//                $branch['name_text'] = $node->nodeValue;
//            }
//        }
//        //If this is the main branch, we need the initial institution map coordinates to be set which will be called from the variable set earlier.
//        //For further coordinates, javascript is implemented to update the map on the page.
//        if($count === 1) {
//            $placeholders['institution']['latitude'] = floatval($instMapDetails->repos[0]->latitude);
//
//            $placeholders['institution']['longitude'] = floatval($instMapDetails->repos[0]->longitude);
//        }
//
//        //Set the location details for all branches
//        if($count === 1) {
//            $branch['location'] = $instMapDetails->repos[0];
//            unset($instMapDetails->repos[0]);
//            $branch['bounds'] = $instMapDetails->bounds;
//        } else {
//
//            foreach ($instMapDetails->repos as $repoKey => $repo) {
//                //TODO PHP 8 CHANGE
//                //if(str_starts_with($branch['label'], $repo->name) {
//                if(substr($branch['label'], 0, strlen($repo->name)) === $repo->name) {
//                    $branch['location'] = $repo;
//                    //unset($instMapDetails->repos[$repoKey]);
//                    $branch['bounds'] = $instMapDetails->bounds;
//                }
//            }
//
//        }
//
//        //Set other display info html
//        $otherInfo = $instFinder->query("//*[contains(@class, 'aiSection otherDisplay')]")[0];
//
//        if (!is_null($otherInfo)) {
//            $placeholders['institution']['other_info'] = $otherInfo->C14N();
//        }
//
//        //Finalise this run of loop by adding new processed data to the branch details array, and then updating count to process the next in the list
//        $branchDetails[] = $branch;
//        $count++;
//        //Before the while loop restarts, update the object to the new item based on the updated count value.
//        $div = $instDoc->getElementById('repository_'.$count);
//
//    }
//
//    //Set the variables needed for Archival Materials
//    $archival_materials = 0;
//    $rst = 10;
//    if(!is_null($params['max'])) {
//        $rst = $params['max'];
//    }
//    //Check for finding aids, holding guides, source guides and names for institution
//    //Each section below fetches the relevant section from the API and creates the pagination parameters if required before adding it to the placeholders later on
//    //Finding Aids processing
//    if($instDetails->hasFindingAids === true) {
//        $faPg = 1;
//        $type = 'fa';
//        if(!is_null($params['page']) && $params['page'] > 1) {
//            $faPg = $params['page'];
//        }
//        $instFADetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type={$type}&xmlType={$type}&page={$faPg}&max={$rst}"));
//
//        $faPaginationDetails  = array();
//        $faTotalRecords = $instFADetails->eadTotalCount;
//        $faTotal = ceil($faTotalRecords / $rst);
//
//        $faPaginationDetails['page'] = $faPg;
//        $faPaginationDetails['limit'] = $rst;
//        $faPaginationDetails['resultsTotal'] = $instFADetails->eadTotalCount;
//        $faPaginationDetails['pageTotal'] = $faTotal;
//        $finding_aids = true;
//        $archival_materials++;
//    }
//
//    //Holding Guides processing
//    if($instDetails->hasHoldingGuides === true) {
//        $hgPg = 1;
//        $type = 'hg';
//        if(!is_null($params['page']) && $params['page'] > 1) {
//            $hgPg = $params['page'];
//        }
//        $instHGdetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type={$type}&xmlType={$type}&page={$hgPg}"));
//
//        $hgPaginationDetails  = array();
//        $hgTotalRecords = $instHGdetails->eadTotalCount;
//        $hgTotal = ceil($hgTotalRecords / $rst);
//
//        $hgPaginationDetails['page'] = $hgPg;
//        $hgPaginationDetails['limit'] = $rst;
//        $hgPaginationDetails['resultsTotal'] = $instHGdetails->eadTotalCount;
//        $hgPaginationDetails['pageTotal'] = $hgTotal;
//        $holding_guides = true;
//        $archival_materials++;
//    }
//
//    //Source Guides processing
//    if($instDetails->hasSourceGuides === true) {
//        $sgPg = 1;
//        $type = 'sg';
//        if(!is_null($params['page']) && $params['page'] > 1) {
//            $sgPg = $params['page'];
//        }
//        $instSGdetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type=sg&xmlType=hg&page=1"));
//        $sgPaginationDetails  = array();
//        $sgTotalRecords = $instSGdetails->eadTotalCount;
//        $sgTotal = ceil($sgTotalRecords / $rst);
//
//        $sgPaginationDetails['page'] = $sgPg;
//        $sgPaginationDetails['limit'] = $rst;
//        $sgPaginationDetails['resultsTotal'] = $instSGdetails->eadTotalCount;
//        $sgPaginationDetails['pageTotal'] = $sgTotal;
//        $source_guides = true;
//        $archival_materials++;
//    }
//
//    //Names Processing
//    if($instDetails->hasEacCpfs === true) {
//        $ecPg = 1;
//        $type = 'ec';
//        if(!is_null($params['page']) && $params['page'] > 1) {
//            $ecPg = $params['page'];
//        }
//        $instECdetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type=ec&xmlType=ec&page=1"));
//        $ecPaginationDetails  = array();
//        $ecTotalRecords = $instECdetails->eacCpfTotalCount;
//        $ecTotal = ceil($ecTotalRecords / $rst);
//
//        $ecPaginationDetails['page'] = $ecPg;
//        $ecPaginationDetails['limit'] = $rst;
//        $ecPaginationDetails['resultsTotal'] = $instECdetails->eacCpfTotalCount;
//        $ecPaginationDetails['pageTotal'] = $ecTotal;
//        $names_items = true;
//        $archival_materials++;
//    }
//
//    //Initialise the branches, selector and counter variables to initial states for use in the placeholder creation of branches below.
//    $selector = null;
//    $branches = null;
//    $counter = 1;
//
//    //Run through the branchDetails from earlier and assign them to the selector with the correct HTML.
//    foreach($branchDetails AS $b) {
//        $b['counter'] = $counter;
//        $label = $b['name_text'];
//        $active = false;
//
//        if($counter == 1) {
//            $label = $b['name_text'];
//            $active = 'active';
//            $placeholders['pagetitle'] = $b['name_text'];
//        }
//
//        $b['label'] = $label;
//        $short = Tools::truncate($label, 18);
//        //add the selector item to the list with correct html.
//        $selector .= "<a data-short-label='{$short}' data-switch-branch='{$b['counter']}' data-latitude='{$b['location']->latitude}' data-longitude='{$b['location']->longitude}' class='{$active}'>{$label}</a>";
//        //Process the branch info into the correct HTML format by running it through the chunk template.
//        $branches .= $modx->getChunk("asi_search_result_institution_branch",
//            $b
//        );
//        $counter++;
//    }
//
//    // Set a default pagetitle if we only have one branch
//    if(empty($placeholders['pagetitle'])) {
//        $placeholders['pagetitle'] = $placeholders['institution']['name'];
//    }
//
//    //Set all placeholders for use in template display
//    $placeholders['institution']['repo_code'] = $repoCode;
//    $placeholders['institution']['archival_materials'] = $archival_materials;
//    $placeholders['institution']['finding_aids'] = $finding_aids;
//    $placeholders['institution']['finding_aids_pagination'] = $faPaginationDetails;
//    $placeholders['institution']['holding_guides'] = $holding_guides;
//    $placeholders['institution']['holding_guides_pagination'] = $hgPaginationDetails;
//    $placeholders['institution']['source_guides'] = $source_guides;
//    $placeholders['institution']['source_guides_pagination'] = $sgPaginationDetails;
//    $placeholders['institution']['names_items'] = $names_items;
//    $placeholders['institution']['names_items_pagination'] = $ecPaginationDetails;
//
//    $placeholders['result_name'] = $placeholders['institution']['name'];
//
//    $modx->setPlaceholder('selector', $selector);
//    $modx->setPlaceholder('branches', $branches);
//    //Generate the parameters JSON string for institution
//    $result['params_json'] = asi::generateParamsString($result, "institution");
//}

// Set placeholders to page
    $temp = $modx->toPlaceholders($placeholders, "metacontent");

//$modx->setPlaceholders($placeholders,'metatags.');

//print_r($placeholders);
//print_r($temp);



return;