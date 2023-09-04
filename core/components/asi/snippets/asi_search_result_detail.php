<?php
/**
 * Gel Studios Ape API result processor (snippet)
 *
 * This helper takes an ID and term (for testing) and
 * returns a result detail
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     Gel Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 * @param      string $term the term to be queried
 * @param      int $id the id of the resource
 * @return     sets modx placeholders for usage in the template
 */

if (!function_exists('console_log')) {
    function console_log($output, $with_script_tags = true)
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
//    $js_code .= 'history.replaceState(\'page2\', \'Title\', \'/archive/test1/test3\');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
}

require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

require_once(MODX_CORE_PATH . 'components/geltools/autoload.php');
use GelTools AS Tools;

$APIbase      = $modx->getOption("ape_api");
$siteUrl      = $modx->getOption('site_url');

$params       = $modx->sanitize($_REQUEST);
$cLevelId     = $params['c'];
$id           = rawurlencode($params['recordId']);
$unitId       = rawurlencode($params['unitId']) ?? null;
$aiId         = $params['id'];
$repoCode     = $params['repositoryCode'] ?? null;
$term         = $params['term'];
$type         = htmlspecialchars($params['t']);
$levelName    = $params['levelName'];
$treeId       = $params['c'];
$referenceId  = rawurlencode($params['reference']);
$lang         = $params['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
$placeholders = [];
$scroll = $params['scroll'] ?? null;
$placeholders['URI'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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
    }
    if (array_key_exists('unitid', $params)){
        $unitId = rawurlencode($params['unitid']);
    }
    if (array_key_exists('dbid', $params) || array_key_exists('unitid', $params)){
        $levelName = 'clevel';
    }
    else {
        $levelName = 'archdesc';
    }

//    error_log(print_r('itemID2 = ' . $parts, TRUE));
//    console_log($parts);
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

//    error_log(print_r('itemID2 = ' . $parts, TRUE));
//    console_log($parts);
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

//    error_log(print_r('itemID2 = ' . $parts, TRUE));
//    console_log($parts);
}

ini_set('max_execution_time', 0);

//$result      = asi::fetchSingleResult($section);

if(!is_null($repoCode)) {
    $instDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&preview=false"));
} else {
    $instDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagApi.action?aiId={$aiId}&request_locale={$lang}&preview=false"));
}

$aiId         = $instDetails->aiId;
$repoCode     = $instDetails->aiRepositoryCode;
$instDoc    = asi::domHTML($instDetails->html);
$instFinder = new DomXPath($instDoc);
// Placeholders for institutions
$placeholders['institution']['name']    = $instFinder->query("//h2[@class='blockHeader']")[0]->nodeValue;
$placeholders['institution']['country'] = $instFinder->query("//*[contains(@class, 'gel_country gel_contactDetails')]")[0]->nodeValue;
$placeholders['institution']['repositoryCode'] = $repoCode;
$placeholders['suggestion_request_uri'] = $_SERVER[REQUEST_URI];
$placeholders['sharing_uri'] = urlencode($placeholders['URI']);

if(!is_null($scroll)) {
    $placeholders['scroll'] = $scroll;
}

$modx->runSnippet('contactFinder',array('repoCode' => $repoCode,'type' => 'contact_form_detail_page'));
$modx->runSnippet('contactFinder',array('repoCode' => $repoCode,'type' => 'rating_form_detail_page'));
$modx->runSnippet('contactFinder',array('repoCode' => $repoCode,'type' => 'suggestion_form_detail_page'));

if($section == "search-in-archives") {
    $placeholders['result_type'] = "Archives";
    $output = '';
    $counter = 0;
    $prefix = '';
    $archiveUrl = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&eadid={$id}&xmlType={$type}";
    if($levelName === 'clevel') {
        $prefix = 'C';
        $cLevel = substr($cLevelId, '1');
        $archiveUrl .= "&clevelid=".$cLevel."&type=cdetails";
        $placeholders['archive']['clevelid'] = $cLevel;
        $placeholders['result_clevelid'] = $cLevel;

        if(!is_null($unitId)) {
            $archiveUrl .= "&clevelunitid={$unitId}";
            $placeholders['archive']['unitid'] = $unitId;

            $placeholders['result_unitid'] = $unitId;
        }

    } else {
        $archiveUrl .= "&type=frontpage";
    }

    $placeholders['archive']['repocode'] = $repoCode;
    $placeholders['archive']['type'] = $type;
    $placeholders['archive']['recordid'] = $id;
    $placeholders['archive']['levelname'] = 'clevel';

    $placeholders['result_record_id'] = $id;

//    $fAidArchiveUrl = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode=".$repoCode."&request_locale={$lang}&eadid=".$id."&type=cdetails&clevelunitid=".$unitId."&xmlType=".$type;
//    $FAarchiveDetails = json_decode(file_get_contents($fAidArchiveUrl));
    $archiveDetails = json_decode(file_get_contents($archiveUrl));

    //Store the URL parameters need to be sent for fetching the tree
    $placeholders['archive']['url_parameters'] = 'c='.$prefix.$archiveDetails->clevelid.'&unitId='.$unitId.'&recordId='.$id.'&repoCode='.$repoCode.'&type='.$type.'&start=0';
    $placeholders['archive']['eadid'] = $id;
    
    //KSTA: my guess is that thus code for fetching the tree is not used.
    $treeQueryString = "{$APIbase}Dashboard/eadTreeApi.action?xmlTypeName={$type}&request_locale={$lang}";
    if($levelName === 'clevel') {
        $cLevel = substr($cLevelId, '1');
        $treeQueryString .= "&clevelId={$cLevelId}";
    } elseif(!is_null($id)) {
        $treeQueryString .= "&ecId={$treeId}";
    }
    $treeResponse = json_decode(file_get_contents($treeQueryString));
    $placeholders['archive']['tree'] = file_get_contents($treeQueryString);


    $doc = asi::domHTML($archiveDetails->html);
    $finder = new DomXPath($doc);

    //Process EADID Title
    $eadidItem = $finder->query("//div[@class='eadid']")[0];
    if(!is_null($eadidItem)) {
        //$placeholders['archive']['eadid']   = $eadidItem->nodeValue;
        $eadidItem->parentNode->removeChild($eadidItem);
    }

    //Process Date
    $dateItem = $finder->query("//div[@class='subtitle subtitle-date']")[0];
    if(!is_null($dateItem)) {
        $placeholders['archive']['subtitle_date']   = $dateItem->nodeValue;
        $dateItem->parentNode->removeChild($dateItem);
    }

    //Process original link
    $linkItem = $finder->query("//div[@class='defaultlayout defaultlayout-original-link']/a")[0];
    if(!is_null($linkItem)) {
        $placeholders['archive']['original_link']   = $linkItem->getAttribute('href');
        $placeholders['archive']['original_link_text']   = $linkItem->nodeValue;
        $linkItem->parentNode->removeChild($linkItem);
    }

    //Process the title
    $titleProper = $finder->query("//h1[@class='titleproper']")[0];
    if(!is_null($titleProper)) {
        $placeholders['archive']['title']   = $titleProper->nodeValue;
        $titleProper->parentNode->removeChild($titleProper);
    }

    //Process other finding aids
    $otherFindingAidsInt = $finder->query("//div[@class='otherfindingaids']/div[@class='linkButton']/a");
    foreach ($otherFindingAidsInt as $intLink) {
        $newId = $intLink->getAttribute('href');
        $newHref = "/archive/aicode/".$repoCode."/type/fa/id/".$newId;
        $intLink->setAttribute('href', $newHref);
    }

    //Process digital objects takes place below
    //First up is to call the object rights(if any) and assign their value the correct icons or images.
    $digitalObjectsRestriction = $finder->query("//div[@class='userestrict-dao']/p/a")[0];
    if(!is_null($digitalObjectsRestriction)) {
        $testAttributes = (array)json_decode(file_get_contents(MODX_ASSETS_PATH.'/creative-commons-types.json'));
        $attributeLink = $digitalObjectsRestriction->getAttribute('href');
        $attribution = '';
        foreach ($testAttributes as $attribute => $value) {
            if($attribute === $attributeLink) {
                $attribution = $value;
            }
        }
    }

    //Process the digital objects header
    $digitalObjectsHeader = $finder->query("//h2[@class='dao-list']")[0];
    if(!is_null($digitalObjectsHeader)) {
        $dObjectsHeader = $digitalObjectsHeader->nodeValue;
        //Remove the header from the DOM as it has been accounted for.
        $digitalObjectsHeader->parentNode->removeChild($digitalObjectsHeader);
    }

    $digitalObjects = $finder->query("//div[@class='daolist-orig']/div[@class='dao']/a");
    //Process digital images with original links and send to slider.
    foreach ($digitalObjects AS $image) {
        $imageLink = $image->getAttribute('href') ?? '#';
        $imageCaption = '';
        $imageThumb = '';
        foreach ($image->childNodes as $imageItem) {
            if($imageItem->tagName === 'img') {
                $src = $imageItem->getAttribute('src');
                $dataSrc = $imageItem->getAttribute('data-src');
                //Note, is_null did not work here and so strlen was used instead
                if(strlen($src) === 0) {
                    $imageThumb = $dataSrc;
                } else {
                    $imageThumb = $src;
                }
                if($imageThumb[0] === '/') {
                    $fileName = basename($imageThumb).PHP_EOL;
                    $filePath = '/assets/images/placeholders/';
                    $imageThumb = $filePath.$fileName;
                }
            }
            if($imageItem->tagName === 'span') {
                $imageCaption = $imageItem->textContent ?? '';
            }
        }

        //Assign the object to the image slider now that it is processed into the correct variables.
        $gallery_content_slider .= $modx->getChunk("asi_gallery_content_slider", array(
            'thumb' => $imageThumb,
            'link' => $imageLink,
            'caption' => $imageCaption,
            'attribution' => $attribution
        ));
        $gallery_content_caption .= $modx->getChunk("asi_gallery_content_caption", array(
            'thumb' => $imageThumb,
            'link' => $imageLink,
            'caption' => $imageCaption,
            'attribution' => $attribution
        ));
        $gallery_content_tab .= $modx->getChunk("asi_gallery_content_tab", array(
            'thumb' => $imageThumb,
            'link' => $imageLink,
            'caption' => $imageCaption,
            'attribution' => $attribution
        ));
    }

    //Remove the object from the DOM as it is now accounted for.
    $digitalObjectsOriginalParent = $finder->query("//div[@class='daolistContainer']")[0];
    if(!is_null($digitalObjectsOriginalParent)) {
        $digitalObjectsOriginalParent->parentNode->removeChild($digitalObjectsOriginalParent);
    }

    //Set the placeholders that show the digital objects on the page.
    $placeholders['archive']['gallery'] = [
        'slider'    => $gallery_content_slider,
        'caption'   => $gallery_content_caption,
        'tab'       => $gallery_content_tab,
    ];

    //Set other placeholders for pagetitle and date and then render the rest of the DOM that has not needed to be processed as HTML for viewing on the page.
    $placeholders['pagetitle']          = $placeholders['archive']['title'];
    $placeholders['archive']['date']    = $finder->query("//div[@class='subtitle']")[0]->nodeValue;
    $placeholders['archive']['html']    = $doc->saveHTML();

    //Set the pagination for child components if they require it or if they exist
    if($archiveDetails->totalNumberOfChildren > 0) {
        $rst = 10;
        $pg = 1;
        $children = asi::domHTML($archiveDetails->childHtml);
        $childFinder = new DomXPath($children);
        $componentObjects = $childFinder->query("//div[@class='childContent']");
        $childHtml = '';

        foreach ($componentObjects as $componentObject) {
            $c = array();
            $c['html'] = $componentObject->C14N();
            $childHtml .= $modx->getChunk("asi_search_result_archive_component", $c);
        }
        $placeholders['archive']['components']['limit'] = $rst;
        $placeholders['archive']['components']['page'] = $pg;
        $placeholders['archive']['components']['resultsTotal'] = intval($archiveDetails->totalNumberOfChildren);
        $total = ceil($archiveDetails->totalNumberOfChildren / $rst);
        $paginationDetails['pageTotal'] = $total;
        $placeholders['archive']['components']['pageTotal'] = $total;
    }

    $placeholders['result_name'] = $placeholders['archive']['title'];

    $result['params_json'] = asi::generateParamsString($result, "archive");

    //Set a placeholder for all the SOLR data.
    $modx->setPlaceholders($result['solr_detail'], "solr_data.");

    //Clear out the gallery and components variables.
    $gallery_content_slider = null;
    $gallery_content_caption = null;
    $components = null;
}

if($section == "search-in-institutions") {
    $placeholders['result_type'] = "Institutions";

    //Set the variables we will be filling in the call
    $finding_aids = '';
    $holding_guides = '';
    $source_guides = '';
    $names_items = '';
    $branchDetails = array();
    //Set the branch count to 1 as there will always be a main branch to start with.
    $count = 1;
    //Fill in the first branch variable for processing before we start the while loop
    $div = $instDoc->getElementById('repository_'.$count);
    //Get the map details for main branch from the API for institution.
    $instMapDetails = json_decode(file_get_contents("{$APIbase}Dashboard/geoApi.action?aiRepositoryCode={$repoCode}"));
    //Set the lat and long placeholders to 0 for processing.
    $placeholders['coords']['lat']      = 0;
    $placeholders['coords']['lng']      = 0;

    //Start the while loop that will process each branch info 1 by 1 until there are no more for this institute
    while (!is_null($div)) {
        $branch = array();
        $branch['counter'] = $count;

        //Initiate a new DOMDoc instance for processing the HTML for the branch
        $branchItem = new DOMDocument();
        $branchItem->loadHTML(mb_convert_encoding($div->C14N(), 'HTML-ENTITIES', 'UTF-8'));
        $finder = new DomXPath($branchItem);
        //Get the 3 sections that need processing for branch by their class name.
        $contactDetails = $finder->query("//*[contains(@class, 'aiSection contactDisplay')]")[0];
        $accessDisplay  = $finder->query("//*[contains(@class, 'aiSection accessDisplay')]")[0];
        $archiveHolding = $finder->query("//*[contains(@class, 'aiSection archivesDisplay')]")[0];

        //Check if the finder finds any info for contact, archives or access and fills in the branch variables based on what is returned.
        if (!is_null($contactDetails)) {
            $branch['institution']['contact'] = $contactDetails->C14N();
        }
        if(!is_null($archiveHolding)) {
            $branch['institution']['archives'] = $archiveHolding->C14N();
        }
        if (!is_null($accessDisplay)) {
            $branch['institution']['access'] = $accessDisplay->C14N();
        }

        //Take the rest of the branch info and process accordingly
        foreach ($div->childNodes as $node) {
            if($node->tagName == 'h3' && $node->getAttribute('class') == 'repositoryName') {
                $branch['label'] = $node->nodeValue;
                $branch['name_text'] = $node->nodeValue;
            }
        }
        //If this is the main branch, we need the initial institution map coordinates to be set which will be called from the variable set earlier.
        //For further coordinates, javascript is implemented to update the map on the page.
        if($count === 1) {
            $placeholders['institution']['latitude'] = floatval($instMapDetails->repos[0]->latitude);

            $placeholders['institution']['longitude'] = floatval($instMapDetails->repos[0]->longitude);
        }

        //Set the location details for all branches
        if($count === 1) {
            $branch['location'] = $instMapDetails->repos[0];
            unset($instMapDetails->repos[0]);
            $branch['bounds'] = $instMapDetails->bounds;
        } else {

            foreach ($instMapDetails->repos as $repoKey => $repo) {
                //TODO PHP 8 CHANGE
                //if(str_starts_with($branch['label'], $repo->name) {
                if(substr($branch['label'], 0, strlen($repo->name)) === $repo->name) {
                    $branch['location'] = $repo;
                    //unset($instMapDetails->repos[$repoKey]);
                    $branch['bounds'] = $instMapDetails->bounds;
                }
            }
      
        }

        //Set other display info html
        $otherInfo = $instFinder->query("//*[contains(@class, 'aiSection otherDisplay')]")[0];
     
        if (!is_null($otherInfo)) {
            $placeholders['institution']['other_info'] = $otherInfo->C14N();
        }

        //Finalise this run of loop by adding new processed data to the branch details array, and then updating count to process the next in the list
        $branchDetails[] = $branch;
        $count++;
        //Before the while loop restarts, update the object to the new item based on the updated count value.
        $div = $instDoc->getElementById('repository_'.$count);

    }

    //Set the variables needed for Archival Materials
    $archival_materials = 0;
    $rst = 10;
    if(!is_null($params['max'])) {
        $rst = $params['max'];
    }
    //Check for finding aids, holding guides, source guides and names for institution
    //Each section below fetches the relevant section from the API and creates the pagination parameters if required before adding it to the placeholders later on
    //Finding Aids processing
    if($instDetails->hasFindingAids === true) {
        $faPg = 1;
        $type = 'fa';
        if(!is_null($params['page']) && $params['page'] > 1) {
            $faPg = $params['page'];
        }
        $instFADetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type={$type}&xmlType={$type}&page={$faPg}&max={$rst}"));

        $faPaginationDetails  = array();
        $faTotalRecords = $instFADetails->eadTotalCount;
        $faTotal = ceil($faTotalRecords / $rst);

        $faPaginationDetails['page'] = $faPg;
        $faPaginationDetails['limit'] = $rst;
        $faPaginationDetails['resultsTotal'] = $instFADetails->eadTotalCount;
        $faPaginationDetails['pageTotal'] = $faTotal;
        $finding_aids = true;
        $archival_materials++;
    }

    //Holding Guides processing
    if($instDetails->hasHoldingGuides === true) {
        $hgPg = 1;
        $type = 'hg';
        if(!is_null($params['page']) && $params['page'] > 1) {
            $hgPg = $params['page'];
        }
        $instHGdetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type={$type}&xmlType={$type}&page={$hgPg}"));

        $hgPaginationDetails  = array();
        $hgTotalRecords = $instHGdetails->eadTotalCount;
        $hgTotal = ceil($hgTotalRecords / $rst);

        $hgPaginationDetails['page'] = $hgPg;
        $hgPaginationDetails['limit'] = $rst;
        $hgPaginationDetails['resultsTotal'] = $instHGdetails->eadTotalCount;
        $hgPaginationDetails['pageTotal'] = $hgTotal;
        $holding_guides = true;
        $archival_materials++;
    }

    //Source Guides processing
    if($instDetails->hasSourceGuides === true) {
        $sgPg = 1;
        $type = 'sg';
        if(!is_null($params['page']) && $params['page'] > 1) {
            $sgPg = $params['page'];
        }
        $instSGdetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type=sg&xmlType=hg&page=1"));
        $sgPaginationDetails  = array();
        $sgTotalRecords = $instSGdetails->eadTotalCount;
        $sgTotal = ceil($sgTotalRecords / $rst);

        $sgPaginationDetails['page'] = $sgPg;
        $sgPaginationDetails['limit'] = $rst;
        $sgPaginationDetails['resultsTotal'] = $instSGdetails->eadTotalCount;
        $sgPaginationDetails['pageTotal'] = $sgTotal;
        $source_guides = true;
        $archival_materials++;
    }

    //Names Processing
    if($instDetails->hasEacCpfs === true) {
        $ecPg = 1;
        $type = 'ec';
        if(!is_null($params['page']) && $params['page'] > 1) {
            $ecPg = $params['page'];
        }
        $instECdetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type=ec&xmlType=ec&page=1"));
        $ecPaginationDetails  = array();
        $ecTotalRecords = $instECdetails->eacCpfTotalCount;
        $ecTotal = ceil($ecTotalRecords / $rst);

        $ecPaginationDetails['page'] = $ecPg;
        $ecPaginationDetails['limit'] = $rst;
        $ecPaginationDetails['resultsTotal'] = $instECdetails->eacCpfTotalCount;
        $ecPaginationDetails['pageTotal'] = $ecTotal;
        $names_items = true;
        $archival_materials++;
    }

    //Initialise the branches, selector and counter variables to initial states for use in the placeholder creation of branches below.
    $selector = null;
    $branches = null;
    $counter = 1;

    //Run through the branchDetails from earlier and assign them to the selector with the correct HTML.
    foreach($branchDetails AS $b) {
        $b['counter'] = $counter;
        $label = $b['name_text'];
        $active = false;

        if($counter == 1) {
            $label = $b['name_text'];
            $active = 'active';
            $placeholders['pagetitle'] = $b['name_text'];
        }

        $b['label'] = $label;
        $short = Tools::truncate($label, 18);
        //add the selector item to the list with correct html.
        $selector .= "<a data-short-label='{$short}' data-switch-branch='{$b['counter']}' data-latitude='{$b['location']->latitude}' data-longitude='{$b['location']->longitude}' class='{$active}'>{$label}</a>";
        //Process the branch info into the correct HTML format by running it through the chunk template.
        $branches .= $modx->getChunk("asi_search_result_institution_branch",
            $b
        );
        $counter++;
    }

    // Set a default pagetitle if we only have one branch
    if(empty($placeholders['pagetitle'])) {
        $placeholders['pagetitle'] = $placeholders['institution']['name'];
    }

    //Set all placeholders for use in template display
    $placeholders['institution']['repo_code'] = $repoCode;
    $placeholders['institution']['archival_materials'] = $archival_materials;
    $placeholders['institution']['finding_aids'] = $finding_aids;
    $placeholders['institution']['finding_aids_pagination'] = $faPaginationDetails;
    $placeholders['institution']['holding_guides'] = $holding_guides;
    $placeholders['institution']['holding_guides_pagination'] = $hgPaginationDetails;
    $placeholders['institution']['source_guides'] = $source_guides;
    $placeholders['institution']['source_guides_pagination'] = $sgPaginationDetails;
    $placeholders['institution']['names_items'] = $names_items;
    $placeholders['institution']['names_items_pagination'] = $ecPaginationDetails;

    $placeholders['result_name'] = $placeholders['institution']['name'];

    $modx->setPlaceholder('selector', $selector);
    $modx->setPlaceholder('branches', $branches);
    //Generate the parameters JSON string for institution
    $result['params_json'] = asi::generateParamsString($result, "institution");
}

if($section == "search-in-names") {

    $placeholders['result_type'] = "Names";

    //Get the name details from the API for processing
    $nameDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eacApi.action?aiRepositoryCode=".$repoCode."&eaccpfId=".$id."&translationLanguage=default&langNavigator=it&request_locale={$lang}"));
    //Generate the parameters JSON string for names
    $result['params_json'] = asi::generateParamsString($result, "name");
    //Process the html received from the API and intitialise it with DomDocument for further processing
    $doc = asi::domHTML($nameDetails->html);
    $finder = new DomXPath($doc);
    //Initialise entity type default values which will be corporate body unless return gives different
    $entityTypeCheck = '';
    $entityType = 'corporatebody';
    $entityIcon = 'fa-landmark';

    //Check for H1 tags on the returned HTML and if there are any, they will based on HTML markup from Kostas, give a class that will include the entity type
    $header1Tag = $doc->getElementsByTagName('h1');
    foreach ($header1Tag as $h1tag) {
        foreach ($h1tag->attributes as $attribute) {
            //Take the class from the H1 tag and assign the value to the entity type
            if($attribute->name === 'class') {
                $entityTypeCheck = $attribute->value;
            }
        }
    }
    //Depending on the class name, it will be one of 3 items. Assign the correct values instead of the default from above.
    switch ($entityTypeCheck) {
        case "blockHeader iconCorporateBody":
            $entityType = 'corporatebody';
            $entityIcon = 'fa-landmark';
            break;
        case "blockHeader iconPerson":
            $entityType = 'person';
            $entityIcon = 'fa-user';
            break;
        case "blockHeader iconFamily":
            $entityType = 'family';
            $entityIcon = 'fa-users';
            break;
    }

    //Get material for Name and if it exists, process data
    $materialDiv = $doc->getElementById('material');
    if(!is_null($materialDiv)) {
        $materialItem = new DOMDocument();
        $materialItem->loadHTML(mb_convert_encoding($materialDiv->C14N(), 'HTML-ENTITIES', 'UTF-8'));
        //Get the material items based on how many li tags are listed here. Each li should technically be another material item
        $items = $materialItem->getElementsByTagName('li');
        //Set the variables we will need for processing these list items.
        $archiveMaterials = array();
        $archRelsObject = array();
        $archRelsCount = 0;
        $archRels = "";

        foreach ($items as $item) {
            $archiveMaterial = array();
            if($item->firstChild->tagName === 'a') {
                $archiveMaterial['type'] = 'link';
                $archiveMaterial['name'] = $item->firstChild->nodeValue;
                foreach ($item->firstChild->attributes as $attribute) {
                    if ($attribute->name === 'href') {
                        $materialLink = '#';
                        $linkParts = explode('/', $attribute->nodeValue);
                        if($linkParts) {
                            $materialLink = implode('/', $linkParts);
                        }
                        $archiveMaterial['link'] = $materialLink;
                    }
                }
            } else {
                $archiveMaterial['type'] = 'text';
                $archiveMaterial['name'] = $item->firstChild->nodeValue;
            }
            //Assign the material to the material array
            $archiveMaterials[] = $archiveMaterial;

            $archRelsCount++;
            if($archiveMaterial['type'] === 'link') {
                $archRels .= "<li><a target='_blank' href='{$materialLink}'>{$archiveMaterial['name']}</a></li>";
            } else {
                $archRels .= "<li>{$archiveMaterial['name']}</li>";
            }
        }
    }
    $placeholders['archives'] = [
        'items' => $archRels,
        'count' => $archRelsCount,
    ];
    $relatedDiv = $doc->getElementById('persons');
    if(!is_null($relatedDiv)) {
        $relatedItem = new DOMDocument();
        $relatedItem->loadHTML(mb_convert_encoding($relatedDiv->C14N(), 'HTML-ENTITIES', 'UTF-8'));
        $items = $relatedItem->getElementsByTagName('li');
        $relatedNames = array();
        $nameRelsObject = array();
        $nameRelsCount = 0;
        $nameRels = "";
        foreach ($items as $item) {
            $relatedName = array();
            if($item->firstChild->tagName === 'a') {
                $relatedName['type'] = 'link';
                $relatedName['name'] = $item->firstChild->nodeValue;
                foreach ($item->firstChild->attributes as $attribute) {
                    if ($attribute->name === 'href') {
                        $relatedLink = '#';
                        $linkParts = explode('/', $attribute->nodeValue);
                        if($linkParts) {
                            $relatedLink = implode('/', $linkParts);
                        }
                        $relatedName['link'] = $relatedLink;
                    }
                }
            } else {
                $relatedName['type'] = 'text';
                $relatedName['name'] = $item->firstChild->nodeValue;
            }

            $relatedNames[] = $relatedName;

            $nameRelsCount++;
            if($relatedName['type'] === 'link') {
                $nameRels .= "<li><a target='_blank' href='{$relatedLink}'>{$relatedName['name']}</a></li>";
            } else {
                $nameRels .= "<li>{$relatedName['name']}</li>";
            }
        }
    }
    $placeholders['relatedNames'] = [
        'items' => $nameRels,
        'count' => $nameRelsCount,
    ];
    $nameTitle = $finder->query("//*[@id='nameTitle']")[0]->nodeValue;
    $alternativeNames = $finder->query("//*[@id='alternativeName']/p");
    if(!empty($alternativeNames)) {
        foreach ($alternativeNames as $alternativeName) {
            if($alternativeName->nodeValue == $nameTitle) {
                $alternativeName->parentNode->removeChild($alternativeName);
            }
        }
    }

    $placeholders['result_record_id'] = $id;
    $placeholders['name']['id']      = $id;
    $placeholders['name']['repocode']      = $repoCode;
    $placeholders['name']['title']      = $finder->query("//*[@id='nameTitle']")[0]->nodeValue;
    $placeholders['name']['lifedates']  = $finder->query("//*[@class='nameEtryDates']")[0]->nodeValue;
    $placeholders['result_details']     = $finder->query("//*[@id='details']")[0]->C14N();
    $placeholders['pagetitle']          = $placeholders['name']['title'];
    $placeholders['name_description'] = $entityType;
    $placeholders['name_icon'] = $entityIcon;
    $placeholders['result_name'] = $placeholders['name']['title'];

    $modx->setPlaceholders($result['solr_detail'], "solr_data.");
}

$placeholders['sharing_text'] = $placeholders['pagetitle'];

// Set placeholders to page
$modx->toPlaceholders($placeholders);

$result['params_html'] = asi::renderParamsStringDropdown($result['params_json']);
$result['params_json_escaped'] = htmlspecialchars($result['params_json']);
$modx->setPlaceholders($result,'search_result.');

// Set the pagetitle
if(!empty($placeholders['pagetitle'])) {
//    $modx->regClientStartupScript('<script>document.title = "'. $placeholders['pagetitle'] .'";</script>');
}

return;