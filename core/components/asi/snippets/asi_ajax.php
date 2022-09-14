<?php
// this acts as a basic router for most ajax requests so you don't have to keep adding snippets...

$modx->log(\modX::LOG_LEVEL_ERROR, print_r($_REQUEST, 1));

require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

require_once(MODX_CORE_PATH . 'components/geltools/autoload.php');
use GelTools AS Tools;


$APIbase      = $modx->getOption("ape_api");

/*
 *
 *
 * action=list_collections_not_assigned_to_this
 *
 */

// Before accessing global vars lets sanitize and clean them
// recommended, will be applied to all $_GET, $_POST, $_COOKIE
$sanitizedRequests = $modx->sanitize($_REQUEST);
// Reset the array
$_REQUEST = array();
// Assign the sanitized request back
$_REQUEST = $sanitizedRequests;

$success = false;
$response = array('status' => '500', 'message' => 'sorry, something went wrong, please try again.');

switch ($_REQUEST['action']) {

    case "heirarchical_tree":

        $repoCode = $_REQUEST['repositoryCode'];
        $ecId = $_REQUEST['ecid'] ?? $_REQUEST['recordId'] ?? null;
        $cLevelId = $_REQUEST['clevelid'] ?? $_REQUEST['c'] ?? null;
        $unitId = $_REQUEST['unitId'] ?? null;
        $pg = $_REQUEST['page'] ?? 1;
        $rst = $_REQUEST['max'] ?? 10;
        $type = $_REQUEST['type'] ?? 'fa';
        $term = $_REQUEST['term'] ?? null;
        $levelName = $_REQUEST['levelName'];
        $lang = $_REQUEST['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
        $typeDesc = '';
        //https://acceptance.archivesportaleurope.net/Dashboard/eadTreeApi.action?ecId=H30117&xmlTypeName=fa&parentId=332533608
        //https://acceptance.archivesportaleurope.net/Dashboard/eadTreeApi.action?clevelId=C332533608&xmlTypeName=fa&request_locale=en
        //https://acceptance.archivesportaleurope.net/Dashboard/eadTreeApi.action?clevelId=C332533724&xmlTypeName=fa
        $queryString = "{$APIbase}Dashboard/eadTreeApi.action?xmlTypeName={$type}&request_locale={$lang}";
        if (!is_null($ecId)) {
            $queryString .= "&ecId={$ecId}";
        }
        if (!is_null($cLevelId)) {
            $cLevel = substr($cLevelId, '1');
            $queryString .= "&clevelId={$cLevelId}";
        }
        try {
            $treeResponse = json_decode(file_get_contents($queryString));

            header_remove();
            $response['status'] = 200;
            http_response_code($response['status']);
            header('Content-Type: application/json');
            echo json_encode($treeResponse, JSON_PRETTY_PRINT);
            exit();
        } catch (Exception $e) {
            $response['status'] = 400;
            $response['message'] = $e->getMessage();
        }
        break;

    case "translate_label":

        $translate = false;
        $label = $_REQUEST['label'];
        $setName = $_REQUEST['set_name'];
        $lang = $_REQUEST['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
        $modx->lexicon->load($lang . ':asi:solr');
        switch ($setName) {
            case "countries":
            case "datetypes":
            case "topics":
                $translate = true;
                break;

        }
        if ($translate) {
            $modx->lexicon->load($lang . ':asi:solr');
            $translated = $modx->lexicon('asi.' . $label);
            $response['message'] = "Label translated successfully";
        } else {
            $translated = $label;
            $response['message'] = "Label not translated";
        }
        $response['status'] = 200;
        $response['translate'] = $translate;
        $response['result'] = $translated;
        break;
    case "archive_children":

        $repoCode = $_REQUEST['repositoryCode'];
        $eadid = $_REQUEST['eadid'] ?? $_REQUEST['recordId'] ?? null;
        $cLevelId = $_REQUEST['clevelid'] ?? $_REQUEST['c'] ?? null;
        $unitId = $_REQUEST['unitId'] ?? null;
        $pg = $_REQUEST['page'] ?? 1;
        $rst = $_REQUEST['max'] ?? 10;
        $type = $_REQUEST['type'] ?? 'fa';
        $term = $_REQUEST['term'] ?? null;
        $levelName = $_REQUEST['levelName'];
        $filter = $_REQUEST['search'] ?? null;
        $lang = $_REQUEST['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
        $typeDesc = '';
        $queryString = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&eadid={$eadid}&xmlType={$type}&page={$pg}";
        if ($levelName === 'clevel') {
            $cLevel = substr($cLevelId, '1');
            $queryString .= "&clevelid=" . $cLevel . "&type=cdetails";
        }
        if (!is_null($unitId)) {
            $queryString .= "&clevelunitid={$unitId}";
        }

        try {
            $compDetails = json_decode(file_get_contents($queryString));
            $paginationDetails = array();
            $paginationDetails['page'] = $pg;
            $paginationDetails['limit'] = $rst;

            $totalRecords = $compDetails->totalNumberOfChildren;
            $paginationDetails['resultsTotal'] = $totalRecords;
            $total = ceil($totalRecords / $rst);
            $paginationDetails['pageTotal'] = $total;
            //Check and set previous and next page numbers. If they cant go further or back, set to false.
            if ($pg < $total) {
                $paginationDetails['next'] = $pg + 1;
            } else {
                $paginationDetails['next'] = false;
            }
            if ($pg > 1) {
                $paginationDetails['previous'] = $pg - 1;
            } else {
                $paginationDetails['previous'] = false;
            }
            $paginationDetails['show'] = false;
            if ($totalRecords > $rst) {
                $paginationDetails['show'] = true;
            }
            $html = '';

            if ($compDetails->totalNumberOfChildren > 0) {
                $children = asi::domHTML($compDetails->childHtml);
                $childFinder = new DomXPath($children);
                $componentObjects = $childFinder->query("//div[@class='child']");
                foreach ($componentObjects as $componentObject) {
                    $childHTML = $componentObject->C14N();
                    $childDom = asi::domHTML($childHTML);
                    $childObject = new DomXPath($childDom);
                    $componentUnitId = $childObject->query("//td[@class='expand-unitid']")[0]->nodeValue;

                    $componentTitle = $childObject->query("//td[@class='expand-unittitle']")[0]->nodeValue;

                    $componentDate = $childObject->query("//td[@class='expand-unitdate']")[0]->nodeValue;

                    $contentObjects = $childObject->query("//div[@class='childContent']")[0];
                    $childHeaders = $childObject->query("//h2");
                    foreach ($childHeaders as $childHeader) {
                        if (!is_null($childHeader)) {
                            $dObjectsHeader = $childHeader->nodeValue;
                            $h4 = $childDom->createElement('h4');
                            $h4->nodeValue = $dObjectsHeader;
                            $childHeader->parentNode->replaceChild($h4, $childHeader);
//                        $digitalObjectsHeader->parentNode->removeChild($digitalObjectsHeader);
                        }
                    }

                    $digitalObjects = $childObject->query("//div[@class='daolist-orig']/div[@class='dao']/a");
                    foreach ($digitalObjects as $image) {
                        $imageLink = $image->getAttribute('href') ?? '#';
                        $imageCaption = '';
                        $imageThumb = '';
                        foreach ($image->childNodes as $imageItem) {
                            if ($imageItem->tagName === 'img') {
                                $src = $imageItem->getAttribute('src');
                                $dataSrc = $imageItem->getAttribute('data-src');
                                //Note, is_null did not work here and so strlen was used instead
                                if (strlen($src) === 0) {
                                    $imageThumb = $dataSrc;
                                } else {
                                    $imageThumb = $src;
                                }
                                if ($imageThumb[0] === '/') {
                                    $fileName = basename($imageThumb) . PHP_EOL;
                                    $filePath = '/assets/images/placeholders/';
                                    $imageThumb = $filePath . $fileName;
                                }
                                $imageItem->setAttribute('src', $imageThumb);
                            }
                        }
                    }
                    $digitalObjectsOriginalParent = $childObject->query("//div[@class='daolistContainer']/div[@class='linkButton']")[0];
                    if (!is_null($digitalObjectsOriginalParent)) {
                        $digitalObjectsOriginalParent->parentNode->removeChild($digitalObjectsOriginalParent);
                    }
                    $contentChildren = $contentObjects->childNodes;

                    $childReworkHtml = "";
                    if ($contentObjects) {
                        $childReworkHtml .= $contentObjects->C14N();
                    }

                    $c = array();
                    $c['html'] = $childReworkHtml;
                    $c['date'] = $componentDate;
                    $c['title'] = $componentTitle;
                    $c['unitId'] = $componentUnitId;
                    $html .= $modx->getChunk("asi_search_result_archive_component", $c);
                }
            }

            $paginationDetails['html'] = $html;
            $response['status'] = 200;
            $response['message'] = "Pagination results loaded successfully";
            $response['result'] = $paginationDetails;
        } catch (Exception $e) {
            $response['status'] = 400;
            $response['message'] = $e->getMessage();
        }
        break;

    case "institute_archival_materials":

        $repoCode = $_REQUEST['repositoryCode'] ?? $_REQUEST['id'];
        $pg = $_REQUEST['page'] ?? 1;
        $rst = $_REQUEST['max'] ?? 10;
        $type = $_REQUEST['type'] ?? 'fa';
        $term = $_REQUEST['term'] ?? null;
        $filter = $_REQUEST['search'] ?? null;
        $lang = $_REQUEST['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
        $typeDesc = '';
        if ($filter) {
            $filter = urlencode($filter);
        }
        $queryString = "{$APIbase}Dashboard/eagDetailsApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&type={$type}&xmlType={$type}&page={$pg}&max={$rst}";
        if (!is_null($filter)) {
            $queryString .= "&qdb={$filter}";
        }
        try {
            $instDetails = json_decode(file_get_contents($queryString));
            $paginationDetails = array();


            $paginationDetails['page'] = $pg;
            $paginationDetails['limit'] = $rst;
            if ($type === 'ec') {
                $paginationDetails['resultsTotal'] = $instDetails->eacCpfTotalCount;
                $totalRecords = $instDetails->eacCpfTotalCount;
                $total = ceil($totalRecords / $rst);
            } else {
                $paginationDetails['resultsTotal'] = $instDetails->eadTotalCount;
                $totalRecords = $instDetails->eadTotalCount;
                $total = ceil($totalRecords / $rst);
            }

            $paginationDetails['pageTotal'] = $total;

            //Check and set previous and next page numbers. If they cant go further or back, set to false.
            if ($pg < $total) {
                $paginationDetails['next'] = $pg + 1;
            } else {
                $paginationDetails['next'] = false;
            }
            if ($pg > 1) {
                $paginationDetails['previous'] = $pg - 1;
            } else {
                $paginationDetails['previous'] = false;
            }
            $paginationDetails['show'] = false;
            if ($totalRecords > $rst) {
                $paginationDetails['show'] = true;
            }
            $html = '';
            switch ($type) {
                case 'fa':
                    $typeDesc = 'Finding Aid';
                    foreach ($instDetails->fa as $fa) {
                        $eadid = $fa->eadid;
                        $link = "/advanced-search/search-in-archives/results-(archives)/?&repositoryCode={$repoCode}&term={$term}&levelName=archdesc&t=fa&recordId={$eadid}";
                        $html .= $modx->getChunk("asi_finding_aid_item", array(
                            'title' => $fa->title,
                            'recordId' => $eadid,
                            'link' => $link,
                            'type' => $typeDesc
                        ));
                    }
                    break;
                case 'sg':
                    $typeDesc = 'Source Guide';
                    foreach ($instDetails->sg as $sg) {

                        $eadid = $sg->eadid;

                        $link = "/advanced-search/search-in-archives/results-(archives)/?&repositoryCode={$repoCode}&term={$term}&levelName=archdesc&t=sg&recordId={$eadid}";

                        $html .= $modx->getChunk("asi_finding_aid_item", array(
                            'title' => $sg->title,
                            'recordId' => $eadid,
                            'link' => $link,
                            'type' => 'Source Guide'
                        ));

                    }
                    break;
                case 'hg':
                    $typeDesc = 'Holding Guide';
                    foreach ($instDetails->hg as $hg) {
                        $eadid = $hg->eadid;
                        $link = "/advanced-search/search-in-archives/results-(archives)/?&repositoryCode={$repoCode}&term={$term}&levelName=archdesc&t=hg&recordId={$eadid}";
                        $html .= $modx->getChunk("asi_finding_aid_item", array(
                            'title' => $hg->title,
                            'recordId' => $eadid,
                            'link' => $link,
                            'type' => 'Holding Guide'
                        ));

                    }
                    break;
                case 'ec':
                    $typeDesc = 'Name';
                    foreach ($instDetails->ec as $ec) {
                        $eadid = $ec->id;
                        $link = "/advanced-search/search-in-names/results-(names)/?&repositoryCode={$repoCode}&term={$term}&levelName=archdesc&t=ec&recordId={$eadid}";
                        $html .= $modx->getChunk("asi_finding_aid_item", array(
                            'title' => $ec->title,
                            'recordId' => $eadid,
                            'link' => $link,
                            'type' => 'Name'
                        ));
                    }
                    break;
            }


            $paginationDetails['html'] = $html;
            $response['status'] = 200;
            $response['message'] = "Pagination results loaded successfully";
            $response['result'] = $paginationDetails;
        } catch (Exception $e) {
            $response['status'] = 400;
            $response['message'] = $e->getMessage();
        }
        break;

    case "load_topic_suggest":

        $term = $modx->quote("%" . ($_REQUEST['term']) . "%");
        $sql = "SELECT id, pagetitle FROM modx_site_content WHERE parent = 37 AND pagetitle LIKE $term";

        $result = $modx->query($sql);
        if (is_object($result)) {
            $items = $result->fetchAll(\PDO::FETCH_ASSOC);
        }

        $results = array();
        $counter = 0;
        foreach ($items as $k => $v) {
            $results[$counter]['title'] = $items[$k]['pagetitle'];
            $results[$counter]['link'] = $modx->makeUrl($items[$k]['id']);
            $counter++;
        }

        $response['status'] = 200;
        $response['message'] = "Topic suggestions loaded successfully";
        $response['result'] = $results;
        break;

    case "spell":
        //https://acceptance.archivesportaleurope.net/Dashboard/searchSuggestApi.action?term=lond&sourceType=ead
        $term = $_REQUEST['term'];
        $termType = 'ead';
        if ($_REQUEST['section'] === 'search-in-names') {
            $termType = 'eaccpf';
        }
        if ($_REQUEST['section'] === 'search-in-institutions') {
            $termType = 'eag';
        }
        $queryString = "{$APIbase}Dashboard/searchSuggestApi.action?term={$term}&sourceType={$termType}";
        $items = json_decode(file_get_contents($queryString));
        //$items = asi::getSpellingSuggestions($_REQUEST['term'], $_REQUEST['section']);


        $results = array();
        $counter = 0;
        foreach ($items as $item) {
            foreach ($item as $k => $v) {
            $results[$counter]['title'] = $k . " ($v)";
            $results[$counter]['link'] = "/advanced-search/" . $_REQUEST['section'] . "?term=" . $k;
            }
            $counter++;
        }

        $response['status'] = 200;
        $response['message'] = "Spelling loaded successfully";
        $response['result'] = $results;
        break;

    case "suggest":

        $items = asi::getSuggestions($_REQUEST['term'], $_REQUEST['section']);

        $results = array();
        $counter = 0;
        foreach($items AS $k => $v) {
            $results[$counter]['title'] = $k." ($v)";
            $results[$counter]['link'] = "/advanced-search/".$_REQUEST['section']."?term=".$k;
            $counter++;
        }

        $response['status'] = 200;
        $response['message'] = "Suggestions loaded successfully";
        $response['result'] = $results;
        break;

    case "load_map_coords":

        $result = asi::getCoordsForAddress($_REQUEST);
        $response['status'] = 200;
        $response['message'] = "Coords loaded successfully";
        $response['result']['lat'] = $result['lat'];
        $response['result']['lng'] = $result['lng'];
        break;

    case "testXSL2":

        $result = asi::testXSL2();

        break;

    case "testXMLProcess":

        $result = asi::testXMLProcess();

        break;

    case "load_landscapes":

        $result = asi::loadLandscapes($_REQUEST['country_codes'], $_REQUEST['landscapes']);
        $response['status'] = 200;
        $response['message'] = "Coords loaded successfully";
        $response['result'] = json_encode($result);
        break;

    case "nest_landscape":

        $result = asi::nestLandscape($_REQUEST['country_code']);
        asi::dump($result);

        exit();


        $response['status'] = 200;
        $response['message'] = "Coords loaded successfully";
        $response['result'] = json_encode($result);
        break;

    case "test_landscape_solr":

        $result = asi::testLandscapeSolr();

        exit();


        $response['status'] = 200;
        $response['message'] = "Coords loaded successfully";
        $response['result'] = json_encode($result);
        break;

    case "load_landscapes_solr":

        $result = asi::loadLandscapesSolr();
        $response['status'] = 200;
        $response['message'] = "Coords loaded successfully";
        $response['result'] = json_encode($result);
        break;

//    case "load_archive_detail":
//
//        $params = $_REQUEST;
//        $id = $params['recordId'];
//        $term = $params['term'];
//        ini_set('max_execution_time', 0);
//        $result = asi::fetchSingleResult("search-in-archives");
//
//        $gallery_content_slider = null;
//        $gallery_content_caption = null;
//        foreach ($result['images'] AS $image) {
//            $gallery_content_slider .= $modx->getChunk("asi_gallery_content_slider", array(
//                'thumb' => $image['thumb'],
//                'link' => $image['link'],
//                'caption' => $image['caption']
//            ));
//            $gallery_content_caption .= $modx->getChunk("asi_gallery_content_caption", array(
//                'thumb' => $image['thumb'],
//                'link' => $image['link'],
//                'caption' => $image['caption']
//            ));
//            $gallery_content_tab .= $modx->getChunk("asi_gallery_content_tab", array(
//                'thumb' => $image['thumb'],
//                'link' => $image['link'],
//                'caption' => $image['caption']
//            ));
//        }
//
//        $modx->setPlaceholder('gallery_content_slider', $gallery_content_slider);
//        $modx->setPlaceholder('gallery_content_caption', $gallery_content_caption);
//        $modx->setPlaceholder('gallery_content_tab', $gallery_content_tab);
//        $modx->setPlaceholders($result['solr_detail'], "solr_data.");
//        $modx->setPlaceholders($result,'search_result.');
//
//        $response['status'] = 200;
//        $response['message'] = "Archive detail successfully loaded";
//        $response['result']['rhs'] = $modx->getChunk("asi_search_result_archive_rhs");
//        $response['result']['top'] = $modx->getChunk("asi_search_result_archive_top");
//        $response['result']['top_left'] = $modx->getChunk("asi_search_result_archive_top_left");
//        break;

    case "load_archive_detail":
        //        $params = $_REQUEST;
//        $id = $params['recordId'];
//        $term = $params['term'];
//        ini_set('max_execution_time', 0);
//        $result = asi::fetchSingleResult("search-in-archives");


        //TODO Check on tests
        ini_set('max_execution_time', 0);
        $params       = $modx->sanitize($_REQUEST);
        $cLevelId     = $params['c'];

        $originC    = $cLevelId;
        if(isset($params['level']) && $params['level'] === 'archdesc') {
            if($params['type'] === 'hg') {
                $cLevelId = 'H'.$cLevelId;
            }
            if($params['type'] === 'sg') {
                $cLevelId = 'S'.$cLevelId;
            }
            if($params['type'] === 'fa') {
                $cLevelId = 'F'.$cLevelId;
            }
            $params['c'] = $cLevelId;
            $_REQUEST['c'] = $cLevelId;
        } else {
            $first = mb_substr($cLevelId, 0, 1);
            if($first != 'C') {
                $cLevelId = 'C'.$cLevelId;
                $params['c'] = $cLevelId;
                $_REQUEST['c'] = $cLevelId;
            }
        }

        $result = asi::fetchSingleResult("search-in-archives");
        $id           = rawurlencode($params['recordId']);    //Also known as the eadId
        $unitId       = rawurlencode($params['unitId']) ?? null;
        if(isset($result['solr_detail']['reference_value'])) {
            $unitId = $result['solr_detail']['reference_value'];
        }
        $repoCode     = $result['solr_detail']['code_value'] ?? null;
        $term         = $params['term'];
        $type         = $result['solr_detail']['recordType'];
        $levelName    = $result['solr_detail']['levelName'];
        $treeId       = $params['c'];
        $referenceId  = rawurlencode($params['reference']);
        $lang         = $params['lang'] ?? $modx->getOption('cultureKey') ?? 'en';
        if(!is_null($repoCode)) {
            $instDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eagApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&preview=false"));
        }

        $aiId         = $instDetails->aiId;
        $repoCode     = $instDetails->aiRepositoryCode;
        $instDoc    = asi::domHTML($instDetails->html);
        $instFinder = new DomXPath($instDoc);
// Placeholders for institutions
        $placeholders['institution']['name']    = $instFinder->query("//h2[@class='blockHeader']")[0]->nodeValue;
        $placeholders['institution']['country'] = $instFinder->query("//*[contains(@class, 'gel_country gel_contactDetails')]")[0]->nodeValue;

        $output = '';
        $counter = 0;
        $archiveUrl = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode={$repoCode}&request_locale={$lang}&eadid={$id}&xmlType={$type}";
        if($levelName === 'clevel') {
            $cLevel = substr($cLevelId, '1');
            $archiveUrl .= "&clevelid=".$cLevel."&type=cdetails";
            $placeholders['archive']['clevelid'] = $cLevel;
        } else {
            $archiveUrl .= "&type=frontpage";
        }
//        if(!is_null($unitId)) {
//            $encodedUnitId = urlencode($unitId);
//            $archiveUrl .= "&clevelunitid={$encodedUnitId}";
//            $placeholders['archive']['unitid'] = $unitId;
//        }
        
        $placeholders['archive']['repocode'] = $repoCode;
        $placeholders['archive']['type'] = $type;
        $placeholders['archive']['recordid'] = $id;
        $placeholders['archive']['levelname'] = 'clevel';

        $fAidArchiveUrl = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode=".$repoCode."&request_locale={$lang}&eadid=".$id."&type=cdetails&clevelunitid=".$unitId."&xmlType=".$type;
        $FAarchiveDetails = json_decode(file_get_contents($fAidArchiveUrl));
        $archiveDetails = json_decode(file_get_contents($archiveUrl));

        $treeQueryString = "{$APIbase}Dashboard/eadTreeApi.action?xmlTypeName={$type}&request_locale={$lang}";
        if($levelName === 'clevel') {
            $cLevel = substr($cLevelId, '1');
            $treeQueryString .= "&clevelId={$cLevelId}";
        } elseif(!is_null($id)) {
            $treeQueryString .= "&ecId={$treeId}";
        }

        $treeResponse = json_decode(file_get_contents($treeQueryString));
        $placeholders['archive']['tree'] = file_get_contents($treeQueryString);
//echo $archiveDetails->html;
//var_dump('Final stages');
//die();
        $doc = asi::domHTML($archiveDetails->html);
        $finder = new DomXPath($doc);

        //Process EADID Title
        $eadidItem = $finder->query("//div[@class='eadid']")[0];
        if(!is_null($eadidItem)) {
            $placeholders['archive']['eadid']   = $eadidItem->nodeValue;
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


        $titleProper = $finder->query("//h1[@class='titleproper']")[0];
        if(!is_null($titleProper)) {
            $placeholders['archive']['title']   = $titleProper->nodeValue;
            $titleProper->parentNode->removeChild($titleProper);
        }
        $otherFindingAidsInt = $finder->query("//div[@class='otherfindingaids']/div[@class='linkButton']/a");
        foreach ($otherFindingAidsInt as $intLink) {
            $newId = $intLink->getAttribute('href');
            $newHref = "/advanced-search/search-in-archives/results-(archives)/?&repositoryCode=".$repoCode."&term=&levelName=archdesc&t=fa&recordId=".$newId;
            $intLink->setAttribute('href', $newHref);
        }

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
        $digitalObjectsHeader = $finder->query("//h2[@class='dao-list']")[0];
        if(!is_null($digitalObjectsHeader)) {
            $dObjectsHeader = $digitalObjectsHeader->nodeValue;
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
        $digitalObjectsOriginalParent = $finder->query("//div[@class='daolistContainer']")[0];
        if(!is_null($digitalObjectsOriginalParent)) {
            $digitalObjectsOriginalParent->parentNode->removeChild($digitalObjectsOriginalParent);
        }
        $placeholders['archive']['gallery'] = [
            'slider'    => $gallery_content_slider,
            'caption'   => $gallery_content_caption,
            'tab'       => $gallery_content_tab,
        ];

        $placeholders['pagetitle']          = $placeholders['archive']['title'];
        $placeholders['archive']['date']    = $finder->query("//div[@class='subtitle']")[0]->nodeValue;
        $placeholders['archive']['html']    = $doc->saveHTML();
        $archiveDetailTop = $modx->getChunk("asi_search_result_archive_top", array(
            'archive' => $placeholders['archive']
        ));

        $archiveDetailTopLeft = $modx->getChunk("asi_search_result_archive_top_left", array(
            'institution' => $placeholders['institution']
        ));


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
        $result['params_json'] = asi::generateParamsString($result, "archive");

        $archiveDetailRHS = $modx->getChunk("asi_search_result_archive_rhs", array(
            'archive' => $placeholders['archive']
        ));
        
        $gallery_content_slider = null;
        $gallery_content_caption = null;


        $modx->setPlaceholders($result['solr_detail'], "solr_data.");

        $components = null;

        $modx->setPlaceholder('gallery_content_slider', $gallery_content_slider);
        $modx->setPlaceholder('gallery_content_caption', $gallery_content_caption);
        $modx->setPlaceholder('gallery_content_tab', $gallery_content_tab);
        $modx->setPlaceholders($result['solr_detail'], "solr_data.");
        $modx->setPlaceholders($result,'search_result.');
        $response['status'] = 200;
        $response['message'] = "Archive detail successfully loaded";
        $response['result']['rhs'] = $archiveDetailRHS;
        $response['result']['top'] = $archiveDetailTop;
        $response['result']['top_left'] = $archiveDetailTopLeft;

        $response['result']['repoCode'] = $placeholders['archive']['repocode'];
        $response['result']['recordId'] = $placeholders['archive']['recordid'];
        $response['result']['eadId'] = $placeholders['archive']['eadid'];
        $response['result']['clevelId'] = $placeholders['archive']['clevelid'];
        $response['result']['unitId'] = $placeholders['archive']['unitid'];
        $response['result']['levelName'] = $placeholders['archive']['levelname'];
        $response['result']['treeId'] = $treeId;
        $response['result']['type'] = $placeholders['archive']['type'];
        $response['result']['componentMax'] = $placeholders['archive']['components']['limit'];
        $response['result']['compCurrentPg'] = $placeholders['archive']['components']['page'];
        $response['result']['compResultsTotal'] = $placeholders['archive']['components']['resultsTotal'];
        $response['result']['compPageTotal'] = $placeholders['archive']['components']['pageTotal'];


//        var_dump($response['result']);
//        die();
        break;
    case "load_tree_children":
        if($result = asi::loadTreeChildren($_REQUEST['parent_id'],$_REQUEST['type'])) {
        //if($result = asi::loadTreeChildren($_REQUEST['parent_id'], $start=0, $limit=10, $_REQUEST['xmlTypeName'])) {
//            header_remove();
//            $response['status'] = 200;
//            http_response_code($response['status']);
//            header('Content-Type: application/json');
//            echo $result;
//            return;
            $response['status'] = 200;
            $response['message'] = "Tree children successfully loaded";
            $response['result'] = $result;
        }
        break;

    case "load_tree_siblings":
        if($result = asi::loadTreeSiblingsApi($_REQUEST['clevel'], $_REQUEST['parent_id'], $_REQUEST['position'], $_REQUEST['direction'], $_REQUEST['max'])) {
            $response['status'] = 200;
            $response['message'] = "Tree siblings successfully loaded";
            $response['result'] = $result;
        } else {
            $response['status'] = 200;
            $response['message'] = "Tree siblings successfully loaded";
            $response['result'] = "";
        }
        break;

    case "load_tree":
        if($result = asi::fetchTree($_REQUEST['c'], $_REQUEST['unitId'], $_REQUEST['recordId'], $_REQUEST['repoCode'], $_REQUEST['type'])) {
            $response['status'] = 200;
            $response['message'] = "Tree loaded successfully";
            $response['result'] = $result;
        }

        break;
//Below has been rewritten using new API
    case "load_components":
        $response['status'] = 200;
        $response['message'] = "Components bypassed!";
        $html = null;
//        foreach($result['components'] AS $c) {
//            $html .= $modx->getChunk("asi_search_result_archive_component", $c);
//        }
        $response['result'] = $html;
        $response['count'] = 0;
//        if($result = asi::fetchXmlComponents($_REQUEST['recordId'], $_REQUEST['start'])) {
//
//            $response['status'] = 200;
//            $response['message'] = "Components loaded successfully";
//            $html = null;
//            foreach($result['components'] AS $c) {
//                $html .= $modx->getChunk("asi_search_result_archive_component", $c);
//            }
//            $response['result'] = $html;
//            $response['count'] = $result['components_count'];
//        }
        break;

    case "update_preference_delete_confirm":
        if($result = asi::updateUserPrefConfirmDelete($_REQUEST['value'])) {
            $response['status'] = 200;
            $response['message'] = "Preference updated successfully";
            $response['result'] = true;
        }
        break;

    case "search_params_show":
        if($search = asi::getSearchById($_REQUEST['id'])) {
            $search['params_html'] = asi::renderParametersHtml($search['params'], "ACCOUNT_SAVED_SEARCH");
            $response['status'] = 200;
            $response['message'] = "Params fetched successfully";
            $response['result'] = $search['params_html'];
        }
        break;

    case "save_search":

        if($response['search_id'] = asi::saveSearch($_REQUEST)) {

            $response['status'] = 200;
            $response['message'] = "Search saved successfully";
        }
        break;

    case "save_bookmark":
        if($response['bookmark_id'] = asi::saveBookmark($_REQUEST)) {
            $response['status'] = 200;
            $response['message'] = "Bookmark saved successfully";
        }
        break;

    case "save_collection":
        if(asi::saveCollection($_REQUEST) == true) {
            $response['status'] = 200;
            $response['message'] = "Collection saved successfully";
        }
        break;

    case "list_collections":
        $result = asi::listCollections();
        $response['status'] = 200;
        $response['message'] = "Collections fetched successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "list_collections_not_assigned_to_this":
        $result = asi::listCollectionsNotAssignedToThis($_REQUEST['target'], $_REQUEST['target_id']);
        $response['status'] = 200;
        $response['message'] = "Collections fetched successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "add_search_to_collection":
        $search = asi::getSearchById($_REQUEST['item_id']);
        $collection = asi::getCollectionById($_REQUEST['collection_id']);
        $result = asi::addSearchToCollection($search, $collection);
        $response['status'] = 200;
        $response['message'] = "Search added to collection successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "remove_search_from_collection":
        $search = asi::getSearchById($_REQUEST['item_id']);
        $collection = asi::getCollectionById($_REQUEST['collection_id']);
        $result = asi::removeSearchFromCollection($search, $collection);
        $response['status'] = 200;
        $response['message'] = "Search removed from collection successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "remove_bookmark_from_collection":
        $bookmark = asi::getBookmarkById($_REQUEST['item_id']);
        $collection = asi::getCollectionById($_REQUEST['collection_id']);
        $result = asi::removeBookmarkFromCollection($bookmark, $collection);
        $response['status'] = 200;
        $response['message'] = "Bookmark removed from collection successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "add_bookmark_to_collection":
        $bookmark = asi::getBookmarkById($_REQUEST['item_id']);
        $collection = asi::getCollectionById($_REQUEST['collection_id']);
        $result = asi::addBookmarkToCollection($bookmark, $collection);
        $response['status'] = 200;
        $response['message'] = "Bookmark added to collection successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "account_saved_search_list":
        $result = $modx->runSnippet("asi_account_saved_searches", array('request' => $_REQUEST));
        $response['status'] = 200;
        $response['message'] = "Searches fetched successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "account_saved_search_delete":
        //var_dump($_REQUEST);
        $result = asi::deleteSearch($_REQUEST['id']);
        $response['status'] = 200;
        $response['message'] = "Search deleted successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "account_saved_bookmark_delete":
        //var_dump($_REQUEST);
        $result = asi::deleteBookmark($_REQUEST['id']);
        $response['status'] = 200;
        $response['message'] = "Bookmark deleted successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "account_saved_collection_delete":
        //var_dump($_REQUEST);
        $result = asi::deleteCollection($_REQUEST['id']);
        $response['status'] = 200;
        $response['message'] = "Collection deleted successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "account_saved_bookmark_list":
        $result = $modx->runSnippet("asi_account_saved_bookmarks", array('request' => $_REQUEST));
        $response['status'] = 200;
        $response['message'] = "Bookmarks fetched successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "account_saved_collection_list":
        $result = $modx->runSnippet("asi_account_saved_collections", array('request' => $_REQUEST));
        $response['status'] = 200;
        $response['message'] = "Collections fetched successfully";
        $response['result'] = $result;
        $modx->log(\modX::LOG_LEVEL_ERROR, print_r($result, 1));
        break;

    case "inline_update":
    {

        $id = $_REQUEST['id'];
        $data = array($_REQUEST['field'] => $_REQUEST['val']);

        switch ($_REQUEST['entity']) {

            case "search":
                $result = asi::updateSearch($id, $data);
                $response['status'] = 200;
                $response['message'] = "Search successfully updated";
                $response['result'] = $result;
                break;

            case "bookmark":
                $result = asi::updateBookmark($id, $data);
                $response['status'] = 200;
                $response['message'] = "Bookmark successfully updated";
                $response['result'] = $result;
                break;

            case "collection":
                $result = asi::updateCollection($id, $data);
                $response['status'] = 200;
                $response['message'] = "Collection successfully updated";
                $response['result'] = $result;
                break;

            default:
                return new \Exception("Inline update entity could not be found.");
        }
        break;
    }

    default:
        return new \Exception("Action could not be found.");
}

header_remove();
http_response_code($response['status']);
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);