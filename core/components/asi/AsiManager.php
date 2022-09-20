<?php

/**
 * GEL Studios Asi Manager class
 *
 * Peer class for loading data from API / Database
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     GEL Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 */

namespace asi;


use asi\fixtures\FixturesManager as Fixtures;
use Composer\Package\Package;
use asi\landscapes\Landscape;
use asi\landscapes\LandscapeChild;
use Genkgo\Xsl\XsltProcessor;
use Genkgo\Xsl\Cache\NullCache;

class AsiManager
{

    protected static $modx;
    protected static $cron_log = null;
    public static $debug = false;
    protected static $image_limit = 100;

    // results
    protected static $results;
    protected static $single_result;
    protected static $filter_results;
    protected static $count;
    protected static $start;
    protected static $end;

    // request
    protected static $results_per_page = 10;
    protected static $request_result_start;

    public static $deleteSalt;
    public static $mode = "LIVE";

    protected static $solr_core;
    protected static $postgre_init = false;

    public static $gmap_hash_salt = "APE2020_new_website";
    protected static $landscape_path = MODX_CORE_PATH . '../uploads/landscapes/';


    // error logging
    public static function logError($msg)
    {
        $modx = self::$modx;
        $modx->log(\modX::LOG_LEVEL_ERROR, $msg);
    }

    // initialises the class, sets globals etc
    public static function init($modx)
    {
        self::$modx = $modx;
        require_once MODX_CORE_PATH . 'components/geltools/autoload.php';

        if (self::$debug == true) {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        }

        $modx->addPackage('asi', MODX_CORE_PATH . 'components/asi/model/', 'modx_');
    }

    // grabs (list) results (from the ajax request) and brings back tests or real results from solr and feeds it onto vars
    public static function paginateApiResults($pg = 1, $rst = 10, $recordTotal, $recordDetails, $recordHtml)
    {
        $pg = 1;
        $rst = 10;
        $paginationDetails  = array();
        $total = ceil($recordTotal / $rst);
        $paginationDetails['page'] = $pg;
        $paginationDetails['limit'] = $rst;
        $paginationDetails['resultsTotal'] = $recordTotal;
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
        if ($recordTotal > $rst) {
            $paginationDetails['show'] = true;
        }
        return json_encode($paginationDetails, JSON_PRETTY_PRINT);
    }

    // grabs (list) results (from the ajax request) and brings back tests or real results from solr and feeds it onto vars
    public static function fetchResults($params)
    {
        $term = $params['term'];
        $start = ($params['page'] == 1) ? 0 : (($params['page'] - 1) * self::$results_per_page);
        self::$request_result_start = $start;

        if (self::$mode == "TEST") {
            // we crate 2 sets, one that is paginated for results, and one that isn't for filters
            self::$results = Fixtures::getResultSet($term, self::translate_params($params), self::$results_per_page, $start);
            //var_dump(self::$results);
            self::$filter_results = Fixtures::getResultSet($term, self::translate_params($params));
            //var_dump(self::$filter_results);
        } else {
            // for live, we use the facets for the filters
            $results = self::getSolrResults($term, $params);

            self::$results = $results['results'];
            self::$filter_results = $results['filters'];
            self::$count = $results['count'];
            self::$start = $results['start'];
            self::$end = $results['end'];
        }
        return self::$results;
    }

    public static function fetchSolrDetail($solr_record_id, $section)
    {

        $data = self::getSolrSingleResult($solr_record_id, $section);

        // @TODO - move this somewhere else?
        $data['results'][$solr_record_id]['country_name'] = self::cleanLabel($data['results'][$solr_record_id]['country_value']);
        return $data['results'][$solr_record_id];
    }

    protected static function getSolrUrl($core)
    {
        $modx = self::$modx;

        return 'http://' . $modx->getOption("solr_address") . ':' . $modx->getOption("solr_port") . '/solr/' . $core . '/';
    }

    protected static function getSolrCore($section)
    {
        $modx = self::$modx;
        switch ($section) {
            case "search-in-archives":
                return $modx->getOption("solr_core_archives");
                break;
            case "search-in-names":
                return $modx->getOption("solr_core_names");
                break;
            case "search-in-institutions":
                return $modx->getOption("solr_core_inst");
                break;
            default:
                throw new \Exception(__METHOD__ . " did not recognise section!");
                break;
        }
    }

    public static function getSpellingSuggestions($term, $section)
    {
        $query = urlencode($term);

        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/Service.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/Curl.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/FileGetContents.php');

        $transport = new \Apache_Solr_HttpTransport_FileGetContents;
        $results = $transport->performGetRequest(self::getSolrUrl(self::getSolrCore($section)) . "terms?terms.fl=spell&terms.prefix=" . $query . "&wt=php");
        $arr = $results->getBody();

        $result = array();
        eval('$result = ' . $arr . ";");
        return $result['terms']['spell'];
    }


    public static function getSuggestions($term, $section)
    {
        $query = urlencode($term);

        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/Service.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/Curl.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/FileGetContents.php');
        $transport = new \Apache_Solr_HttpTransport_FileGetContents;
        $results = $transport->performGetRequest(self::getSolrUrl(self::getSolrCore($section)) . "select?q=" . $query . "&qt=list&spellcheck=true&spellcheck.collate=true&wt=php");

        $arr = $results->getBody();

        $result = array();
        eval('$result = ' . $arr . ";");

        $response = array();
        $spell_checks = $result['spellcheck']['collations'];
        foreach ($spell_checks as $k => $v) {
            $response[$spell_checks[$k]['collationQuery']] = $spell_checks[$k]['hits'];
        }
        return $response;
    }

    public static function getSuggestions2($term, $section)
    {
        $query = urlencode($term);

        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/Service.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/Curl.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/FileGetContents.php');

        $transport = new \Apache_Solr_HttpTransport_FileGetContents;
        $results = $transport->performGetRequest(self::getSolrUrl(self::getSolrCore($section)) . "select?q=" . $query . "&qt=list&spellcheck=true&spellcheck.collate=true&wt=json");

        // self::dump($results);
    }

    public static function testLandscapeSolr()
    {

        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_inst");
        $solr = self::getSolr($core);
        $query = "*";

        // @TODO - add facet params

        $additionalParameters = array(
            //'qt' => "list",
            'facet' => 'true',
            'facet.field' => array(
                'country',
                'aiGroupsFacet',
                'aiGroups',
                'repositoryTypeFacet',
                'type_value',
            )
        );

        $additionalParameters['df'] = "name";
        $additionalParameters['defType'] = "edismax";

        $results = self::processSolrResults($solr, $query, $additionalParameters);
        // self::dump($results);
        exit();
    }


    public static function nestLandscape($country_code = "DE")
    {

        // first fetch all the nodes - it's different for each country
        // and even different within each country
        // so we put these into much cleaner objects

        $xml_filepath = self::$landscape_path . $country_code . "AL.xml";
        $xmlObj = simplexml_load_file($xml_filepath);
        $landscapesXml = $xmlObj->archdesc->dsc->c->c;

        $counter = 0;
        foreach ($landscapesXml as $k => $v) {
            $landscapes[$counter] = new Landscape($counter, $v->did->unittitle[0]->__toString());
            self::findLandscapeChildren($v, $landscapes[$counter]);
            $counter++;
        }

        // now we traverse through the tree nodes, collecting the parents
        $flat = array();
        $flat = self::traverseChildren($landscapes[0], $flat);

        echo "<h2>Flat</h2>";
        // self::dump($flat);

        echo "<h2>Original</h2>";
        //self::dump($landscapes);

        exit();
        return $results;
    }

    // recursively traverses the branches, fetching end nodes, prepending the ancestors
    public static function traverseChildren($parent, $flat, $name = null)
    {
        foreach ($parent->getChildren() as $child) {
            if ($child->hasChildren() == true) {
                if (is_null($name)) {
                    $flat = self::traverseChildren($child, $flat, $child->getValue());
                } else {
                    $flat = self::traverseChildren($child, $flat, $name . " : " . $child->getValue());
                }
            } else {
                if (is_null($name)) {
                    $flat[] = $child->getValue();
                } else {
                    $flat[] = $name . " : " . $child->getValue();
                }
            }
        }
        return $flat;
    }

    public static function findLandscapeChildren($xmlLandscape, $parent)
    {

        $results = array();
        $counter = 0;
        foreach ($xmlLandscape->c as $k => $v) {
            $child = new LandscapeChild($counter, $v->did->unittitle[0]->__toString());
            $parent->addChild($child);

            if (is_object($v))
                self::findLandscapeChildren($v, $child);
            $counter++;
        }
        return $results;
    }

    // takes an array of landscape codes and loads the details into an array
    public static function loadLandscapesSolr()
    {

        $modx = self::$modx;

        $landscapes = array();
        $institutions = array();

        $country_landscapes = array();
        if (isset($_REQUEST['landscapes'])) foreach ($_REQUEST['landscapes'] as $k => $v) {
            $parts = explode("_", $v);
            $country_landscapes[$parts[0]][] = $parts[1];
        }

        foreach ($_REQUEST['countries'] as $country) {
            self::$solr_core = $core = $modx->getOption("solr_core_inst");
            $solr = self::getSolr($core);
            $query = "*";
            $fData = array(
                0 => "{!tag=country}country:(" . self::escapeSolrValue($country) . ")"
            );

            if (isset($country_landscapes[$country])) {
                $groups = array();
                foreach ($country_landscapes[$country] as $kl => $vl) {
                    $groups[] = self::escapeSolrValue($vl);
                }
                $fData[] = "aiGroupsFacet:(" . implode(" OR ", $groups) . ")";
            }

            $additionalParameters = array(
                'facet' => 'true',
                'facet.field' => array(
                    'country',
                    'aiGroupsFacet',
                    'aiGroups',
                    'repositoryTypeFacet',
                ),
                'fq' => $fData,
            );

            $additionalParameters['df'] = "name";
            $additionalParameters['defType'] = "edismax";
            $results = self::processSolrResults($solr, $query, $additionalParameters, false, true);
            $landscapes[$country] = self::cleanLandscapes($results);
            $institutions[$country] = self::formatLandscapeInstitutionNames($results);
        }
        $output = array("landscapes" => $landscapes, "institutions" => $institutions);
        return $output;
    }

    protected static function cleanCountry($name)
    {
        $parts = explode(":", $name);
        $label = $parts[0];
        return $label;
    }

    protected static function cleanCountries($results)
    {
        $clean = array();
        foreach ($results['filters']['countries'] as $k => $v) {
            if ($v > 0) $clean[] = $k;
        }
        return $clean;
    }

    protected static function cleanLandscapes($results)
    {
        $clean = array();
        foreach ($results['filters']['aiGroupsFacet'] as $k => $v) {
            if ($v > 0) $clean[] = $k;
        }
        return $clean;
    }

    protected static function formatLandscapeInstitutionNames($results)
    {
        $clean = array();
        foreach ($results['results'] as $r) {
            $parts = array();
            if (isset($r['aiGroupsFacet'])) {
                $parts[] = self::cleanLabel($r['aiGroupsFacet']);
            }
            /*
            if(isset($r['type_value'])) {
                $parts[] = $r['type_value'];
            }
	*/
            $parts[] = $r['institution_value'];
            $clean[] = implode(" : ", $parts);
        }
        return $clean;
    }

    protected static function processLandscapeParams()
    {

        $params['filters'] = array();
        if (isset($_REQUEST['countries'])) {
            foreach ($_REQUEST['countries'] as $k => $v) {
                $params['filters']['countries'][] = $v;
            }
        }
        if (isset($_REQUEST['landscapes'])) {
            foreach ($_REQUEST['landscapes'] as $k => $v) {
                $params['filters']['landscapes'][] = $v;
            }
        }
        return $params;
    }


    // takes an array of landscape codes and loads the details into an array
    public static function loadLandscapes($country_codes_arr, $landscape_codes_arr = array())
    {

        $landscapes = array();
        foreach ($country_codes_arr as $v) {
            if (self::countryHasLandscapes($v)) {
                $landscapes[$v] = self::loadCountryLandscapes($v);
            } else {
                $institutions[$v] = self::loadCountryLandscapes($v);
            }
        }
        foreach ($landscape_codes_arr as $l) {
            $institutions[$l] = self::loadLandscapeInstitutions($l);
        }
        return array("landscapes" => $landscapes, "institutions" => $institutions);
    }

    public static function countryHasLandscapes($country_code)
    {
        $xml_filepath = self::$landscape_path . $country_code . "AL.xml";
        $xmlObj = simplexml_load_file($xml_filepath);
        $landscapesXml = $xmlObj->archdesc->dsc->c->c;

        $counter = 0;
        foreach ($landscapesXml as $k => $v) {
            $landscapes[$counter] = new Landscape($counter, $v->did->unittitle[0]->__toString());
            self::findLandscapeChildren($v, $landscapes[$counter]);
            $counter++;
        }
        $flat = array();
        $flat = self::traverseChildren($landscapes[0], $flat);
        return count($flat);
    }

    // takes the single country code and loads the detail into an array
    public static function loadCountryLandscapes($country_code)
    {

        $xml_filepath = self::$landscape_path . $country_code . "AL.xml";
        $xmlObj = simplexml_load_file($xml_filepath);
        return self::formatLandscapeXML($xmlObj)['landscapes'];
    }

    // takes the single landscape code and loads the detail into an array
    public static function loadLandscapeInstitutions($landscape_code)
    {

        $parts = explode("_", $landscape_code);
        $xml_filepath = self::$landscape_path . $parts[0] . "AL.xml";
        $xmlObj = simplexml_load_file($xml_filepath);
        $flat = self::loadFlattenedLandscapeInstitutions($xmlObj, $parts[1]);
        return $flat;
    }

    public static function loadFlattenedLandscapeInstitutions($xmlObj, $key)
    {

        $landscapesXml = $xmlObj->archdesc->dsc->c->c;
        $counter = 0;
        foreach ($landscapesXml as $k => $v) {
            $landscapes[$counter] = new Landscape($counter, $v->did->unittitle[0]->__toString());
            self::findLandscapeChildren($v, $landscapes[$counter]);
            $counter++;
        }

        // now we traverse through the tree nodes, collecting the parents
        $flat = array();
        $flat = self::traverseChildren($landscapes[$key], $flat);

        return $flat;
    }

    // takes the single landscape code and loads the detail into an array
    public static function loadLandscapeInstitutionsOLD($landscape_code)
    {

        $parts = explode("_", $landscape_code);
        $xml_filepath = self::$landscape_path . $parts[0] . "AL.xml";
        $xmlObj = simplexml_load_file($xml_filepath);
        $depth = ($parts[0] == "DE") ? 2 : 1;
        return self::formatLandscapeXML($xmlObj, $depth)['institutions'][$parts[1]];
    }

    // formats the XML for the landscape
    public static function formatLandscapeXML($xmlObj, $depth = 1)
    {

        $landscapes = array();
        $xmllandscapes = $xmlObj->archdesc->dsc->c->c;
        $counter = 0;
        foreach ($xmllandscapes as $k => $v) {
            $landscapes[$counter] = $v->did->unittitle[0]->__toString();
            foreach ($v->c as $ik => $iv) {
                if ($depth == 2) {
                    //self::dump($iv);
                    foreach ($iv->c as $iik => $iiv) {
                        $institutions[$counter][] = $iiv->did->unittitle[0]->__toString() . "::";
                    }
                    //$institutions[$counter][] = $iv->did->unittitle[0]->__toString()."::";
                } else {
                    $institutions[$counter][] = $iv->did->unittitle[0]->__toString();
                }
            }
            $counter++;
        }

        //self::dump($landscapes);
        //self::dump($institutions);
        //self::dump($xmlObj);

        return array("landscapes" => $landscapes, "institutions" => $institutions);
    }


    // stores relevant params into json string
    public static function generateParamsString($data, $section, $addSlashes = false)
    {


        switch ($section) {
            case "archive":

                $params = array(
                    "title" => $data['title_value'],
                    "country" => $data['solr_detail']['country_name'],
                    "archival_institution" => $data['institution_value'],
                    "document_date" => $data['date_display_value'],
                    "reference" => $data['solr_detail']['recordId'],
                );

                if ($data['solr_detail']['recordType'] == "fa") {
                    $params['finding_aid'] = self::cleanLabel($data['solr_detail']['F0_s']);
                }

                if ($data['solr_detail']['recordType'] == "hg") {
                    $params['holdings_guide'] = self::cleanLabel($data['solr_detail']['F0_s']);
                }

                break;
            case "name":

                $params = array(
                    "name" => $data['title_value'],
                    "country" => $data['solr_detail']['country_name'],
                    "archival_institution" => $data['agency_name'],
                    "document_date" => $data['solr_detail']['dateDescription'],
                    "reference" => $data['solr_detail']['recordId'],
                    'identifier' => $data['identifier'],
                );

                break;
            case "institution":

                $params = array(
                    "name" => $data['agency_name'],
                    "country" => $data['country_name'],
                    'identifier' => $data['fas'][0]['eadid'],
                );

                break;
        }

        $json = json_encode($params);

        if ($addSlashes) return addslashes($json);
        return $json;

        //self::dump($data);

    }

    public static function getCoordsForAddress($request)
    {

        // this function checks the hash for security
        // checks the cache and loads the cache or makes a new one

        $request_hash = $request['hash'];
        $request_add = urlencode($request['address']);
        $check_hash = sha1(self::$gmap_hash_salt . $request_add);

        if ($request_hash == $check_hash) {

            $modx = self::$modx;
            $obj = $modx->getObject("MapCoords", array("address_hash" => $check_hash));

            if (is_object($obj)) {
                $response['lat'] = $obj->get('lat');
                $response['lng'] = $obj->get('lng');
                return $response;
            } else {
                $geocode = self::geocode(false, $request_add);
                $response['lat'] = $geocode[0];
                $response['lng'] = $geocode[1];
                $add = $geocode[2];

                $coord = $modx->newObject('MapCoords', array(
                    'address_hash' => $check_hash,
                    'lat' => $response['lat'],
                    'lng' => $response['lng'],
                    'address' => $add,
                    'salt' => self::$gmap_hash_salt,
                ));
                $coord->save();

                return $response;
            }
        }
        return false;
    }

    public static function geocode($address = false, $url_encoded_address = false)
    {

        $modx = self::$modx;

        // url encode the address
        if ($url_encoded_address) {
            $address = $url_encoded_address;
        } else {
            $address = urlencode($address);
        }

        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=" . $modx->getOption('gmaps_api_key');

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {

            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

            // verify if data is complete
            if ($lati && $longi && $formatted_address) {

                // put the data in the array
                $data_arr = array();

                array_push(
                    $data_arr,
                    $lati,
                    $longi,
                    $formatted_address
                );

                return $data_arr;
            } else {
                return false;
            }
        } else {
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }

    // renders params json string into a list for view
    public static function renderParamsString($json)
    {

        $params = json_decode($json);

        $html = null;
        foreach ($params as $k => $v) {
            $html .= "<li>" . self::getIcon($k) . "<strong>$k:</strong> $v</li>";
        }

        return $html;
    }

    // renders params json string into a list for view with a dropdown
    public static function renderParamsStringDropdown($json)
    {

        $params = json_decode($json);

        $counter = 0;
        $html = "<div class=\"title\">";
        foreach ($params as $k => $v) {
            $label = str_replace("_", " ", $k);
            $label = ucfirst($label);
            if ($counter == 1) {
                $html .= "</div><div class=\"inner\">";
            }
            if ($counter == 0) {
                $html .= "<i class='fas fa-file'></i><strong>" . $label . ":</strong> " . $v;
            } else {
                $html .= "<li>" . self::getIcon($k) . "<strong>$label:</strong> $v</li>";
            }
            $counter++;
        }
        $html .= "</div>";

        return $html;
    }

    public static function getIcon($field_name)
    {

        switch (strtolower($field_name)) {
            case "country":
                $icon = "fa-globe-europe";
                break;
            case "archival_institution":
                $icon = "fa-landmark";
                break;
            case "finding_aid":
                $icon = "fa-bars";
                break;
            case "holdings_guide":
                $icon = "fa-bars";
                break;
            case "document_date":
                $icon = "fa-calendar-alt";
                break;
            case "reference":
                $icon = "fa-hashtag";
                break;
            case "identifier":
                $icon = "fa-hashtag";
                break;
            case "name":
                $icon = "fa-file";
                break;
            case "title":
                $icon = "fa-file";
                break;
        }

        return "<i class=\"fas " . $icon . "\"></i>";
    }

    public static function loadTreeChildren($parent_id, $type, $start=0, $limit=10) {

        $output ='';
        $modx = self::$modx;
        $APIbase = $modx->getOption("ape_api");
        //Testing for root level
        $rootLevel = false;
        $first = mb_substr($parent_id, 0, 1);
        if($first === 'F') {
            $type = 'fa';
            $rootLevel = true;
        } elseif($first === 'H') {
            $type = 'hg';
            $rootLevel = true;
        }
        elseif($first === 'S') {
            $type = 'sg';
            $rootLevel = true;
        }
            if($rootLevel){

                $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&ecId={$parent_id}"));
            } else {

                $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&parentId={$parent_id}"));
            }
        $output = "<ul>";
        foreach ($treeDetails as $treeDetail) {
            if (isset($treeDetail->more)) { // up button (if req)
                if($treeDetail->more === 'before') {
                    $output .= "<li class='parent open' data-trigger='load_tree_siblings' data-direction='UP' data-max='$treeDetail->max' data-position='" . $treeDetail->orderId . "' data-id='" . $treeDetail->parentId . "'>";
                    $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
                    $output .= "</li>";
                } else {
                    $output.="<li class='parent open' data-trigger='load_tree_siblings' data-direction='DOWN' data-max='$treeDetail->max' data-position='" . $treeDetail->orderId . "' data-id='" . $treeDetail->parentId . "'>";
                    $output .= "<br /><span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
                    $output.="</li>";
                }
            } else {
                if($treeDetail->isFolder === true) {
                    $output .= "<li class='parent' data-trigger='load_tree_children' data-position='' data-id='" . $treeDetail->id . "' data-unitid=''>";
                    $output .= "<i class=\"fas fa-caret-right openGroup\"></i><a>" . $treeDetail->title . "</a>";
                    $output .= "</li>";
                } else {
                    $output .= "<li class='parent' data-trigger='load_tree_children' data-position='' data-id='" . $treeDetail->id . "' data-unitid=''>";
                    $output .= "<a>" . $treeDetail->title . "</a>";
                    $output .= "</li>";
                }


//                $position_counter++;
            }
        }
        $output .= "</ul>";
        return array("children" => $output);

        $limit = ($limit+1); // checking for more

        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_archives");
        $solr = self::getSolr($core);
        $query = $parent_id . " AND !id:" . $parent_id;

        $additionalParameters = array(
            'df' => 'parentId',
            'sort' => 'orderId asc',
        );

        try {
            $s_results = $solr->search($query, $start, $limit, $additionalParameters);
        } catch (Exception $e) {
            self::logError("SOLR ERROR - " . print_r($e, 1));
            return false;
        }

        // @TODO - see function below, this is a dupe which can be refactored (except the UL)

        if (count($s_results->response->docs) == $limit) { // there's more to come
            $show_more = true;
            array_pop($s_results->response->docs); // punch out the extra record
        } else {
            $show_more = false;
        }
        $counter = 0;
        foreach ($s_results->response->docs as $doc) {
            $items[$counter]['id'] = $doc->id;
            if (isset($doc->unitTitle)) {
                $items[$counter]['label'] = $doc->unitTitle;
            } else {
                //TODO add in lexicon value for below
                $items[$counter]['label'] = 'No title specified';
            }
            $items[$counter]['recordId'] = $doc->recordId;
            $items[$counter]['descendents'] = $doc->numberOfDescendents;
            // @TODO ->numberOfDescendents (for drill down)
            $counter++;
        }

        $position_counter = $start;
        $output = "<ul>";
        if ($start > 0) { // up button (if req)
            $output .= "<li class='parent open' data-trigger='load_tree_siblings' data-direction='UP' data-position='" . $position_counter . "' data-id='" . $items[0]['id'] . "'>";
            $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
            $output .= "</li>";
        }
        foreach ($items as $k => $v) { // loop of siblings
            $output .= "<li class='parent' data-trigger='load_tree_children' data-position='" . $position_counter . "' data-id='" . $items[$k]['id'] . "'>";
            if ($items[$k]['descendents'] > 0) {
                $output .= "<i class=\"fas fa-caret-right openGroup\"></i><a>" . $items[$k]['label'] . "</a>";
            } else {
                $output .= "<a>" . $items[$k]['label'] . "</a>";
            }

            $output .= "</li>";
            $position_counter++;
        }
        if ($show_more == true) { // down button (if req)
            $output .= "<li class='parent open' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='" . $position_counter . "' data-id='" . $items[(count($items) - 1)]['id'] . "'>";
            $output .= "<br /><span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
            $output .= "</li>";
        }
        $output .= "</ul>";

        return array("children" => $output);
    }

    public static function fetchTree($solr_record_id, $solr_unit_id, $recordId = null, $repoCode = null, $type = null)
    {
        $modx = self::$modx;
        $APIbase = $modx->getOption("ape_api");
        if($solr_record_id === 'undefined') {
            if($solr_unit_id === 'undefined') {
                $archiveUrl = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode={$repoCode}&request_locale=en&eadid={$recordId}&type=cdetails&xmlType={$type}";
                $archiveDetails = json_decode(file_get_contents($archiveUrl));
                $solr_record_id = $archiveDetails->clevelid;
            }
            else {
                $archiveUrl = "{$APIbase}Dashboard/eadApi.action?aiRepositoryCode={$repoCode}&request_locale=en&eadid={$recordId}&type=cdetails&xmlType={$type}&clevelunitid={$solr_unit_id}";
                $archiveDetails = json_decode(file_get_contents($archiveUrl));
                $solr_record_id = 'C'.$archiveDetails->clevelid;
            }
            if(is_null($solr_record_id)) {
                $html = '<p>Unable to find sub groups</p>';
                return $html;
            }
        }
        $data = self::getSolrSingleResult($solr_record_id, "archive");
        $type = $data['results'][$solr_record_id]['recordType'];
        $array = $data['results'][$solr_record_id];
        $html = self::buildTreeNodesApi($solr_record_id, $type, $array);
        //$html = self::buildTreeNodes($data['results'][$solr_record_id], null, 0);

        return $html;
//        $data = self::getSolrSingleResult($solr_record_id, "archive");
//        $array = $data['results'][$solr_record_id];
//        $APIbase = $modx->getOption("ape_api");
//        $TreeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?clevelId={$array['id']}&xmlTypeName={$array['recordType']}"));
////        var_dump($array);
//        $json_pretty = json_encode($TreeDetails, JSON_PRETTY_PRINT);
//        return $json_pretty;
//        echo "<pre>".$json_pretty."<pre/>";
//
//        $html = self::buildTreeNodes($data['results'][$solr_record_id], null, 0);
//
//        return $html;
    }

    public static function loadTreeSiblings($parent_id, $position, $direction = "UP", $limit = 10)
    {
        $position = intval($position);


//        $APIbase = $modx->getOption("ape_api");
//        $TreeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?parentId={$parent_id}&xmlTypeName={$type}&more={$direction}&max={$limit}&orderId={$order}"));
//        $json_pretty = json_encode($TreeDetails, JSON_PRETTY_PRINT);
//        return $json_pretty;
            $startPosition = $position;
        if($direction == "UP") { // before / left (items with a lower order id)
            //This stops the duplication of the clicked on before result.

            $start = ($position) - $limit;

            if ($start < 0) {
                $start = 0;
                $limit = $position;
            }
        } else {
            $start = $position + 1;
            $limit = $limit + 1; // checking for more
        }

        // var_dump($start);
        // var_dump($limit);

        //echo "start is ".$start." limit is ".$limit;

        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_archives");
        $solr = self::getSolr($core);
        $query = $parent_id . " AND !id:" . $parent_id;

        $additionalParameters = array(
            'df' => 'parentId',
            'sort' => 'orderId asc',
        );

        try {
            $s_results = $solr->search($query, $start, $limit, $additionalParameters);
        } catch (Exception $e) {
            self::logError("SOLR ERROR - " . print_r($e, 1));
            return false;
        }

        //self::dump($s_results->response->docs);
        if ($direction == "DOWN") {
            if (count($s_results->response->docs) == $limit) { // there's more to come
                $show_more = true;
                array_pop($s_results->response->docs); // punch out the extra record
            } else {
                $show_more = false;
            }
        }

        $counter = 0;
        foreach ($s_results->response->docs as $doc) {
            $items[$counter]['id'] = $doc->id;
            $items[$counter]['label'] = $doc->unitTitle;
            //$items[$counter]['label'] = $doc->titleProper;
            $items[$counter]['recordId'] = $doc->recordId;
            if (isset($doc->unitId)) {
                $items[$counter]['unitId'] = $doc->unitId;
            }
            // @TODO ->numberOfDescendents (for drill down)
            $counter++;
        }


        $position_counter = $start;
        $output = null;

        if ($start > 0 && $direction != "DOWN") { // up button (if req)
            $output .= "<li class='parent open' data-trigger='load_tree_siblings' data-direction='UP' data-position='" . $position_counter . "' data-id='" . $items[0]['id'] . "'>";
            $output .= "<span class='moreBefore'>More before <i class='fas fa-angle-up'></i></span>";
            $output .= "</li>";
        }
        foreach ($items as $k => $v) { // loop of siblings

            $output .= "<li class='parent' data-trigger='load_tree_children' data-position='" . $position_counter . "' data-id='" . $items[$k]['id'] . "' data-unitid='" . $items[$k]['unitId'] . "'>";
            $output .= "<i class='fas fa-caret-right openGroup'></i><a>" . $items[$k]['label'] . "</a>";
            $output .= "</li>";
            $position_counter++;
        }
        if ($show_more == true && $direction != "UP") { // down button (if req)
            $output .= "<li class='parent open' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='" . $position_counter . "' data-id='" . $items[(count($items) - 1)]['id'] . "'>";
            $output .= "<br /><span class='moreAfter'>More after <i class='fas fa-angle-down'></i></span>";
            $output .= "</li>";
        }


        return $output;

        //self::dump($items);

    }

    public static function loadTreeSiblingsApi($clevel, $parent_id, $position, $direction="UP", $limit=10, $type = null) {

        $modx = self::$modx;
        $APIbase = $modx->getOption("ape_api");
        //Testing for root level
        $rootLevel = false;
        $first = mb_substr($parent_id, 0, 1);
        if($first === 'F') {
            $type = 'fa';
            $rootLevel = true;
        } elseif($first === 'H') {
            $type = 'hg';
            $rootLevel = true;
        }
        elseif($first === 'S') {
            $type = 'sg';
            $rootLevel = true;
        }
        $output = '';
        if($direction === "UP") {
            $more = 'before';

            if($rootLevel){
                $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&ecId={$parent_id}&more={$more}&max={$limit}&orderId={$position}&xmlTypeName={$type}"));
            } else {
                $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&parentId={$parent_id}&more={$more}&max={$limit}&orderId={$position}"));
            }

        } else {
            $more = 'after';
            $limit = 20;
            if($rootLevel){
                $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&ecId={$parent_id}&more={$more}&orderId={$position}&xmlTypeName={$type}"));
            } else {
                $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&parentId={$parent_id}&more={$more}&orderId={$position}"));
            }
           // $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?&parentId={$parent_id}&more={$more}&orderId={$position}"));

        }

        foreach ($treeDetails as $treeDetail) {

            if (isset($treeDetail->more)) { // up button (if req)
                if($treeDetail->more === 'before') {
                    $output .= "<li class='parent open' data-level='clevel' data-type='$type' data-trigger='load_tree_siblings' data-direction='UP' data-max='$treeDetail->max' data-position='" . $treeDetail->orderId . "' data-id='" . $parent_id . "'>";
                    $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
                    $output .= "</li>";
                } else {
                    $output.="<li class='parent open' data-level='clevel' data-type='$type' data-trigger='load_tree_siblings' data-direction='DOWN' data-max='$treeDetail->max' data-position='" . $treeDetail->orderId . "' data-id='" . $parent_id . "'>";
                    $output .= "<br /><span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
                    $output.="</li>";
                }
            } else {
                if($treeDetail->isFolder === true) {
                    $output .= "<li class='parent' data-level='clevel' data-type='$type' data-trigger='load_tree_children' data-position='' data-id='" . $treeDetail->id . "' data-unitid=''>";
                    $output .= "<i class=\"fas fa-caret-right openGroup\"></i><a>" . $treeDetail->title . "</a>";
                    $output .= "</li>";
                } else {
                    $output .= "<li class='parent' data-level='clevel' data-type='$type' data-trigger='load_tree_children' data-position='' data-id='" . $treeDetail->id . "' data-unitid=''>";
                    $output .= "<a>" . $treeDetail->title . "</a>";
                    $output .= "</li>";
                }
//                $output .= "<li class='parent' data-trigger='load_tree_children' data-position='' data-id='" . $treeDetail->id . "' data-unitid=''>";
//                $output .= "<i class=\"fas fa-caret-right openGroup\"></i><a>" . $treeDetail->title . "</a>";
//                $output .= "</li>";

//                $position_counter++;
            }
        }

        return $output;

//            if($show_more == true && $direction != "UP") { // down button (if req)
//                $output.="<li class='parent open' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='" . $position_counter . "' data-id='" . $items[(count($items) -1)]['id'] . "'>";
//                $output .= "<br /><span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
//                $output.="</li>";
//            }

//var_dump($treeDetails);
//        $json_pretty = json_encode($treeDetails, JSON_PRETTY_PRINT);
//        echo "<pre>".$json_pretty."<pre/>";
//        return $json_pretty;

        $position = intval($position);

        if ($direction == "UP") { // before / left (items with a lower order id)
            //This stops the duplication of the clicked on before result.

            $start = ($position) - $limit;

            if ($start < 0) {
                $start = 0;
                $limit = $position;
            }
        } else {
            $start = $position + 1;
            $limit = $limit + 1; // checking for more
        }

        //echo "start is ".$start." limit is ".$limit;

        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_archives");
        $solr = self::getSolr($core);
        $query = $parent_id." AND !id:".$parent_id;

        $additionalParameters = array(
            'df' => 'parentId',
            'sort' => 'orderId asc',
        );

        try
        {
            $s_results = $solr->search($query, $start, $limit, $additionalParameters);
        }
        catch (Exception $e)
        {
            self::logError("SOLR ERROR - ".print_r($e, 1));
            return false;
        }

        //self::dump($s_results->response->docs);
        if($direction == "DOWN") {
            if(count($s_results->response->docs) == $limit) { // there's more to come
                $show_more = true;
                array_pop($s_results->response->docs); // punch out the extra record
            }
            else {
                $show_more = false;
            }
        }

        $counter = 0;
        foreach ($s_results->response->docs as $doc) {
            $items[$counter]['id'] = $doc->id;
            $items[$counter]['label'] = $doc->unitTitle;
            //$items[$counter]['label'] = $doc->titleProper;
            $items[$counter]['recordId'] = $doc->recordId;
            if(isset($doc->unitId)) {
                $items[$counter]['unitId'] = $doc->unitId;
            }
            // @TODO ->numberOfDescendents (for drill down)
            $counter++;
        }


        $position_counter = $start;
        $output = null;

        if($start > 0 && $direction != "DOWN") { // up button (if req)
            $output.="<li class='parent open' data-level='clevel' data-type='$type' data-trigger='load_tree_siblings' data-direction='UP' data-position='".$position_counter."' data-id='".$items[0]['id']."'>";
            $output.= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
            $output.="</li>";
        }
        foreach($items AS $k => $v) { // loop of siblings

            $output.="<li class='parent' data-trigger='load_tree_children' data-position='".$position_counter."' data-id='".$items[$k]['id']."' data-unitid='".$items[$k]['unitId']."'>";
            $output.= "<i class=\"fas fa-caret-right openGroup\"></i><a>".$items[$k]['label']."</a>";
            $output.="</li>";
            $position_counter++;
        }
        if($show_more == true && $direction != "UP") { // down button (if req)
            $output.="<li class='parent open' data-level='clevel' data-type='$type' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='" . $position_counter . "' data-id='" . $items[(count($items) -1)]['id'] . "'>";
            $output .= "<br /><span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
            $output.="</li>";
        }

        return $output;

        //self::dump($items);

    }

    public function buildTreeApi($array, $type, $output, $parentId = null) {
        $output.="<ul class='subGroups'>";
        foreach ($array as $treeDetail) {
            $position = 0;
            if (isset($treeDetail->more)) {
                if(isset($treeDetail->parentId)) {
                    $parentId = $treeDetail->parentId;
                }
                if($treeDetail->more === 'before') {
                    $more = 'moreBefore';
                    $direction = 'UP';
                    $label = 'More before';
                    $icon = 'fa-angle-up';
                } else {
                    $direction = 'DOWN';
                    $more = 'moreAfter';
                    $label = 'More after';
                    $icon = 'fa-angle-down';
                }
                $output .= "<li class='parent' data-level='clevel' data-type='$type' data-trigger='load_tree_siblings' data-direction='$direction' data-max='$treeDetail->max' data-position='$treeDetail->orderId' data-id='$parentId'>";
                $output .= "<span class='$more'>$label <i class='fas $icon'></i></span>";
                $output .= "</li>";
            } else {
                $openState = '';
                $openGroupState = '';
                if($treeDetail->expand === true) {
                    $openState = 'open';
                    $openGroupState = 'openGroup';
                }
                $output.="<li class='parent $openState' data-level='clevel' data-type='$type' data-trigger='load_tree_children' data-position='$position' data-id='$treeDetail->id'>";
                if($treeDetail->isFolder === true) {
                    $output.= "<i class=\"fas fa-caret-right openGroup\"></i><a>$treeDetail->title</a>";
                    if($treeDetail->expand === true){
                        $output = self::buildTreeApi($treeDetail->children, $type, $output);
                    }
                } else {
                    $output.= "<a>$treeDetail->title</a>";
                }
                $position++;
                $output.="</li>";
            }
        }
        $output.="</ul>";
        return $output;
    }

    public static function buildTreeNodesApi($solr_record_id, $type, $array) {

        $counter = 0;

        if($array['recordType'] === 'fa') {
            $key = "F".$counter."_s";
        }
        if($array['recordType'] === 'sg') {
            $key = "S".$counter."_s";
        }
        if($array['recordType'] === 'hg') {
            $key = "H".$counter."_s";
        }
        $first = mb_substr($solr_record_id, 0, 1);
        $solrParentId = $array['parentId'];

        $modx = self::$modx;
        $APIbase = $modx->getOption("ape_api");
        if($first === 'C') {
            $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?clevelId={$solr_record_id}&xmlTypeName={$type}"));
        } else {
            $treeDetails = json_decode(file_get_contents("{$APIbase}Dashboard/eadTreeApi.action?ecId={$solrParentId}&xmlTypeName={$type}"));
        }
//        var_dump($array);
        $originLevel = $array['levelName'];
//        $recordType = $array['recordType'];
//        var_dump($solr_record_id);
//        var_dump($array);
//        var_dump($treeDetails);
//        die();


        $parentId = '';
        $output = '';
        if(is_array($treeDetails)) {
            $treeArray = true;
            foreach ($treeDetails as $treeDetail) {
                if($type === 'fa') {
                    $parentId = 'F'.$treeDetail->id;
                }
                if($type === 'sg') {
                    $parentId = 'S'.$treeDetail->id;
                }
                if($type === 'hg') {
                    $parentId = 'H'.$treeDetail->id;
                }
                $output.="<ul class='subGroups'>";
                $position = 0;
                if (isset($treeDetail->more)) {

                    if($treeDetail->more === 'before') {
                        $more = 'moreBefore';
                        $direction = 'UP';
                        $label = 'More before';
                        $output .= "<li class='parent' data-trigger='load_tree_siblings' data-level='archdesc' data-type='$type' data-direction='$direction' data-max='$treeDetail->max' data-position='$treeDetail->orderId' data-id='$parentId'>";
                    } else {
                        $direction = 'DOWN';
                        $more = 'moreAfter';
                        $label = 'More after';
                        $output .= "<li class='parent' data-trigger='load_tree_siblings' data-level='archdesc' data-type='$type' data-direction='$direction' data-position='$treeDetail->orderId' data-id='$parentId'>";
                    }

                    $output .= "<span class='$more'>$label <i class=\"fas fa-angle-up\"></i></span>";
                    $output .= "</li>";
                } else {
                    $testId = $first.$treeDetail->id;
                    $openState = '';
                    $openGroupState = '';
                    if($originLevel != 'archdesc') {
                        $openState = 'open';
                        $openGroupState = 'openGroup';
                    }
//                    var_dump($treeDetail);
                    $output.="<li class='parent $openState' data-level='archdesc' data-type='$type' data-trigger='load_tree_children' data-position='$position' data-id='$treeDetail->id'>";

                    if($treeDetail->isFolder === true) {
                        $output.= "<i class='fas fa-caret-right openGroup'></i><a>$treeDetail->title</a>";
                    } else {
                        $output.= "<a>$treeDetail->title</a>";
                    }
                    $output = self::buildTreeApi($treeDetail->children, $type, $output, $parentId);
                    $position++;
                    $output.="</li>";
                    $output.="</ul>";
                }
            }
        } else {
            $treeDetail = $treeDetails;
            $treeArray = false;
        }

        return $output;

        if(isset($array[$key])) {
            $parts = explode(":", $array[$key]);
            if($counter == 0) {
                $position = 0;
                $label = $parts[0];
                $id = $parts[2];
            }else{
                $position = intval(ltrim($parts[0], "0") ?? 0);
                $label = $parts[1];
                $id = $parts[3];
                if($parts[4]) {
                    $id = $parts[4];
                }
            }

            $testPosition = $array['orderId'];
            $output.="<ul class='subGroups'>";


            if ($counter != 0) {
                if ($position != 0) {
                    $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='UP' data-position='$position' data-id='$id'>";
                    $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";

                    $output .= "</li>";

                }
            }

            $output.="<li class='parent open' data-trigger='load_tree_children' data-position='$position' data-id='$id'>";

            $output.= "<i class=\"fas fa-caret-right openGroup\"></i><a>$label</a>";


            $counter++;
            $output= self::buildTreeNodes($array, $output, $counter);
            $output.="</li>";
            if($counter != 1) {
                $output.="<li class='parent' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='$position' data-id='$id'>";
                $output.="<span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
                $output.="</li>";
            }
            $output.="</ul>";
        } else {

            $parent_id = $array['parentId'];

            $modx = self::$modx;
            self::$solr_core = $core = $modx->getOption("solr_core_archives");
            $solr = self::getSolr($core);
            $query = $parent_id." AND !id:".$parent_id;

            $additionalParameters = array(
                'df' => 'parentId',
                'sort' => 'orderId asc',
            );

            try
            {
                $s_results = $solr->search($query, 0, 9999, $additionalParameters);
            }
            catch (Exception $e)
            {
                self::logError("SOLR ERROR - ".print_r($e, 1));
                return false;
            }

            $more_after = false;
            $more_before = false;
            $found_it = false;
            $counter = 0;
            foreach ($s_results->response->docs as $doc) {
                if($doc->id == $array['id']) { // match
                    if($counter != 0) {
                        $more_before = true;
                    }
                    $found_it = true;
                }
                else {
                    if($found_it == true) {
                        $more_after = true;
                    }
                }
                $counter++;
            }


            $output.="<ul class='subGroups'>";
            if($array['orderId'] > 0) {

            }

            if($more_before) {
                $output.="<li class='parent' data-trigger='load_tree_siblings' data-direction='UP' data-position='".$array['orderId']."' data-id='".$array['id']."'>";
                $output.= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
                $output.="</li>";
            }
            $descendents = intval($array['numberOfDescendents']);
            $output.="<li class='parent' data-trigger='load_tree_children' data-position='".$array['orderId']."' data-id='".$array['id']."'  data-unitid='".$array['reference_value']."'>";
            if($descendents > 0) {
                $output.= "<i class=\"fas fa-caret-right openGroup\"></i><a>".$array['title_value']."</a>";
            } else {
                $output.= "<a>".$array['title_value']."</a>";
            }
            $output.="</li>";

            if($more_after) {
                $output.="<li class='parent' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='".$array['orderId']."' data-id='".$array['id']."'>";
                $output.="<span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
                $output.="</li>";
            }

            $output.="</ul>";
        }

        return $output;
    }

    public static function buildTreeNodes($array, $output, $counter) {

        if($array['recordType'] === 'fa') {
            $key = "F".$counter."_s";
        }
        if($array['recordType'] === 'sg') {
            $key = "S".$counter."_s";
        }
        if($array['recordType'] === 'hg') {
            $key = "H".$counter."_s";
        }

        if(isset($array[$key])) {
            $parts = explode(":", $array[$key]);
            if($counter == 0) {
                $position = 0;
                $label = $parts[0];
                $id = $parts[2];
            }else{
                $position = intval(ltrim($parts[0], "0") ?? 0);
                $label = $parts[1];
                $id = $parts[3];
                if($parts[4]) {
                    $id = $parts[4];
                }
            }

            $output.="<ul class='subGroups'>";


            if ($counter != 0) {
                if ($position != 0) {
                    $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='UP' data-position='$position' data-id='$id'>";
                    $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";

                    $output .= "</li>";

                }
            }

            $output.="<li class='parent open' data-trigger='load_tree_children' data-position='$position' data-id='$id'>";

                $output.= "<i class=\"fas fa-caret-right openGroup\"></i><a>$label</a>";


            $counter++;
            $output= self::buildTreeNodes($array, $output, $counter);
            $output.="</li>";
            if($counter != 1) {
                $output.="<li class='parent' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='$position' data-id='$id'>";
                $output.="<span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
                $output.="</li>";
            }
            $output.="</ul>";
        } else {

            $parent_id = $array['parentId'];

            $modx = self::$modx;
            self::$solr_core = $core = $modx->getOption("solr_core_archives");
            $solr = self::getSolr($core);
            $query = $parent_id." AND !id:".$parent_id;

            $additionalParameters = array(
                'df' => 'parentId',
                'sort' => 'orderId asc',
            );

            try
            {
                $s_results = $solr->search($query, 0, 9999, $additionalParameters);
            }
            catch (Exception $e)
            {
                self::logError("SOLR ERROR - ".print_r($e, 1));
                return false;
            }

            $more_after = false;
            $more_before = false;
            $found_it = false;
            $counter = 0;
            foreach ($s_results->response->docs as $doc) {
                if($doc->id == $array['id']) { // match
                    if($counter != 0) {
                        $more_before = true;
                    }
                    $found_it = true;
                }
                else {
                    if($found_it == true) {
                        $more_after = true;
                    }
                }
                $counter++;
            }


            $output.="<ul class='subGroups'>";

            if($more_before) {
                $output.="<li class='parent' data-trigger='load_tree_siblings' data-direction='UP' data-position='".$array['orderId']."' data-id='".$array['id']."'>";
                $output.= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
                $output.="</li>";
            }
            $descendents = intval($array['numberOfDescendents']);
            $output .= "<li class='parent' data-trigger='load_tree_children' data-position='" . $array['orderId'] . "' data-id='" . $array['id'] . "'  data-unitid='" . $array['reference_value'] . "'>";
            if ($descendents > 0) {
                $output .= "<i class='fas fa-caret-right openGroup'></i><a>" . $array['title_value'] . "</a>";
            } else {
                $output .= "<a>" . $array['title_value'] . "</a>";
            }
            $output .= "</li>";

            if ($more_after) {
                $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='" . $array['orderId'] . "' data-id='" . $array['id'] . "'>";
                $output .= "<span class='moreAfter'>More after <i class='fas fa-angle-down'></i></span>";
                $output .= "</li>";
            }

            $output .= "</ul>";
        }

        return $output;
    }

    // protected static function buildTreeNodesOLD($array, $output, $counter)
    // {

    //     // @TODO - add triangles when desc

    //     /*
    //      * queries for loading more siblings
    //      *
    //      * $query=$_REQUEST['s_query']." AND orderId:[* TO 9]";
    //      *
    //      * 'sort' => 'orderId asc',
    //      *
    //      *  this will only work for less than - doesn;t seem to be a more than
    //      *  easier to calculate the START and limit 10 from there
    //      *
    //      */


    //     $key = "F" . $counter . "_s";
    //     if (isset($array[$key])) {
    //         $parts = explode(":", $array[$key]);
    //         if ($counter == 0) {
    //             $position = 0;
    //             $label = $parts[0];
    //             $id = $parts[2];
    //         } else {
    //             $position = ltrim($parts[0], "0");
    //             $label = $parts[1];
    //             $id = $parts[3];
    //         }
    //         $output .= "<ul class='subGroups'>";
    //         if ($counter != 0) {
    //             $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='UP' data-position='$position' data-id='$id'>";
    //             $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
    //             $output .= "</li>";
    //         }
    //         $output .= "<li class='parent' data-trigger='load_tree_children' data-position='$position' data-id='$id'>";
    //         $output .= "<i class=\"fas fa-caret-right openGroup\"></i><a>$label</a>";
    //         $counter++;
    //         $output = self::buildTreeNodes($array, $output, $counter);
    //         $output .= "</li>";
    //         if ($counter != 1) {
    //             $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='$position' data-id='$id'>";
    //             $output .= "<span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
    //             $output .= "</li>";
    //         }
    //         $output .= "</ul>";
    //     } else {
    //         $output .= "<ul>";
    //         $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='UP' data-position='" . $array['orderId'] . "' data-id='" . $array['id'] . "'>";
    //         $output .= "<span class=\"moreBefore\">More before <i class=\"fas fa-angle-up\"></i></span>";
    //         $output .= "</li>";
    //         $output .= "<li class='parent' data-trigger='load_tree_children' data-position='" . $array['orderId'] . "' data-id='" . $array['id'] . "'>";
    //         $output .= "<i class=\"fas fa-caret-right openGroup\"></i><a>" . $array['title_value'] . "</a>";
    //         $output .= "</li>";
    //         $output .= "<li class='parent' data-trigger='load_tree_siblings' data-direction='DOWN' data-position='" . $array['orderId'] . "' data-id='" . $array['id'] . "'>";
    //         $output .= "<span class=\"moreAfter\">More after <i class=\"fas fa-angle-down\"></i></span>";
    //         $output .= "</li>";
    //         $output .= "</ul>";
    //     }

    //     return $output;
    // }

    protected static function getSolrSingleResult($solr_record_id, $section)
    {

        $modx = self::$modx;

        if ($modx->getOption('search_spoof_solr') == 1) {
            if ($section == "archive") {
                require(MODX_CORE_PATH . 'components/asi/samples/solr/sample_response_archives_detail.php');
            }
            if ($section == "name") {
                require(MODX_CORE_PATH . 'components/asi/samples/solr/sample_response_names_detail.php');
            }
        } else {

            if ($section == "archive") {
                self::$solr_core = $core = $modx->getOption("solr_core_archives");
            }
            if ($section == "name") {
                self::$solr_core = $core = $modx->getOption("solr_core_names");
            }
            $solr = self::getSolr($core);
            $query = $solr_record_id;

            $additionalParameters = array(
                'df' => 'id',
            );

            $data = self::processSolrResults($solr, $query, $additionalParameters);
        }
        return $data;
    }

    public static function cleanLabel($val)
    {

        $bits = explode(":", $val);
        $spaced = str_replace("_", " ", $bits[0]);
        $words = explode(" ", $spaced);
        foreach ($words as $k => $v) {
            $words[$k] = ucfirst(strtolower($v));
        }
        $name = implode(" ", $words);
        return $name;
    }

    public static function highlightTermInExtract($extract, $term)
    {
        return str_replace($term, "<strong>$term</strong>", $extract);
    }

    public static function fetchLazyData($params)
    {

        $data = array();

        $modx = self::$modx;
        if ($modx->getOption('search_spoof_postgre') == 1) {
            require_once(__DIR__ . "/samples/postgre/finding_aid.php");
        } else {
            $data['fa'] = self::doPostgreQuery("SELECT * FROM finding_aid WHERE eadid = '" . pg_escape_string($params['fa_id']) . "'");
        }

        $xmlObj = self::getXmlObj($data['fa']['path_apenetead'], $params['section']);

        $date = $xmlObj->archdesc->did->unitdate;
        $response["date"] = $date->__toString();

        return $response;
    }

    // main switch for solr (list) results, depending on which section you're in
    public static function getSolrResults($term, $params)
    {
        switch ($params['section']) {
            case "search-in-archives":
                return self::getSolrResultsArchives($term, $params);
                break;
            case "search-in-names":
                return self::getSolrResultsNames($term, $params);
                break;
            case "search-in-institutions":
                return self::getSolrResultsInstitutions($term, $params);
                break;
            default:
                throw new \Exception(__METHOD__ . " did not recognise section!");
                break;
        }
    }

    // main switch for postgre (show) results, depending on which section you're in
    public static function getPostgreResults($section)
    {
        return;
        switch ($section) {
            case "search-in-archives":
                return self::getPostgreResultsArchives();
                break;
            case "search-in-names":
                return self::getPostgreResultsNames();
                break;
            case "search-in-institutions":
                return self::getPostgreResultsInstitutions();
                break;
            default:
                throw new \Exception(__METHOD__ . " did not recognise section!");
                break;
        }
    }

    // sets up the postgre connection (when not already)
    // @TODO - update this to use params
    protected static function initPostgre()
    {
        if (self::$postgre_init == false) {
            $modx = self::$modx;
            $dbconn = pg_connect("host=" . $modx->getOption('postgre_host') . " port=" . $modx->getOption('postgre_port') . " dbname=" . $modx->getOption('postgre_name') . " user=" . $modx->getOption('postgre_user') . " password=" . $modx->getOption('postgre_pass') . "");
            self::$postgre_init = true;
        }
    }

    // postrge result (show) for an archive search (checks for test response)
    protected static function getPostgreResultsArchives()
    {
        $modx = self::$modx;
        self::initPostgre();
        $params = $_REQUEST;

        if ($modx->getOption('search_spoof_postgre') == 1) {
            require_once(__DIR__ . "/samples/postgre/finding_aid.php");
            require_once(__DIR__ . "/samples/postgre/c_level.php");
        } else {

            //echo "<h3>Params...</h3>";
            //self::dump($params);

            $data['fa'] = self::doPostgreQuery("SELECT * FROM finding_aid WHERE eadid = '" . pg_escape_string($params['recordId']) . "'");
            $data['institution_id'] = $data['fa']['ai_id'];
            $c_level_id = substr($params['c'], 1);
            if (is_numeric($c_level_id)) {
                $data['c_level'] = self::doPostgreQuery("SELECT * FROM c_level WHERE id = $c_level_id LIMIT 1");
                // $data['tree'] = self::doPostgreQuery("SELECT * FROM c_level WHERE parent_id = $c_level_id LIMIT 10"); too expensive!
                $data['tree'] = "SELECT c_level.* FROM c_level
                                JOIN clevel.eadContent eadContent 
                                JOIN eadContent.\" + varName + \" ead 
                                JOIN ead.archivalInstitution archivalInstitution 
                                WHERE ead.eadid= :eadid 
                                AND ead.published = true 
                                AND archivalInstitution.repositorycode = :repoCode 
                                AND clevel.parentId IS NULL 
                                AND clevel.orderId = :orderId";
            }
        }

        // ec_id -> finding aid / holdings guide / source guide
        // finding_aid = column ai_id

        if (count($data['c_level']) > 0) { // C
            $data['c_level']['institution_id'] = $data['fa']['ai_id'];
            return self::formatCLevelDetail($data['c_level']);
        }


        //echo $data['fa']['path_apenetead'];

        $xmlObj = self::getXmlObj($data['fa']['path_apenetead']);
        $data['xml'] = self::processArchiveXml($xmlObj);
        $data['components'] = self::getXmlComponents($xmlObj);

        return self::formatDataArchiveDetail($data); // FA
    }

    public static function formatCLevelDetail($data)
    {

        //self::dump($data['xml']);

        $xml = simplexml_load_string($data['xml']);

        //echo "XML FILE IS ".$data['xml'];

        $data['xml'] = self::processArchiveXmlCLevel($xml);
        $data['components'] = self::getXmlComponents($xml);
        return self::formatDataArchiveDetail($data);
    }


    public static function testXSL2()
    {

        require_once(__DIR__ . "/lib/genkgo/vendor/autoload.php");

        $modx = self::$modx;

        $xslDoc = new \DOMDocument();
        $xslDoc->load(__DIR__ . '/xsl/ead/cdetails.xsl');

        $xmlDoc = new \DOMDocument();
        $xmlDoc->load(MODX_CORE_PATH . '../apeEAD_sample.xml');

        $transpiler = new XsltProcessor(new NullCache());
        $transpiler->importStylesheet($xslDoc);
        $result = $transpiler->transformToXML($xmlDoc);
        // self::dump($result);

        exit();
    }

    public static function testXMLProcess()
    {


        $xml = simplexml_load_file(MODX_CORE_PATH . '../apeEAD_sample.xml');

        $result = self::processArchiveXml($xml);

        // self::dump($result);

        exit();
    }

    protected static function renderNode($node)
    {
        echo "<li>", $node->__toString();
        if ($node->child) {
            echo "<ul>";
            foreach ($node->child as $child) {
                self::renderNode($child);
            }
            echo "</ul>";
        }
        echo "</li>";
    }



    protected static function processXSL($xml_data, $format)
    {
        switch ($format) {
            case "ARCHIVE_C_LEVEL":
                $xsl = self::loadXSL("ead/cdetails.xsl");
                echo "<h2>XSL</h2>";
                // self::dump($xsl);
                $proc = new \XSLTProcessor();
                $proc->importStyleSheet($xsl);

                echo "<h2>Processor</h2>";
                // self::dump($proc);

                $doc = new \DOMDocument();
                $doc->loadXML(utf8_encode($xml_data));
                echo "XML Doc";
                // self::dump($doc);


                $result = $proc->transformToXML($doc);

                echo "<h2>RESULT</h2>";
                //self::dump($result);

                return $proc->transformToXML($doc);
                break;
            default:
                return new \Exception(__METHOD__ . " Format for XSL could not be found");
        }
    }

    protected static function loadXSL($local_path)
    {
        $xsl = new \DOMDocument;
        $xsl->load(__DIR__ . "/xsl/" . $local_path);
        return $xsl;
    }



    // postrge result (show) for an name search (checks for test response)
    protected static function getPostgreResultsNames()
    {
        $modx = self::$modx;
        self::initPostgre();
        $params = $_REQUEST;

        if ($modx->getOption('search_spoof_postgre') == 1) {
            require_once(__DIR__ . "/samples/postgre/name2.php");
        } else {
            $data['name'] = self::doPostgreQuery("SELECT * FROM eac_cpf WHERE id = '" . pg_escape_string($params['id']) . "'");
        }


        //echo "ihere:::";
        //self::dump($data['name']);

        $xmlObj = self::getXmlObj($data['name']['path'], "names");
        $data['xml'] = self::processNameXml($xmlObj);
        $data['components'] = self::getXmlComponents($xmlObj);

        return self::formatDataNameDetail($data);
    }

    // postrge result (show) for an inst search (checks for test response)
    protected static function getPostgreResultsInstitutions()
    {

        $modx = self::$modx;
        self::initPostgre();
        $params = $_REQUEST;

        if ($modx->getOption('search_spoof_postgre') == 1) {
            require_once(__DIR__ . "/samples/postgre/institution.php");
            require_once(__DIR__ . "/samples/postgre/institution_country.php");
            require_once(__DIR__ . "/samples/postgre/institution_fas.php");
        } else {
            if (isset($params['name'])) {
                $data['institution'] = self::doPostgreQuery("SELECT * FROM archival_institution WHERE ainame = '" . pg_escape_string($params['name']) . "'");
            } else {
                $data['institution'] = self::doPostgreQuery("SELECT * FROM archival_institution WHERE id = '" . pg_escape_string($params['id']) . "'");
            }
            $data['country'] = self::doPostgreQuery("SELECT * FROM country WHERE id = '" . pg_escape_string($data['institution']['country_id']) . "'");
            $data['fas'] = self::doPostgreQuery("SELECT * FROM finding_aid WHERE ai_id = '" . pg_escape_string($data['institution']['id']) . "'");
        }

        //self::dump($data['fas']);
        //exit();

        $xmlObj = self::getXmlObj($data['institution']['eag_path'], "institutions");
        $data['xml'] = self::processInstitutionXml($xmlObj);

        return self::formatDataInstitutionDetail($data);
    }


    // formats XML for archives for view - see processArchiveXml for grabbing content from the XML
    protected static function formatDataArchiveDetail($data)
    {


        // keywords
        $controls = array();
        if (isset($data['xml']['archdesc']))
            foreach ($data['xml']['archdesc']->children() as $key => $value) {
                if ($key == "controlaccess") {
                    foreach ($value as $k => $v) {
                        $controls[$k][] = $v[0]->__toString();
                    }
                }
            }
        $keywordshtml = null;
        foreach ($controls as $ck => $cv) {
            $keywordshtml .= "<h3>" . ucfirst($ck) . "</h3>";
            foreach ($cv as $cvv) {
                $keywordshtml .= "<p>$cvv</p>";
            }
        }

        if ($data['xml']['original_presentation']) {

            self::$modx->getService('lexicon', 'modLexicon');
            self::$modx->lexicon->load('asi:default');
            $lexiconLabel = self::$modx->lexicon('asi.view_orig_presentation');

            $op = "<a class=\"originalLink\" href=\"" . $data['xml']['original_presentation'] . "\" target=\"_blank\">" . $lexiconLabel . " <i class=\"far fa-external-link-alt ml\"></i></a>";
        } else {
            $op = null;
        }

        return array(

            "original_presentation_html" => $op,

            "result_type" => "FA",

            // some single values
            "date_display_value" => $data['xml']['date']->__toString(),
            "country_value" => "COUNTRY_TODO",
            "reference_value" => self::arrToPs($data['xml']['unit_id']),
            "institution_value" => $data['xml']['repository']->__toString(),
            "title_value" => $data['xml']['title']->__toString(),
            'scope_first' => self::xmlParaFirst($data['xml']['scope']),
            'scope_rest' => self::xmlParaRest($data['xml']['scope']),
            "link_id" => self::arrToPs($data['xml']['link_id']),
            "original_presentation" => $data['xml']['original_presentation'],
            //"original_presentation_html" => $data['xml']['original_presentation_html'],

            // external url
            // echo "HERE: ".$data[''];

            // dropdown blocks
            'creator_history' => self::renderSection(self::arrToPs($data['xml']['creator_history']), "Records creator's history"),
            "archive_history" => self::renderSection(self::arrToPs($data['xml']['archive_history']), "Archival history"),
            "arrangement" =>  self::renderSection(self::arrToPs($data['xml']['arrangement']), "System of arrangement"),
            "access" => self::renderSection(self::arrToPs($data['xml']['access']), "Conditions governing access"),
            // @TODO = Conditions governing reproduction
            "publication_note" => self::renderSection(self::arrToPs($data['xml']['publication_note']), "Publication note"),
            "extent" => self::renderSection(self::arrToPs($data['xml']['extent']), "Extent"),
            "keywords" => self::renderSection($keywordshtml, "Keywords"),
            "language" => self::renderSection(self::arrToPs($data['xml']['language']), "Language of the material"),
            "creator" => self::renderSection(self::arrToPs($data['xml']['creator']), "Records creator"),
            "providor" => self::renderSection(self::arrToPs($data['xml']['providor']), "Content provider"),

            // manys
            "images" => $data['xml']['images'],
            "tree" => $data['xml']['tree'],
            "components" => $data['xml']['components'],
            "institution_id" => $data['institution_id'],
        );
    }

    public static function fetchXmlComponents($recordId, $start, $limit = 10)
    {

        $modx = self::$modx;
        self::initPostgre();
        $params = $_REQUEST;

        if ($modx->getOption('search_spoof_postgre') == 1) {
            require_once(__DIR__ . "/samples/postgre/finding_aid.php");
        } else {
            $data['fa'] = self::doPostgreQuery("SELECT * FROM finding_aid WHERE eadid = '" . pg_escape_string($recordId) . "'");
        }

        $xmlObj = self::getXmlObj($data['fa']['path_apenetead']);
        return self::getXmlComponents($xmlObj, $start, $limit);
    }

    protected static function getXmlComponents($xmlObj, $start = 0, $limit = 10)
    {

        $data['components'] = array();
        $counter = 0;
        $limit_counter = 0;
        $data['components_count'] = count($xmlObj->archdesc->dsc->c);
        foreach ($xmlObj->archdesc->dsc->c as $c) {

            if ($counter < $start) {
                $counter++;
                continue;
            }

            if ($limit_counter == $limit) break;

            if (isset($c['id'][0])) $data['components'][$counter]['id'] = $c['id'][0]->__toString();
            if (isset($c->did->unittitle)) $data['components'][$counter]['title'] = $c->did->unittitle->__toString();
            if (isset($c->did->unitdate)) $data['components'][$counter]['date'] = $c->did->unitdate->__toString();
            if (isset($c->did->physdesc['encodinganalog'][0])) $data['components'][$counter]['encoding'] = $c->did->physdesc['encodinganalog'][0]->__toString();
            if (isset($c->did->physdesc->extent)) $data['components'][$counter]['extent'] = $c->did->physdesc->extent->__toString();
            if (isset($c->did->repository)) $data['components'][$counter]['repository'] = $c->did->repository->__toString();
            if (isset($c->did->unitid)) $data['components'][$counter]['unit_id'] = $c->did->unitid->__toString();
            if (isset($c->scopecontent->p)) $data['components'][$counter]['scope'] = self::arrToPs($c->scopecontent->p);
            $limit_counter++;
            $counter++;
        }
        return $data;
    }

    protected static function formatDataNameDetail($data)
    {

        $entity_type = $data['xml']['entityType']->__toString();

        switch ($entity_type) {
            case "person":
                $icon = "user";
                break;
            case "family":
                $icon = "users";
                break;
            case "corporateBody":
                $icon = "landmark";
                break;
            default:
                $icon = "user";
        }

        $date_display_value = $data['xml']['fromDate'] . " - " . $data['xml']['toDate'];
        $to_date = (empty($data['xml']['toDate'])) ? "&nbsp;" : $data['xml']['toDate'];

        // relations
        // cpfRelation
        // resourceRelation

        $archRels = null;
        $archRelsCount = 0;
        $nameRels = null;
        $nameRelsCount = 0;

        foreach ($data['xml']['relations']->cpfRelation as $r) {
            //echo "PPP:".$r['cpfRelationType'];

            $dateRange = null;
            if (isset($r->dateRange)) {
                if (isset($r->dateRange->fromDate)) {
                    $dateRange .= " " . $r->dateRange->fromDate;
                }
                if (isset($r->dateRange->fromDate)) {
                    $dateRange .= " " . $r->dateRange->toDate;
                }
            }

            $link = $r->attributes("xlink", true)->href;
            if ($link != "") {
                if (strpos($link, "/") !== false) {
                    $nameRels .= "<li><a target='_blank' href='" . $link . "'>" . $r->relationEntry . $dateRange . "</a></li>";
                } else {
                    $nameRels .= "<li><a target='_blank' href='/detail/" . $link . "'>" . $r->relationEntry . $dateRange . "</a></li>";
                }
            } else {
                $nameRels .= "<li>" . $r->relationEntry . $dateRange . "</li>";
            }
            $nameRelsCount++;
        }

        foreach ($data['xml']['relations']->resourceRelation as $r) {
            $dateRange = null;
            if (isset($r->dateRange)) {
                if (isset($r->dateRange->fromDate)) {
                    $dateRange .= " " . $r->dateRange->fromDate;
                }
                if (isset($r->dateRange->fromDate)) {
                    $dateRange .= " " . $r->dateRange->toDate;
                }
            }

            $link = $r->attributes("xlink", true)->href;
            if ($link != "") {
                if (strpos($link, "/") !== false) {
                    $archRels .= "<li><a target='_blank' href='" . $link . "'>" . $r->relationEntry . $dateRange . "</a></li>";
                } else {
                    $archRels .= "<li><a target='_blank' href='/detail/" . $link . "'>" . $r->relationEntry . $dateRange . "</a></li>";
                }
            } else {
                $archRels .= "<li>" . $r->relationEntry . $dateRange . "</li>";
            }
            $archRelsCount++;
        }

        $biography = self::sortBio($data['xml']['biogHist']);



        $places = null;
        if (isset($data['xml']['places']->place)) {
            foreach ($data['xml']['places']->place as $place) {
                if (isset($place->placeEntry)) {
                    $extra = null;
                    if (isset($place->placeEntry['localType'])) {
                        $extra = " (" . $place->placeEntry['localType'] . ")";
                    }
                    if (isset($place->placeEntry['vocabularySource'])) {
                        $places .= "<p><strong><a target='_blank' href='" . $place->placeEntry['vocabularySource'] . "'>" . $place->placeEntry->__toString() . "$extra</a></strong></p>";
                    } else {
                        $places .= "<p><strong>" . $place->placeEntry->__toString() . "$extra</strong></p>";
                    }
                }
                if (isset($place->address)) {
                    foreach ($place->address->addressLine as $al) {
                        $places .= "<p>" . $al->__toString() . "</p>";
                    }
                }
                if (isset($place->date)) {
                    $places .= "<p>" . $place->date->__toString() . "</p>";
                }
                if (isset($place->citation)) {
                    $link = $place->citation->attributes("xlink", true)->href;
                    $places .= "<p><a href='$link' target='_blank'>" . $place->citation->__toString() . "</a></p>";
                }
            }
        }

        $occupations = null;
        if (isset($data['xml']['occupations']->occupation)) {
            foreach ($data['xml']['occupations']->occupation as $oc) {
                if (isset($oc->term)) {
                    if (isset($oc->term['vocabularySource'])) {
                        $occupations .= "<p><strong><a target='_blank' href='" . $oc->term['vocabularySource'] . "'>" . $oc->term->__toString() . "</a></strong></p>";
                    } else {
                        $occupations .= "<p><strong>" . $oc->term->__toString() . "</strong></p>";
                    }
                }
                if (isset($oc->placeEntry)) {
                    $occupations .= "<p>" . $oc->placeEntry->__toString() . "</p>";
                }
                if (isset($oc->dateRange)) {
                    $oc_date = null;
                    if (isset($oc->dateRange->fromDate)) {
                        $oc_date .= $oc->dateRange->fromDate->__toString() . " - ";
                    }
                    if (isset($oc->dateRange->fromDate)) {
                        $oc_date .= $oc->dateRange->toDate->__toString();
                    }
                    $occupations .= "<p>$oc_date</p>";
                }
                if (isset($oc->dateSet)) {
                    foreach ($oc->dateSet->dateRange as $dr) {
                        $oc_date = null;
                        if (isset($dr->fromDate)) {
                            $oc_date .= $dr->fromDate->__toString() . " - ";
                        }
                        if (isset($dr->fromDate)) {
                            $oc_date .= $dr->toDate->__toString();
                        }
                        $occupations .= "<p>$oc_date</p>";
                    }
                }
            }
        }

        $functions = null;
        if (isset($data['xml']['functions']->function)) {
            foreach ($data['xml']['functions']->function as $func) {
                if (isset($func->term)) {
                    $functions .= "<p>" . $func->term->__toString() . "</p>";
                }
                if (isset($func->placeEntry)) {
                    $functions .= "<p>" . $func->placeEntry->__toString() . "</p>";
                }
                if (isset($func->citation)) {
                    $link = $func->citation->attributes("xlink", true)->href;
                    $places .= "<p><a href='$link' target='_blank'>" . $func->citation->__toString() . "</a></p>";
                }
                if (isset($func->dateRange)) {
                    $f_date = null;
                    if (isset($func->dateRange->fromDate)) {
                        $f_date .= $func->dateRange->fromDate->__toString() . " - ";
                    }
                    if (isset($func->dateRange->fromDate)) {
                        $f_date .= $func->dateRange->toDate->__toString();
                    }
                    $functions .= "<p>$f_date</p>";
                }
            }
        }

        $mandates = null;
        if (isset($data['xml']['mandates']->mandate)) {
            foreach ($data['xml']['mandates']->mandate as $man) {
                if (isset($man->term)) {
                    $mandates .= "<p>" . $man->term->__toString() . "</p>";
                }
                if (isset($man->date)) {
                    $mandates .= "<p>" . $man->date->__toString() . "</p>";
                }
                if (isset($man->citation)) {
                    $link = $man->citation->attributes("xlink", true)->href;
                    $mandates .= "<p><a href='$link' target='_blank'>" . $man->citation->__toString() . "</a></p>";
                }
            }
        }

        $legals = null;
        if (isset($data['xml']['legal']->legalStatus)) {
            foreach ($data['xml']['legal']->legalStatus as $legal) {
                if (isset($legal->term)) {
                    $legals .= "<p>" . $legal->term->__toString() . "</p>";
                }
                if (isset($legal->placeEntry)) {
                    $legals .= "<p>" . $legal->placeEntry->__toString() . "</p>";
                }
                if (isset($legal->citation)) {
                    $link = $legal->citation->attributes("xlink", true)->href;
                    $legals .= "<p><a href='$link' target='_blank'>" . $legal->citation->__toString() . "</a></p>";
                }
            }
        }

        $structure = null;
        if (isset($data['xml']['structure'])) {
            if (isset($data['xml']['structure']->p)) {
                foreach ($data['xml']['structure']->p as $p) {
                    $structure .= "<p>" . $p->__toString() . "</p>";
                }
            }
            if (isset($data['xml']['structure']->outline)) {
                if (isset($data['xml']['structure']->outline->p)) {
                    foreach ($data['xml']['structure']->outline->p as $p) {
                        $structure .= "<p>" . $p->__toString() . "</p>";
                    }
                }
                if (isset($data['xml']['structure']->outline->level)) {

                    $structure = "<style>ul.structure_list { padding-left: 240px;} ul.structure_list li ul { padding-left: 40px;}</style>";

                    foreach ($data['xml']['structure']->outline->level as $level) {
                        $structure .= "<ul class='structure_list'>";
                        $structure .= "<li>" . $level->item->__toString() . "";
                        if (isset($level->level)) {
                            foreach ($level->level as $level2) {
                                $structure .= "<ul>";
                                $structure .= "<li>" . $level2->item->__toString() . "";
                                if (isset($level2->level)) {
                                    foreach ($level2->level as $level3) {
                                        $structure .= "<ul>";
                                        $structure .= "<li>" . $level3->item->__toString() . "";
                                        if (isset($level3->level)) {
                                            foreach ($level3->level as $level4) {
                                                $structure .= "<ul>";
                                                $structure .= "<li>" . $level4->item->__toString() . "";
                                                if (isset($leve4->level)) {
                                                    foreach ($level4->level as $level5) {
                                                        $structure .= "<ul>";
                                                        $structure .= "<li>" . $level5->item->__toString() . "</li>";

                                                        $structure .= "</ul>";
                                                    }
                                                }
                                                $structure .= "</li></ul>";
                                            }
                                        }
                                        $structure .= "</li></ul>";
                                    }
                                }
                                $structure .= "</li></ul>";
                            }
                        }
                        $structure .= "</li></ul>";
                    }
                }
            }
        }

        /*
*
* description -> places -> place -> placeEntry [vocabularySource] [countryCode] [localType] "places"
* description -> legalStatuses -> legalStatus -> term "legal"
*                                             -> placeEntry
*                                             -> citation [xlink:href]
* description -> structureOrGenealogy ps "structure"
*                                     outline -> ps
*                                                level(s) ->level(s) -> level(s)  (each level can contain levels, or items)
*
* description -> localDescriptions -> localDescription[localType] -> term "local"
*                                  -> descriptiveNote
*
* description -> generalContext ps "general"
* description -> biogHist -> abstract "history"
*                bioghist ps
*
*
*   occupations ??
*
*
* functions??
*
*/

        $local = null;
        if (isset($data['xml']['local'])) {
            if (isset($data['xml']['local']->localDescription)) {
                foreach ($data['xml']['local']->localDescription as $ld) {
                    $extra = null;
                    if (isset($ld['localType'])) {
                        $extra = " (" . $ld['localType'] . ")";
                        $local .= "<p>" . $ld->term->__toString() . "$extra</p>";
                    }
                }
            }
            if (isset($data['xml']['local']->descriptiveNote)) {
                foreach ($data['xml']['local']->descriptiveNote as $n) {
                    $local .= "<p>" . $n->__toString() . "</p>";
                }
            }
        }

        $general = null;
        if (isset($data['xml']['general']->p)) {
            foreach ($data['xml']['general']->p as $p) {
                $general .= "<p>" . $p->__toString() . "</p>";
            }
        }


        return array(
            "title_value" => $data['xml']['nameEntry'],
            //"alternative_names" => $data['xml']['alternative_names'],
            "alternative_names_html" => self::renderFeature($data['xml']['alternative_names'], "Alternative names"),
            "biography_html" => self::renderExtendableFeature($biography, "Biography"),
            "identifier" => $data['xml']['recordId'][0]->__toString(),
            //"other_identifier" => $data['xml']['otherRecordId'][0]->__toString(),
            "other_identifier_html" => self::renderFeature($data['xml']['otherRecordId'][0]->__toString(), "Other identifier"),
            'date_display_value' => $date_display_value,
            "entity_type" => ucfirst($entity_type),
            "icon" => $icon,
            //"from_date" => $data['xml']['fromDate'],
            "from_date_html" => self::renderFeature($data['xml']['fromDate'], "Date of birth / foundation"),
            //"to_date" => $to_date,
            "to_date_html" => self::renderFeature($to_date, "Date of death / closing"),
            //"languages" => self::objsToCommaList($data['xml']['languages'], "languageUsed", "language"),
            "languages_html" => self::renderFeature(self::objsToCommaList($data['xml']['languages'], "languageUsed", "language"), "Used languages"),
            //"scripts" => self::objsToCommaList($data['xml']['languages'], "languageUsed", "script"),
            "scripts_html" => self::renderFeature(self::objsToCommaList($data['xml']['languages'], "languageUsed", "script"), "Used scripts"),
            //'last_updated' => $data['xml']['last_updated'],
            'last_updated_html' => self::renderFeature($data['xml']['last_updated'], "Last update"),
            "agency_name" => $data['xml']['agencyName'][0]->__toString(),
            "nameRels" => $nameRels,
            "archRels" => $archRels,
            "nameRelsCount" => $nameRelsCount,
            "archRelsCount" => $archRelsCount,
            "places_html" => self::renderFeature($places, "Places"),
            "occupations_html" => self::renderFeature($occupations, "Occupations"),
            "functions_html" => self::renderFeature($occupations, "Functions"),
            "mandates_html" => self::renderFeature($mandates, "Mandates"),
            "legal_html" => self::renderFeature($legals, "Legal"),
            "structure_html" => self::renderFeature($structure, "Structure"),
            "local_html" => self::renderFeature($local, "Local"),
            "general_html" => self::renderFeature($general, "General"),
            "institution_id" => $data['name']['ai_id'],
        );
    }

    protected static function firstItem($arr, $element = "p")
    {
        if (is_array($arr) && count($arr) > 0) {
            return "<$element>" . $arr[0] . "</$element>";
        }
        return null;
    }

    protected static function restItems($arr, $element = "p")
    {
        if (is_array($arr) && count($arr) > 1) {
            array_shift($arr);
            $html = null;
            foreach ($arr as $i) {
                $html .= "<$element>$i</$element>";
            }
        }
        return $html;
    }

    protected static function sortBio($data)
    {

        $items = array();

        //self::dump($data);

        if (isset($data->abstract)) {
            $items[] = $data->abstract->__toString();
        }

        if (isset($data->p)) {
            foreach ($data->p as $p) {
                $items[] = $p->__toString();
            }
        }

        if (isset($data->chronList)) {

            foreach ($data->chronList->chronItem as $c) {
                if (isset($c->dateRange)) {
                    $items[] = $c->dateRange->fromDate->__toString() . " - " . $c->dateRange->toDate->__toString() . " : " . $c->event->__toString();
                } elseif (isset($c->date)) {
                    $items[] = $c->date->__toString() . " : " . $c->event->__toString();
                } else {
                    $items[] = $c->event->__toString();
                }
            }
        }


        //self::dump($items);

        return $items;
    }

    protected static function renderBioHTML($items)
    {

        /*
         * <div class="content mt40">
            <h2>Biography</h2>
            <hr>
            <p>[[!+search_result.biography_first]]</p>
            <div class="moreDropdown">
                <div class="inner">
                    <p>[[!+search_result.biography_last]]</p>
                </div>
                <div class="title inContent">
                    More
                </div>
            </div>
        </div>
         */
    }

    protected static function renderExtendableFeature($arr, $title, $size = 40)
    {

        $content = null;
        if (count($arr) > 0) {

            $content = "<div class=\"content mt40\">
            <h2>" . $title . "</h2>
            <hr>
            <p>" . $arr[0] . "</p>";

            if (count($arr) > 1) {
                array_shift($arr);
                $content .= "<div class=\"moreDropdown\">
                <div class=\"inner\">
                    " . self::arrToPs($arr) . "
                </div>
                <div class=\"title inContent\">
                    More
                </div>
            </div>";
            }

            $content . '</div>';
        }
        return $content;
    }

    protected static function flattenXmlGeneral($xmlObj)
    {

        return null;

        $json = json_encode($xmlObj);
        $array = json_decode($json, TRUE);
        return self::flattenXmlSet($array, null);
    }

    protected static function flattenXmlSet($set, $output = null)
    {

        return null;

        $count = 0;
        foreach ($set as $k => $v) {
            if (is_array($v)) {
                $output = self::flattenXmlSet($v, $output);
            } else {
                $output .= "<p>" . $v . "</p>";
            }
            $count++;
        }
        return $output;
    }

    protected static function arrToPs($arr)
    {

        $string = null;
        foreach ($arr as $p) {
            $string .= "<p>" . $p . "</p>";
        }
        return $string;
    }

    protected static function arrToCommaList($arr)
    {

        return implode(", ", $arr);
    }

    protected static function objsToCommaList($obj, $nest1 = null, $nest2 = null)
    {
        $items = array();
        // @TODO - add more logic for less nests
        foreach ($obj->$nest1 as $v) {
            if ($v->$nest2->__toString() != "")
                $items[] = $v->$nest2->__toString();
        }
        return implode(", ", $items);
    }

    protected static function xmlParaFirst($arr)
    {
        if (is_object($arr[0]))
            return $arr[0]->__toString();
        return null;
    }

    protected static function xmlParaRest($arr)
    {
        $count = 0;
        $string = null;
        foreach ($arr as $p) {
            $count++;
            if ($count == 1) continue;
            $string .= "<p>" . $p . "</p>";
        }
        return $string;
    }

    protected static function doPostgreQuery($query)
    {
        self::initPostgre();
        $result = pg_query($query) or die('Query failed: ' . pg_last_error() . "\n\nQuery:" . $query);
        $row = array();
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            foreach ($line as $k => $v) {
                $row[$k] = $v;
            }
        }

        return $row;
    }

    protected static function getXmlObj($filename, $section = null)
    {

        $modx = self::$modx;
        if ($modx->getOption('search_spoof_xml') == 1) {

            ini_set('memory_limit', '2048M');

            $example = (isset($_REQUEST['example'])) ? $_REQUEST['example'] : 1;

            if ($section == "names") {

                switch ($example) {
                    case 1:
                        $path =  __DIR__ . "/samples/xml/NamesExampleCorporateBody.xml";
                        break;
                    case 2:
                        $path =  __DIR__ . "/samples/xml/NamesExamplePerson1.xml";
                        break;
                    case 3:
                        $path =  __DIR__ . "/samples/xml/NamesExamplePerson2.xml";
                        break;
                    default:
                        $path =  __DIR__ . "/samples/xml/NamesExampleFamily.xml";
                }
            } elseif ($section == "institutions") {

                switch ($example) {
                    case 1:
                        $path =  __DIR__ . "/samples/xml/DE-1958.xml";
                        break;
                    case 2:
                        $path =  __DIR__ . "/samples/xml/BE-648616.xml";
                        break;
                    default:
                        $path =  __DIR__ . "/samples/xml/DE-1958.xml";
                }
            } else {

                switch ($example) {
                    case 1:
                        //$path =  __DIR__."/samples/xml/apeEAD_Beispiele_ES-37274-CDMH-UD-7523902.xml";
                        $path =  __DIR__ . "/samples/xml/apeEAD_sample.xml";
                        break;
                    case 2:
                        //$path =  __DIR__."/samples/xml/apeEAD_Beispiele_ES-47186-ARCHV-UD-6099049.xml";
                        $path =  __DIR__ . "/samples/xml/apeEAD_sample.xml";
                        break;
                    default:
                        //$path =  __DIR__."/samples/xml/ead-gb418-agecroft_0000000.xml";
                        $path =  __DIR__ . "/samples/xml/apeEAD_sample.xml";
                }
            }
        } else {
            $path = "/ape/data/repo" . $filename;
        }

        /*
        echo "<h1>XSL Testing...</h1>";

        $xsl_path = __DIR__."/xsl/names/";

        $xml = new \DOMDocument();
        $xml->load($path, getenv("HOME"));

        $xsl = new \DOMDocument;
        $xsl->load($xsl_path."commons.xsl");

        $proc = new \XSLTProcessor();
        $proc->importStyleSheet($xsl);

        self::dump($proc->transformToXML($xml));

        exit();
*/



        $xmlObj = simplexml_load_file($path);

        return $xmlObj;
    }

    // grabs the archive data from the XML
    protected static function processArchiveXml($xml_obj, $doc_level = "archdesc")
    {

        $xml = $xml_obj;


        //self::dump($xml);

        // straight fields

        $data = array();
        $data['title'] = $xml->$doc_level->did->unittitle;
        $data['date'] = $xml->$doc_level->did->unitdate;
        $data['repository'] = $xml->$doc_level->did->repository;
        $data['origination'] = $xml->$doc_level->did->origination;
        $data['unit_id'] = $xml->$doc_level->did->unitid;
        $data['scope'] = $xml->$doc_level->scopecontent->p;
        $data['creator_history'] = $xml->$doc_level->bioghist->p;
        $data['archive_history'] = $xml->$doc_level->custodhist->p;
        $data['arrangement'] = $xml->$doc_level->arrangement->p;
        $data['access'] = $xml->$doc_level->accessrestrict->p;
        // @TODO $data['reproduction'];
        $data['publication_note'] = $xml->$doc_level->bibliography->list->item;
        $data['extent'] = $xml->$doc_level->did->physdesc->extent;
        $data['archdesc'] = $xml->$doc_level;
        $data['language'] = $xml->$doc_level->did->langmaterial->language;
        $data['creator'] = $xml->$doc_level->did->origination;
        $data['providor'] = $xml->$doc_level->did->repository;
        $data['link'] = $xml->$doc_level->eadid['url'];
        $data['link_id'] = $xml->$doc_level->eadid;


        // external
        if (isset($xml->eadheader->eadid['url'][0])) {
            $data['original_presentation'] = $xml->eadheader->eadid['url'][0]->__toString();
        }


        // images (many)
        $images = array();
        $parentCounter = 0;
        foreach ($xml->archdesc->dsc->c as $c) {
            $counter = 0;
            if (is_object($c->did->dao)) {
                foreach ($c->did->dao as $dao) {
                    foreach ($dao->attributes('xlink', true) as $attribute => $attribvalue) {
                        //echo "<br />THIS".$attribvalue;
                        $images[$parentCounter][$counter][] = $attribvalue->__toString();
                    }
                    $counter++;
                }
            }
            $parentCounter++;
        }
        $limitCounter = 0;
        $imagesKeyed = array();
        foreach ($images as $k => $v) {
            if ($limitCounter == self::$image_limit) break;
            $imagesKeyed[$k]['thumb'] = $images[$k][1][0];
            $imagesKeyed[$k]['link'] = $images[$k][0][0];
            $imagesKeyed[$k]['caption'] = $images[$k][0][1];
            $limitCounter++;
        }
        $data['images'] = $imagesKeyed;

        // format tree into componenets (from what I can tell it's just anotehr view of the tree? - confirm)
        $data['components'] = array();
        $counter = 0;
        foreach ($xml->archdesc->dsc->c as $c) {

            // @TODO - remove this and replace with pagination
            if ($counter == 11) break;

            if (isset($c['id'][0])) $data['components'][$counter]['id'] = $c['id'][0]->__toString();
            if (isset($c->did->unittitle)) $data['components'][$counter]['title'] = $c->did->unittitle->__toString();
            if (isset($c->did->unitdate)) $data['components'][$counter]['date'] = $c->did->unitdate->__toString();
            if (isset($c->did->physdesc['encodinganalog'][0])) $data['components'][$counter]['encoding'] = $c->did->physdesc['encodinganalog'][0]->__toString();
            if (isset($c->did->physdesc->extent)) $data['components'][$counter]['extent'] = $c->did->physdesc->extent->__toString();
            if (isset($c->did->repository)) $data['components'][$counter]['repository'] = $c->did->repository->__toString();
            if (isset($c->did->unitid)) $data['components'][$counter]['unit_id'] = $c->did->unitid->__toString();
            if (isset($c->scopecontent->p)) $data['components'][$counter]['scope'] = self::arrToPs($c->scopecontent->p);
            $counter++;
        }

        /*
         *
         * [0] => Array
        (
            [id] => d1e181
            [title] => Documents relating to the Langleys of Agecroft
            [date] => 1412-1550
            [encoding] => 3.1.5
            [extent] => 41 files
            [repository] => Chetham's Library
            [unit_id] => GB/418/Agecroft/1
        )
         */

        /*

        // @TODO - this is formatting really should be moved
        $counter = 0;
        $tree = "<ul>";
        foreach($xml->archdesc->dsc->c AS $c) {

            // @TODO - remove this and replace with pagination
            if($counter == 11) break;

            $tree.="<li class=\"parent\"><i class=\"fas fa-caret-right openGroup\"></i> <a href=\"#\">".$c->did->unittitle->__toString()." <span class=\"count\">(".count($c->c).")</span> <i class=\"far fa-angle-right\"></i></a><ul>";
            foreach($c->c AS $cc){
                $tree.="<li class=\"parent\"><i class=\"fas fa-caret-right openGroup\"></i> <a href=\"#\">".$cc->did->unittitle->__toString()."<i class=\"far fa-angle-right\"></i></a></li>";
            }
            $tree.="</ul></li>";
            $counter++;
        }
        $tree.="</ul>";

        $data['tree'] = $tree;
        */

        return $data;
    }

    // grabs the archive data from the XML
    protected static function processArchiveXmlCLevel($xml_obj)
    {

        $xml = $xml_obj;

        // straight fields

        $data = array();
        $data['title'] = $xml->did->unittitle;
        $data['date'] = $xml->did->unitdate;
        $data['repository'] = $xml->did->repository;
        $data['origination'] = $xml->did->origination;
        $data['unit_id'] = $xml->did->unitid;

        // self::dump($xml);

        //exit();


        if (is_object($xml->did->unitid->extptr) && isset($xml->did->unitid->extptr->attributes("xlink", true)['href'])) {
            $data['original_presentation'] = $xml->did->unitid->extptr->attributes("xlink", true)['href']->__toString();

            // @TODO - need to figure out translation on this - maybe run the translator as a snippet as code?
            // [[!%asi.view_orig_presentation? &topic=`default` &namespace=`asi`]]

            self::$modx->getService('lexicon', 'modLexicon');
            self::$modx->lexicon->load('asi:default');
            $lexiconLabel = self::$modx->lexicon('asi.view_orig_presentation');

            $data['original_presentation_html'] = "<a class=\"originalLink\" href=\"" . $xml->did->unitid->extptr->attributes("xlink", true)['href']->__toString() . "\" target=\"_blank\">" . $lexiconLabel . " <i class=\"far fa-external-link-alt ml\"></i></a>";
        }




        $data['scope'] = $xml->scopecontent->p;
        $data['creator_history'] = $xml->bioghist->p;
        $data['archive_history'] = $xml->custodhist->p;
        $data['arrangement'] = $xml->arrangement->p;
        $data['access'] = $xml->accessrestrict->p;
        $data['publication_note'] = $xml->bibliography->list->item;
        $data['extent'] = $xml->did->physdesc->extent;
        $data['language'] = $xml->did->langmaterial->language;
        $data['creator'] = $xml->did->origination;
        $data['providor'] = $xml->did->repository;
        $data['link'] = $xml->eadid['url'];
        $data['link_id'] = $xml->eadid;

        // images (many)
        $images = array();
        $parentCounter = 0;
        $counter = 0;

        // self::dump($xml->did->dao);

        if (is_object($xml->did->dao)) {
            foreach ($xml->did->dao as $dao) {

                //self::dump($dao->attributes('xlink'));
                $images[$parentCounter][$counter][] = $dao->attributes('xlink', true)['href']->__toString();
                $images[$parentCounter][$counter][] = $dao->attributes('xlink', true)['title']->__toString();
                $images[$parentCounter][$counter][] = $dao->attributes('xlink', true)['role']->__toString();

                $counter++;
            }
        }


        $parentCounter++;
        $limitCounter = 0;
        $imagesKeyed = array();

        //self::dump($images);
        $placeholderImg = "image";

        foreach ($images as $k2 => $v2) {
            foreach ($images[$k2] as $k => $v) {
                if ($limitCounter == self::$image_limit) break;
                switch ($imagesKeyed[$k]['caption'] = $images[$k2][$k][2]) {
                    case "TEXT":
                        $placeholderImg = 'text';
                        break;
                    case "IMAGE":
                        $placeholderImg = 'image';
                        break;
                    case "SOUND":
                        $placeholderImg = 'sound';
                        break;
                    case "VIDEO":
                        $placeholderImg = 'video';
                        break;
                    case "3D":
                        $placeholderImg = '3d-object';
                        break;
                    case "UNSPECIFIED":
                        $placeholderImg = 'unspecified';
                        break;
                }
                $imagesKeyed[$k]['thumb'] = "/assets/images/placeholders/{$placeholderImg}.jpg";
                $imagesKeyed[$k]['link'] = $images[$k2][$k][0];
                $imagesKeyed[$k]['caption'] = $images[$k2][$k][1];
                $limitCounter++;
            }
        }
        $data['images'] = $imagesKeyed;

        //self::dump($data['images']);


        // format tree into componenets (from what I can tell it's just anotehr view of the tree? - confirm)
        $data['components'] = array();
        $counter = 0;
        foreach ($xml->dsc->c as $c) {

            // @TODO - remove this and replace with pagination
            if ($counter == 11) break;

            if (isset($c['id'][0])) $data['components'][$counter]['id'] = $c['id'][0]->__toString();
            if (isset($c->did->unittitle)) $data['components'][$counter]['title'] = $c->did->unittitle->__toString();
            if (isset($c->did->unitdate)) $data['components'][$counter]['date'] = $c->did->unitdate->__toString();
            if (isset($c->did->physdesc['encodinganalog'][0])) $data['components'][$counter]['encoding'] = $c->did->physdesc['encodinganalog'][0]->__toString();
            if (isset($c->did->physdesc->extent)) $data['components'][$counter]['extent'] = $c->did->physdesc->extent->__toString();
            if (isset($c->did->repository)) $data['components'][$counter]['repository'] = $c->did->repository->__toString();
            if (isset($c->did->unitid)) $data['components'][$counter]['unit_id'] = $c->did->unitid->__toString();
            if (isset($c->scopecontent->p)) $data['components'][$counter]['scope'] = self::arrToPs($c->scopecontent->p);
            $counter++;
        }

        // @TODO - this is formatting really should be moved
        $counter = 0;
        $tree = "<ul>";
        foreach ($xml->dsc->c as $c) {

            // @TODO - remove this and replace with pagination
            if ($counter == 11) break;

            $tree .= "<li class=\"parent\"><i class=\"fas fa-caret-right openGroup\"></i> <a href=\"#\">" . $c->did->unittitle->__toString() . " <span class=\"count\">(" . count($c->c) . ")</span> </a><ul>";
            foreach ($c->c as $cc) {
                $tree .= "<li class=\"parent\"><i class=\"fas fa-caret-right openGroup\"></i> <a href=\"#\">" . $cc->did->unittitle->__toString() . "</a></li>";
            }
            $tree .= "</ul></li>";
            $counter++;
        }
        $tree .= "</ul>";

        $data['tree'] = $tree;

        return $data;
    }

    protected static function renderSection($content, $title)
    {

        $modx = self::$modx;
        if (strlen($content) > 0) {
            return $modx->getChunk("asi_dropdown_section", array(
                "title" => $title,
                "content" => $content,
            ));
        }
        return null;
    }

    protected static function renderFeature($content, $title, $size = 240)
    {

        $modx = self::$modx;
        if (strlen($content) > 0) {
            return $modx->getChunk("asi_feature", array(
                "title" => $title,
                "content" => $content,
                "size" => $size,
            ));
        }
        return null;
    }

    protected static function processNameXml($xml_obj)
    {

        $xml = $xml_obj;

        $data['recordId'] = $xml->control->recordId;
        $data['otherRecordId'] = $xml->control->otherRecordId;
        $data['agencyCode'] = $xml->control->maintenanceAgency->agencyCode;
        $data['agencyName'] = $xml->control->maintenanceAgency->agencyName;
        $data['descriptiveNote'] = $xml->control->maintenanceAgency->descriptiveNote;
        $names_values = self::sortXmlNameComponent($xml->cpfDescription->identity);
        $data['nameEntry'] = $names_values['default'];
        $data['alternative_names'] = $names_values['alternatives'];
        //$data['nameEntry'] = $xml->cpfDescription->identity->nameEntry[0]->part;
        $data['entityType'] = $xml->cpfDescription->identity->entityType;
        $data['languages'] = $xml->cpfDescription->description->languagesUsed;
        $data['term'] = $xml->cpfDescription->description->legalStatuses->legalStatus->term;
        if (isset($xml->cpfDescription->description->existDates->dateRange->fromDate)) $data['fromDate'] = $xml->cpfDescription->description->existDates->dateRange->fromDate->__toString();
        if (isset($xml->cpfDescription->description->existDates->dateRange->toDate)) $data['toDate'] = $xml->cpfDescription->description->existDates->dateRange->toDate->__toString();
        $data['biogHist'] = $xml->cpfDescription->description->biogHist;
        $data['last_updated'] = self::getLatestXMLDate($xml->control->maintenanceHistory);
        $data['relations'] = $xml->cpfDescription->relations;

        $data['places'] = $xml->cpfDescription->description->places;
        $data['occupations'] = $xml->cpfDescription->description->occupations;
        $data['functions'] = $xml->cpfDescription->description->functions;
        $data['mandates'] = $xml->cpfDescription->description->mandates;
        $data['legal'] = $xml->cpfDescription->description->legalStatuses;
        $data['structure'] = $xml->cpfDescription->description->structureOrGenealogy;
        $data['local'] = $xml->cpfDescription->description->localDescriptions;
        $data['general'] = $xml->cpfDescription->description->generalContext;
        $data['history'] = $xml->cpfDescription->description->biogHist;

        return $data;
    }

    public static function dump($whatevs)
    {
        echo "<pre>" . print_r($whatevs, 1) . "</pre>";
    }

    protected static function getLatestXMLDate($obj)
    {

        $dates = array();
        foreach ($obj->maintenanceEvent as $ev) {
            $string = $ev->eventDateTime[0]->__toString();
            $dates[strtotime($string)] = strtotime($string);
        }
        ksort($dates);
        $lastDate = end($dates);
        return date("Y-m-d", $lastDate);
    }

    protected static function sortXmlNameComponent($xmlIdentityObject)
    {

        //self::dump($xmlIdentityObject);
        //exit();

        // sort the names into order
        $nameObjs = array();
        $nameCounter = 5;
        $nameList = (isset($xmlIdentityObject->nameEntryParallel)) ? $xmlIdentityObject->nameEntryParallel->nameEntry : $xmlIdentityObject->nameEntry;
        foreach ($nameList as $name) {

            switch ($name['localType']) {
                case "preferred":
                    $key = 0;
                    break;
                case "authorized":
                    $key = 1;
                    break;
                case "alternative":
                    $key = 2;
                    break;
                case "abbreviation":
                    $key = 3;
                    break;
                case "other":
                    $key = 4;
                    break;
                default:
                    $key = $nameCounter;
            }

            $nameObjs[$key] = $name;
            $nameCounter++;
        }
        ksort($nameObjs);

        // sort the name parts into order
        $c = 0;
        foreach ($nameObjs as $n) {

            $partCounter = 8;
            $parts = array();
            foreach ($n->part as $p) {

                // - The predefined sequence for all included @localType-s, if available, is: [surname] ([birthname]), [prefix], [firstname] [patronym], [suffix], [title] (alias: [alias])

                switch ($p['localType']) {
                    case "surname":
                        $key = 0;
                        break;
                    case "birthname":
                        $key = 1;
                        break;
                    case "prefix":
                        $key = 2;
                        break;
                    case "firstname":
                        $key = 3;
                        break;
                    case "patronym":
                        $key = 4;
                        break;
                    case "suffix":
                        $key = 5;
                        break;
                    case "title":
                        $key = 6;
                        break;
                    case "alias":
                        $key = 7;
                        break;
                    default:
                        $key = $partCounter;
                }
                $parts[$key] = $p;
                $partCounter++;
            }
            ksort($parts);

            $partsSorted = array();
            foreach ($parts as $pp) {
                $partsSorted[] = $pp;
            }

            if (count($partsSorted) < 2) {
                if (is_object($partsSorted[0])) {
                    $string = $partsSorted[0][0]->__toString();
                } else {
                    $string = $partsSorted[0];
                }
            } else {
                $string = $partsSorted[0];
                array_shift($partsSorted);
                $string .= " (" . implode(", ", $partsSorted) . ")";
            }

            // sort into default and alternatives
            if ($c == 0) {
                $names_values['default'] = $string;
            } else {
                $names_values['alternatives'][] = $string;
            }
            $c++;
        }
        $names_values['alternatives'] = implode("<br />", $names_values['alternatives']);

        return $names_values;
    }

    protected static function processInstitutionXml($xml_obj)
    {

        $xml = $xml_obj;

        if (isset($xml->control->recordId)) $data['recordId'] = $xml->control->recordId;
        if (isset($xml->control->otherRecordId)) $data['otherRecordId'] = $xml->control->otherRecordId;
        if (isset($xml->control->maintenanceAgency->agencyCode)) $data['agencyCode'] = $xml->control->maintenanceAgency->agencyCode;
        if (isset($xml->control->maintenanceAgency->agencyName)) $data['agencyName'] = $xml->control->maintenanceAgency->agencyName;
        if (isset($xml->archguide->desc->repositories->repository->location)) $data['location'] = $xml->archguide->desc->repositories->repository->location;
        if (isset($xml->archguide->desc->repositories->repository)) $data['repository'] = $xml->archguide->desc->repositories->repository;
        if (isset($xml->control->maintenanceHistory->maintenanceEvent)) $data['last_updated'] = $xml->control->maintenanceHistory->maintenanceEvent[(count($xml->control->maintenanceHistory->maintenanceEvent) - 1)]->eventDateTime;
        if (isset($xml->archguide->desc->repositories)) $data['other_branches'] = $xml->archguide->desc->repositories;
        if (isset($xml->relations)) $data['relations'] = $xml->relations;
        if (isset($xml->archguide)) $data['archguide'] = $xml->archguide;

        return $data;
    }

    // formats XML for archives for view - see processInstitutionXml for grabbing content from the XML
    protected static function formatDataInstitutionDetail($data)
    {

        $access_public = (isset($data['xml']['repository']->access['question']) && $data['xml']['repository']->access['question'] == "yes") ? "Facilities for disabled people are available" : "No facilities for disabled people available";
        $add_bits = array();
        if (isset($data['xml']['location']->street[0])) $add_bits[] = $data['xml']['location']->street[0]->__toString();
        //if(isset($data['xml']['location']->country[0])) $add_bits[] = $data['xml']['location']->country[0]->__toString(); country now listed separately
        if (isset($data['xml']['location']->firstdem[0])) $add_bits[] = $data['xml']['location']->firstdem[0]->__toString();
        if (isset($data['xml']['location']->municipalityPostalcode[0])) $add_bits[] = $data['xml']['location']->municipalityPostalcode[0]->__toString();

        $website_html = null;
        if (isset($data['xml']['repository']->webpage)) {
            foreach ($data['xml']['repository']->webpage as $webpage) {
                $website_html .= self::renderFeature("<a href=\"" . $webpage['href']->__toString() . "\" target='_blank'>" . $webpage->__toString() . "</a>", "Webpage", 160);
            }
        }

        $email_html = null;
        if (isset($data['xml']['repository']->email)) {
            foreach ($data['xml']['repository']->email as $email) {
                $email_html .= self::renderFeature("<a href=\"" . $email['href']->__toString() . "\" target='_blank'>" . $email->__toString() . "</a>", "Email", 160);
            }
        }

        $address = (count($add_bits) > 0) ? implode(", ", $add_bits) : null;
        //$geo_code = self::geocode($address);

        //self::dump($geo_code);

        //exit();

        $other_info_string = null;
        if (isset($data['xml']['relations'])) {
            //$other_info_string.="<p>Relations:</p>";
            foreach ($data['xml']['relations']->resourceRelation as $rr) {
                if (isset($rr['href'])) {
                    $other_info_string .= "<p><a href='" . $rr['href'] . "' target='_blank'>" . $rr->relationEntry->__toString() . "</a></p>";
                } else {
                    $other_info_string .= "<p>" . $rr->relationEntry->__toString() . "</p>";
                }
            }
        }

        $other_names_string = null;
        if (isset($data['xml']['archguide']->identity)) {
            if (isset($data['xml']['archguide']->identity->repositorid)) {
                $other_names_string .= "<p>Repository code: " . $data['xml']['archguide']->identity->repositorid['repositorycode'] . "</p>";
            }
            if (isset($data['xml']['archguide']->identity->autform)) {
                foreach ($data['xml']['archguide']->identity->autform as $a) {
                    $other_names_string .= "<p>" . $a->__toString() . "</p>";
                }
            }
            if (isset($data['xml']['archguide']->identity->nonpreform)) {
                foreach ($data['xml']['archguide']->identity->nonpreform as $np) {
                    $date_string = null;
                    if (isset($np->useDates)) {
                        if (isset($np->useDates->dateRange)) {
                            if (isset($np->useDates->dateRange->fromDate)) {
                                $date_string .= $np->useDates->dateRange->fromDate . " - ";
                            }
                            if (isset($np->useDates->dateRange->toDate)) {
                                $date_string .= $np->useDates->dateRange->toDate;
                            }
                        }
                    }
                    if (!is_null($date_string)) $date_string = "(" . $date_string . ")";
                    $other_names_string .= "<p>" . $np->__toString() . " $date_string</p>";
                }
            }
        }

        $repo_type_string = null;
        if (isset($data['xml']['archguide']->identity->repositoryType)) {
            $repo_type_string = "<p>" . $data['xml']['archguide']->identity->repositoryType->__toString() . "</p>";
        }

        $address = (count($add_bits) > 0) ? implode(", ", $add_bits) : null;
        $map_address = urlencode($address);
        $map_key = sha1(self::$gmap_hash_salt . $map_address);

        $dataSorted = array(
            'fas' => (isset($data['fas'])) ? $data['fas'] : null,
            "agency_name" => (isset($data['xml']['agencyName'][0])) ? $data['xml']['agencyName'][0]->__toString() : null,
            "address" => $address,
            "map_address" => $map_address,
            "map_key" => $map_key,
            "country_name" => (isset($data['country']['cname'])) ? ucfirst(strtolower($data['country']['cname'])) : null,
            "email" => $email_html,
            "webpage" => $website_html,
            "telephone" => (isset($data['xml']['repository']->telephone)) ? $data['xml']['repository']->telephone->__toString() : null,
            "fax" => (isset($data['xml']['repository']->fax)) ? self::renderFeature($data['xml']['repository']->fax->__toString(), "Fax", 160) : null,
            "opening" => (isset($data['xml']['repository']->timetable->opening)) ? $data['xml']['repository']->timetable->opening->__toString() : null,
            "access" => $access_public,
            "access_info" => (isset($data['xml']['repository']->access->restaccess)) ? $data['xml']['repository']->access->restaccess->__toString() : null,
            "accessibility" => (isset($data['xml']['repository']->accessibility)) ? $data['xml']['repository']->accessibility->__toString() : null,
            //"holdings_desc" => $data['xml']['repository']->holdings->descriptiveNote->p->__toString(),
            "holdings_desc" => (isset($data['xml']['repository']->holdings->descriptiveNote->p)) ? self::renderSection(self::arrToPs($data['xml']['repository']->holdings->descriptiveNote->p), "Archives & holding description") : null,
            "holdings_hist" => (isset($data['xml']['repository']->repositorhist->descriptiveNote->p)) ? self::renderSection(self::arrToPs($data['xml']['repository']->repositorhist->descriptiveNote->p), "History") : null,
            "holdings_extent" => (isset($data['xml']['repository']->holdings->extent->num)) ? $data['xml']['repository']->holdings->extent->num->__toString() : null,
            "last_updated" => (isset($data['xml']['last_updated'])) ? $data['xml']['last_updated']->__toString() : null,
            "other_branches" => (isset($data['xml']['other_branches'])) ? self::sortBranches($data['xml']['other_branches']) : null,
            'country' => (isset($data['xml']['location']->country[0])) ? self::renderFeature($data['xml']['location']->country[0]->__toString(), "Country", 160) : null,
            'role' => (isset($data['xml']['repository']->repositoryRole)) ? self::renderFeature($data['xml']['repository']->repositoryRole->__toString(), "Role", 160) : null,
            'other_info' => self::renderFeature($other_info_string, "Related information"),
            'other_names' => self::renderFeature($other_names_string, "Other names"),
            'repo_type' => self::renderFeature($repo_type_string, "Repository type"),
            "institution_id" => $data['institution']['id'],
            // extent date history
        );

        return $dataSorted;
    }

    protected static function sortBranches($repos_obj)
    {

        $repos_sorted = array();
        $counter = 0;

        foreach ($repos_obj->repository as $repo) {

            $access_public = (isset($repo->access['question']) && $repo->access['question'] == "yes") ? "Facilities for disabled people are available" : "No facilities for disabled people available";

            $website_html = null;
            if (isset($repo->webpage)) {
                foreach ($repo->webpage as $webpage) {
                    $website_html .= self::renderFeature("<a href=\"" . $webpage['href']->__toString() . "\" target='_blank'>" . $webpage->__toString() . "</a>", "Webpage", 160);
                }
            }

            $email_html = null;
            if (isset($repo->email)) {
                foreach ($repo->email as $email) {
                    $email_html .= self::renderFeature("<a href=\"" . $email['href']->__toString() . "\" target='_blank'>" . $email->__toString() . "</a>", "Email", 160);
                }
            }

            $repos_sorted[$counter]['name_text'] =  $repo->repositoryName->__toString();
            //$access_public = ($repo->access['question'] == "yes") ? "Accessible to the public" : "Not accessible to the public" ;
            $repos_sorted[$counter]['name'] = (isset($repo->repositoryName)) ? self::renderFeature($repo->repositoryName->__toString(), "Name") : null;
            $repos_sorted[$counter]['role'] = (isset($repo->repositoryRole)) ? self::renderFeature($repo->repositoryRole->__toString(), "Role", 160) : null;
            $repos_sorted[$counter]['full_name'] = (isset($repo->repositoryName) && isset($repo->repositoryRole)) ? self::renderFeature($repo->repositoryName->__toString() . " (" . $repo->repositoryRole->__toString() . ")", "Full name") : null;
            $add_bits = array();
            if (isset($repo->location->street[0])) $add_bits[] = $repo->location->street[0]->__toString();
            // if(isset($repo->location->country[0])) $add_bits[] = $repo->location->country[0]->__toString(); country now listed separately
            if (isset($repo->location->firstdem[0])) $add_bits[] = $repo->location->firstdem[0]->__toString();
            if (isset($repo->location->secondem[0])) $add_bits[] = $repo->location->secondem[0]->__toString();
            if (isset($repo->location->localentity[0])) $add_bits[] = $repo->location->localentity[0]->__toString();
            if (isset($repo->location->municipalityPostalcode[0])) $add_bits[] = $repo->location->municipalityPostalcode[0]->__toString();


            $address = (count($add_bits) > 0) ? implode(", ", $add_bits) : null;
            $map_address = urlencode($address);
            $map_key = sha1(self::$gmap_hash_salt . $map_address);


            $repos_sorted[$counter]['address'] = $address;
            $repos_sorted[$counter]['map_address'] = $map_address;
            $repos_sorted[$counter]['map_key'] = $map_key;
            $repos_sorted[$counter]['email'] = $email_html;
            $repos_sorted[$counter]['webpage'] = $website_html;
            $repos_sorted[$counter]['telephone'] = (isset($repo->telephone)) ? $repo->telephone->__toString() : null;
            $repos_sorted[$counter]['fax'] = (isset($repo->fax)) ? self::renderFeature($repo->fax->__toString(), "Fax", 160) : null;
            $repos_sorted[$counter]['opening'] = (isset($repo->timetable->opening)) ? self::renderFeature(self::flattenXmlParts($repo->timetable->opening), "Opening hours") : null;
            $repos_sorted[$counter]['closing'] = (isset($repo->timetable->closing)) ? self::renderFeature(self::flattenXmlParts($repo->timetable->closing), "Closing hours") : null;
            $repos_sorted[$counter]['directions'] = (isset($repo->directions)) ? self::renderFeature(self::flattenXmlParts($repo->directions), "Directions") : null;
            //$repos_sorted[$counter]['access'] =  self::renderFeature($access_public, "Access conditions");
            $repos_sorted[$counter]['disabled_access'] = self::renderFeature($access_public, "Disabled access");
            $repos_sorted[$counter]['access_info'] = (isset($repo->access->restaccess)) ? self::renderFeature(self::flattenXmlParts($repo->access->restaccess), "Access information") : null;
            $repos_sorted[$counter]['terms'] = (isset($repo->access->termsOfUse)) ? self::renderFeature(self::flattenXmlPartsWithLinks($repo->access->termsOfUse), "Terms of use") : null;
            $repos_sorted[$counter]['accessibility'] = (isset($repo->accessibility)) ? self::renderFeature($repo->accessibility->__toString(), "Facilities for disabled people") : null;

            $holdings_string = null;
            if (isset($repo->holdings->extent->num)) {
                $unit = null;
                if (isset($repo->holdings->extent->num['unit'])) {
                    $unit = $repo->holdings->extent->num['unit'];
                }
                if (isset($repo->holdings->dateSet)) {
                    $holdings_string .= "<p>Dates:</p>";
                    foreach ($repo->holdings->dateSet->dateRange as $dr) {
                        $date_string = "<p>";
                        if (isset($dr->fromDate)) {
                            $date_string .= $dr->fromDate->__toString() . "- ";
                        }
                        if (isset($dr->toDate)) {
                            $date_string .= $dr->toDate->__toString();
                        }
                        $date_string .= "</p>";
                        $holdings_string .= $date_string;
                    }
                }
                $holdings_string .= "<p>Extent: " . $repo->holdings->extent->num->__toString() . " $unit</p>";
            }
            if (isset($repo->holdings->descriptiveNote->p)) {
                $holdings_string .= self::arrToPs($repo->holdings->descriptiveNote->p);
            }
            $repos_sorted[$counter]['holdings_desc'] = (isset($repo->holdings->descriptiveNote->p)) ? self::renderSection($holdings_string, "Archives & holdings description") : null;

            $history_string = null;
            if (isset($repo->repositorfound)) {
                if (isset($repo->repositorfound->date)) {
                    $history_string .= "<p>Repository founded: " . $repo->repositorfound->date->__toString() . "</p>";
                }
                if (isset($repo->repositorfound->rule)) {
                    $history_string .= "<p>" . $repo->repositorfound->rule->__toString() . "</p>";
                }
            }
            if (isset($repo->adminhierarchy)) {
                $history_string .= "<p>Admin departments:</p>";
                foreach ($repo->adminhierarchy->adminunit as $au) {
                    $history_string .= "<p>" . $au->__toString() . "</p>";
                }
            }
            if (isset($repo->buildinginfo)) {
                if (isset($repo->buildinginfo->building->descriptiveNote)) {
                    $history_string .= "<p>Archive building:</p>";
                    $history_string .= self::arrToPs($repo->buildinginfo->building->descriptiveNote->p);
                }
                if (isset($repo->buildinginfo->lengthshelf)) {
                    $history_string .= "<p>Shelf length: " . $repo->buildinginfo->lengthshelf->num->__toString() . " " . $repo->buildinginfo->lengthshelf->num['unit'] . "</p>";
                }
            }
            if (isset($repo->repositorhist->descriptiveNote->p)) {
                $history_string .= self::arrToPs($repo->repositorhist->descriptiveNote->p);
            }
            $repos_sorted[$counter]['holdings_hist'] = (isset($repo->repositorhist->descriptiveNote->p)) ? self::renderSection($history_string, "History") : null;




            $repos_sorted[$counter]['country'] = (isset($repo->location->country[0])) ? self::renderFeature($repo->location->country[0]->__toString(), "Country", 160) : null;

            if (isset($repo->services->searchroom->readersTicket)) {
                $repos_sorted[$counter]['readers_tickets'] = null;
                foreach ($repo->services->searchroom->readersTicket as $ticket)
                    $repos_sorted[$counter]['readers_tickets'] .= "<p><a href='" . $ticket['href'] . "' target='_blank'>" . $ticket . "</a></p>";
            }
            $repos_sorted[$counter]['readers_tickets'] = self::renderFeature($repos_sorted[$counter]['readers_tickets'], "Readers tickets");

            if (isset($repo->services->searchroom->workPlaces)) $repos_sorted[$counter]['search_room'] = self::renderFeature($repo->services->searchroom->workPlaces->num->__toString() . " places", "Search room");

            if (isset($repo->services->searchroom->computerPlaces)) {

                $computer_places_string = null;
                if (isset($repo->services->searchroom->computerPlaces->num)) {
                    $computer_places_string .= "<p>Number: " . $repo->services->searchroom->computerPlaces->num->__toString() . "</p>";
                }
                if (isset($repo->services->searchroom->computerPlaces->descriptiveNote)) {
                    foreach ($repo->services->searchroom->computerPlaces->descriptiveNote->p as $dn) {
                        $computer_places_string .= "<p>" . $dn->__toString() . "</p>";
                    }
                }
                $repos_sorted[$counter]['computer_places'] = self::renderFeature($computer_places_string, "Computer places");
            }

            if (isset($repo->services->searchroom->microfilmPlaces)) {

                $micro_places_string = null;
                if (isset($repo->services->searchroom->microfilmPlaces->num)) {
                    $micro_places_string .= "<p>Number: " . $repo->services->searchroom->microfilmPlaces->num->__toString() . "</p>";
                }
                if (isset($repo->services->searchroom->microfilmPlaces->descriptiveNote)) {
                    foreach ($repo->services->searchroom->microfilmPlaces->descriptiveNote->p as $dn) {
                        $micro_places_string .= "<p>" . $dn->__toString() . "</p>";
                    }
                }
                $repos_sorted[$counter]['micro_places'] = self::renderFeature($micro_places_string, "Microfilm places");
            }

            if (isset($repo->services->searchroom->advancedOrders)) {
                $repos_sorted[$counter]['advanced_orders'] = null;
                foreach ($repo->services->searchroom->advancedOrders as $ao) {
                    if (isset($ao['href'])) {
                        $repos_sorted[$counter]['advanced_orders'] .= "<p><a href='" . $ao['href'] . "' target='_blank'>" . $ao . "</a></p>";
                    } else {
                        $repos_sorted[$counter]['advanced_orders'] .= "<p>" . $ao . "</p>";
                    }
                }
                $repos_sorted[$counter]['advanced_orders'] = self::renderFeature($repos_sorted[$counter]['advanced_orders'], "Advanced orders");
            }

            if (isset($repo->services->searchroom->researchServices)) {
                $repos_sorted[$counter]['research_services'] = null;
                foreach ($repo->services->searchroom->researchServices as $ao) {
                    $repos_sorted[$counter]['research_services'] .= "<p>" . $ao->descriptiveNote->p->__toString() . "</p>";
                }
                $repos_sorted[$counter]['research_services'] = self::renderFeature($repos_sorted[$counter]['research_services'], "Research Services");
            }

            $repos_sorted[$counter]['has_library'] = (isset($repo->services->library['question']) && $repo->services->library['question'] == "yes") ? "Yes" : "No";
            $repos_sorted[$counter]['has_library'] = self::renderFeature($repos_sorted[$counter]['has_library'], "Library?");

            if (isset($repo->services->library)) {

                $library_string = null;
                if (isset($repo->services->library->contact)) {
                    if (isset($repo->services->library->contact->telephone)) {
                        $library_string .= "<p>" . $repo->services->library->contact->telephone->__toString() . "</p>";
                    }
                    if (isset($repo->services->library->contact->email)) {
                        $library_string .= "<p><a target='_blank' href='mailto:" . $repo->services->library->contact->email['href'] . "'>" . $repo->services->library->contact->email->__toString() . "</a></p>";
                    }
                }
                if (isset($repo->services->library->webpage)) {
                    $library_string .= "<p><a href='" . $repo->services->library->webpage['href'] . "' target='_blank'>" . $repo->services->library->webpage->__toString() . "</a></p>";
                }

                $repos_sorted[$counter]['library'] = self::renderFeature($library_string, "Library details");
            }



            if (isset($repo->services->internetAccess)) {
                $repos_sorted[$counter]['internet_access'] = self::renderFeature($repo->services->internetAccess['question'][0]->__toString(), "Internet access");
                $repos_sorted[$counter]['internet_details'] = self::renderFeature(self::arrToPs($repo->services->internetAccess->descriptiveNote->p), "Internet details");
            }

            if (isset($repo->services->searchroom->contact)) {

                $contact_string = null;
                if (isset($repo->services->searchroom->contact->telephone)) {
                    $contact_string .= "<p>" . $repo->services->searchroom->contact->telephone->__toString() . "</p>";
                }
                if (isset($repo->services->searchroom->contact->email)) {
                    $contact_string .= "<p><a target='_blank' href='mailto:" . $repo->services->searchroom->contact->email['href'] . "'>" . $repo->services->searchroom->contact->email->__toString() . "</a></p>";
                }
                if (isset($repo->services->searchroom->contact->webpage)) {
                    $contact_string .= "<p><a target='_blank' href='mailto:" . $repo->services->searchroom->contact->webpage['href'] . "'>" . $repo->services->searchroom->contact->webpage->__toString() . "</a></p>";
                }

                $repos_sorted[$counter]['searchroom_contact'] = self::renderFeature($contact_string, "Search Room Contact");
            }

            if (isset($repo->services->searchroom->photographAllowance)) {
            }

            if (isset($repo->services->internetAccess)) {
                $repos_sorted[$counter]['internet_access'] = self::renderFeature($repo->services->internetAccess['question'][0]->__toString(), "Internet access");
                $repos_sorted[$counter]['internet_info'] = self::renderFeature(self::arrToPs($repo->services->internetAccess->descriptive_note->p), "Internet information");
            }

            if (isset($repo->services->techservices->reproductionser)) {
                $repos_sorted[$counter]['reproduction'] = self::renderFeature($repo->services->techservices->reproductionser['question'][0]->__toString(), "Reproduction");
            }

            /*
            Conservation laboratory
            ?
            */

            // restorationlab

            /*
            if(isset($repo->services->techservices->restorationlab)) {
                $repos_sorted[$counter]['restoration'] = self::renderFeature($repo->services->techservices->restorationlab['question'][0]->__toString(), "Restoration");
            }
            */

            $repos_sorted[$counter]['has_restoration'] = (isset($repo->services->techservices->restorationlab) && $repo->services->techservices->restorationlab['question'] == "yes") ? "Conservation laboratory available" : "No conservation laboratory available";
            $repos_sorted[$counter]['has_restoration'] = self::renderFeature($repos_sorted[$counter]['has_restoration'], "Restoration");

            if (isset($repo->services->techservices->restorationlab)) {
                $rest_string = null;
                if (isset($repo->services->techservices->restorationlab->descriptiveNote)) {
                    foreach ($repo->services->techservices->restorationlab->descriptiveNote->p as $dn) {
                        $rest_string .= "<p>" . $dn->__toString() . "</p>";
                    }
                }

                if (isset($repo->services->techservices->restorationlab->contact)) {
                    if (isset($repo->services->techservices->restorationlab->contact->telephone)) {
                        $rest_string .= "<p>" . $repo->services->techservices->restorationlab->contact->telephone->__toString() . "</p>";
                    }
                    if (isset($repo->services->techservices->restorationlab->contact->email)) {
                        $rest_string .= "<p><a href='mailto:" . $repo->services->techservices->restorationlab->contact->email['href'] . "'>" . $repo->services->techservices->restorationlab->contact->email->__toString() . "</a></p>";
                    }
                }
                $repos_sorted[$counter]['restoration'] = self::renderFeature($rest_string, "Restoration Details");
            }

            $repos_sorted[$counter]['has_reproductionser'] = (isset($repo->services->techservices->restorationlab) && $repo->services->techservices->restorationlab['question'] == "yes") ? "Reproduction services available" : "No reproduction services available";
            $repos_sorted[$counter]['has_reproductionser'] = self::renderFeature($repos_sorted[$counter]['has_reproductionser'], "Reproduction services");

            if (isset($repo->services->techservices->reproductionser)) {
                $rest_string = null;
                if (isset($repo->services->techservices->reproductionser->descriptiveNote)) {
                    foreach ($repo->services->techservices->reproductionser->descriptiveNote->p as $dn) {
                        $rest_string .= "<p>" . $dn->__toString() . "</p>";
                    }
                }

                if (isset($repo->services->techservices->reproductionser->contact)) {
                    if (isset($repo->services->techservices->reproductionser->contact->telephone)) {
                        $rest_string .= "<p>" . $repo->services->techservices->reproductionser->contact->telephone->__toString() . "</p>";
                    }
                    if (isset($repo->services->techservices->reproductionser->contact->email)) {
                        $rest_string .= "<p><a href='mailto:" . $repo->services->techservices->reproductionser->contact->email['href'] . "'>" . $repo->services->techservices->reproductionser->contact->email->__toString() . "</a></p>";
                    }
                }

                // @TODO - refactor into yesno func
                if (isset($repo->services->techservices->reproductionser->digitalser['question'])) {
                    $rest_string .= "<p>Digital services? " . $repo->services->techservices->reproductionser->digitalser['question'] . "</a></p>";
                }
                if (isset($repo->services->techservices->reproductionser->photocopyser['question'])) {
                    $rest_string .= "<p>Photocopy services? " . $repo->services->techservices->reproductionser->photocopyser['question'] . "</a></p>";
                }
                if (isset($repo->services->techservices->reproductionser->photographser['question'])) {
                    $rest_string .= "<p>Photographs services? " . $repo->services->techservices->reproductionser->photographser['question'] . "</a></p>";
                }
                if (isset($repo->services->techservices->reproductionser->microformser['question'])) {
                    $rest_string .= "<p>Microform services? " . $repo->services->techservices->reproductionser->microformser['question'] . "</a></p>";
                }


                $repos_sorted[$counter]['reproductionser'] = self::renderFeature($rest_string, "Reproduction Details");
            }

            if (isset($repo->services->recreationalServices->exhibition)) {
                $repos_sorted[$counter]['exhibition'] = self::renderFeature(self::arrToPs($repo->services->recreationalServices->exhibition->descriptiveNote->p), "Exhibition");
            }

            if (isset($repo->services->recreationalServices->toursSessions)) {
                $repos_sorted[$counter]['tours'] = self::arrToPs($repo->services->recreationalServices->toursSessions->descriptiveNote->p);
                if (isset($repo->services->recreationalServices->toursSessions->webpage)) {
                    $repos_sorted[$counter]['tours'] .= "<p><a href='" . $repo->services->recreationalServices->toursSessions->webpage['href'] . "' target='_blank'>" . $repo->services->recreationalServices->toursSessions->webpage->__toString() . "</a></p>";
                }
                $repos_sorted[$counter]['tours'] = self::renderFeature($repos_sorted[$counter]['tours'], "Guided tours");
            }

            if (isset($repo->services->recreationalServices->otherServices)) {
                if (isset($repo->services->recreationalServices->otherServices->webpage)) {
                    $repos_sorted[$counter]['other'] .= "<p><a href='" . $repo->services->recreationalServices->otherServices->webpage['href'] . "' target='_blank'>" . $repo->services->recreationalServices->otherServices->webpage->__toString() . "</a></p>";
                }
                $repos_sorted[$counter]['other'] = self::renderFeature($repos_sorted[$counter]['other'], "Other services");
            }

            if (isset($repo->services->recreationalServices->refreshment)) {
                $repos_sorted[$counter]['refreshment'] = self::renderFeature(self::arrToPs($repo->services->recreationalServices->refreshment->descriptiveNote->p), "Refreshment area");
            }


            $counter++;
        }

        return $repos_sorted;
    }

    protected static function flattenXmlParts($item)
    {
        $html = null;
        foreach ($item as $i) {
            $html .= "<p>" . $i->__toString() . "</p>";
        }
        return $html;
    }

    protected static function flattenXmlPartsWithLinks($item)
    {
        $html = null;
        foreach ($item as $i) {
            if (isset($i['href'])) {
                $html .= "<p><a href='" . $i['href'] . "'>" . $i->__toString() . "</a></p>";
            } else {
                $html .= "<p>" . $i->__toString() . "</p>";
            }
        }
        return $html;
    }

    protected static function formatXml($xml_processed)
    {

        $o = $xml_processed;
    }

    public static function getCount()
    {
        return self::$count;
    }

    public static function getStart()
    {
        return self::$start;
    }

    public static function getEnd()
    {
        return self::$end;
    }

    protected static function getArchiveFacets()
    {
        return array(
            'country',
            'ai',
            'topic',
            'recordType',
            'levelName',
            'dao',
            'daoType',
            'dateType',
            'startDate',
            'endDate',
        );
    }

    //Justin added in for Names
    protected static function getNameFacets()
    {
        return array(
            'country',
            'ai',
            'entityTypeFacet',
            'dateType',
            'startDate',
            'endDate',
            'language',
            'placesFacet',
        );
    }

    //Justin added in for Institutions
    protected static function getInstitutionFacets()
    {
        return array(
            'country',
            'repositoryTypeFacet',
        );
    }

    protected static function escapeFilterValues($params)
    {

        // return $params;

        // $search = array("+","-","&&","||","!","(",")","{","}","[","]","^","\"","~","*","?",":",chr(92),"/");
        // $replace = array("\+","\-","\&&","\||","\!","\(","\)","\{","\}","\[","\]","\^","".chr(92)."\"","\~","\*","\?","\:",chr(92).chr(92),"\/");

        foreach ($params['filters'] as $set => $values) {
            foreach ($params['filters'][$set] as $k => $v) {
                $params['filters'][$set][$k] = self::escapeSolrValue($params['filters'][$set][$k]);
            }
        }

        return $params;
    }

    static public function escapeSolrValue($string)
    {
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '"', ';', ' ');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\*', '\\?', '\\:', '\\"', '\\;', '\\ ');
        $string = str_replace($match, $replace, $string);

        return $string;
    }

    protected static function addDateFacetQueries($fq)
    {

        // @TODO - dates are different to other filters, so I've left them out of the params for now...

        $parts = array();

        // START
        // cascade - use most specific first
        $got_sd = array();
        $got_sc = array();
        if (isset($_REQUEST['starttimespan_y'])) { // 1729
            foreach ($_REQUEST['starttimespan_y'] as $y) {
                $got_sd[] = substr($y, 0, 3) . "0";
                $got_sc[] = substr($y, 0, 2) . "00";
                $parts['start'][] = self::addDateFacetQueryPart($y, "y", 0);
            }
        }
        if (isset($_REQUEST['starttimespan_d'])) { // 1720
            foreach ($_REQUEST['starttimespan_d'] as $d) {
                if (!in_array($d, $got_sd)) {
                    $got_sc[] = substr($d, 0, 2) . "00";
                    $parts['start'][] = self::addDateFacetQueryPart($d, "d", 0);
                }
            }
        }
        if (isset($_REQUEST['starttimespan_c'])) { // 1700
            foreach ($_REQUEST['starttimespan_c'] as $c) {
                if (!in_array($c, $got_sc)) {
                    $parts['start'][] = self::addDateFacetQueryPart($c, "c", 0);
                }
            }
        }

        // END
        $got_ed = array();
        $got_ec = array();
        if (isset($_REQUEST['endtimespan_y'])) { // 1729
            foreach ($_REQUEST['endtimespan_y'] as $y) {
                $got_ed[] = substr($y, 0, 3) . "0";
                $got_ec[] = substr($y, 0, 2) . "00";
                $parts['end'][] = self::addDateFacetQueryPart($y, "y", 1);
            }
        }
        if (isset($_REQUEST['endtimespan_d'])) { // 1720
            foreach ($_REQUEST['endtimespan_d'] as $d) {
                if (!in_array($d, $got_ed)) {
                    $got_ec[] = substr($d, 0, 2) . "00";
                    $parts['end'][] = self::addDateFacetQueryPart($d, "d", 1);
                }
            }
        }
        if (isset($_REQUEST['endtimespan_c'])) { // 1700
            foreach ($_REQUEST['endtimespan_c'] as $c) {
                if (!in_array($c, $got_ec)) {
                    $parts['end'][] = self::addDateFacetQueryPart($c, "c", 1);
                }
            }
        }

        if (isset($parts['end'])) {
            if (count($parts['end']) == 1) {
                $fq[] = "{!tag=startDate}startDate: " . $parts['end'][0];
            } else {
                $fq[] = "{!tag=startDate}startDate: (" . implode(" OR ", $parts['end']) . ")";
            }
        }

        if (isset($parts['start'])) {
            if (count($parts['start']) == 1) {
                $fq[] = "{!tag=endDate}endDate: " . $parts['start'][0];
            } else {
                $fq[] = "{!tag=endDate}endDate: (" . implode(" OR ", $parts['start']) . ")";
            }
        }

        return $fq;
    }

    protected static function addDateFacetQueryPart($value, $period, $type)
    {

        if ($period == "y") {
//            $start = $value . "-01-01T00\:00\:00.000Z";
//            $end = $value . "-12-31T23\:59\:59.999Z";
            if ($type == 0){ //start type
                $start = $value . "-01-01T00\:00\:00.000Z";
                $end = "9999-12-31T23\:59\:59.999Z";
            }
            else {
                $start = "0000-01-01T00\:00\:00.000Z";
                $end = $value . "-12-31T23\:59\:59.999Z";
            }
        }

        if ($period == "d") {
            $value = substr($value, 0, 3);
            $end_of_decade = intval( $value."0" ) + 9;
//            $start = $value . "0-01-01T00\:00\:00.000Z";
//            $end = $value . "9-12-31T23\:59\:59.999Z";
            if ($type == 0){ //start type
                $start = $value . "0-01-01T00\:00\:00.000Z";
                $end = "9999-12-31T23\:59\:59.999Z";
            }
            else {
                $start = "0000-01-01T00\:00\:00.000Z";
                $end = $end_of_decade . "-12-31T23\:59\:59.999Z";
            }
        }

        if ($period == "c") {
            $value = substr($value, 0, 2);
            $end_of_century = intval( $value."00" ) + 99;
//            $start = $value . "00-01-01T00\:00\:00.000Z";
//            $end = $value . "99-12-31T23\:59\:59.999Z";
            if ($type == 0){ //start type
                $start = $value . "00-01-01T00\:00\:00.000Z";
                $end = "9999-12-31T23\:59\:59.999Z";
            }
            else {
                $start = "0000-01-01T00\:00\:00.000Z";
                $end = $end_of_century . "-12-31T23\:59\:59.999Z";
            }
        }

        $string = "[$start TO $end]";
        return $string;
    }

    protected static function processArchiveFilters($params)
    {

        $params = self::escapeFilterValues($params);

        //self::dump($params);

        $tags = array();
        $fq = array();
        foreach ($params['filters'] as $set => $values) {
            if (count($params['filters'][$set]) > 1) {
                $fq[] = "{!tag=" . self::mapWebFacetToSolr($set) . "}" . self::mapWebFacetToSolr($set) . ":(" . implode(" OR ", $params['filters'][$set]) . ")";
            } else {
                $fq[] = "{!tag=" . self::mapWebFacetToSolr($set) . "}" . self::mapWebFacetToSolr($set) . ":" . $params['filters'][$set][0] . "";
            }
            $tags[] = self::mapWebFacetToSolr($set);
        }

        $fq = self::addDateFacetQueries($fq);
        if (isset($_REQUEST['starttimespan_y']) || isset($_REQUEST['starttimespan_d']) || isset($_REQUEST['starttimespan_c'])) {
            $tags[] = "startDate";
        }
        if (isset($_REQUEST['endtimespan_y']) || isset($_REQUEST['endtimespan_d']) || isset($_REQUEST['endtimespan_c'])) {
            $tags[] = "endDate";
        }

        $ff = self::getArchiveFacets();
        foreach ($ff as $k => $v) {
            if (in_array($v, $tags)) {
                $ff[$k] = "{!ex=$v}$v";
            }
        }

        $data = array(
            "fq" => $fq,
            "ff" => $ff
        );
        //self::dump($data);

        return array(
            "fq" => $fq,
            "ff" => $ff
        );
    }

    //Added by Justin for Names as not in previously
    protected static function processNameFilters($params)
    {
        $params = self::escapeFilterValues($params);

        $tags = array();
        $fq = array();
        foreach ($params['filters'] as $set => $values) {
            if (count($params['filters'][$set]) > 1) {
                $fq[] = "{!tag=" . self::mapWebFacetToSolr($set) . "}" . self::mapWebFacetToSolr($set) . ":(" . implode(" OR ", $params['filters'][$set]) . ")";
            } else {
                $fq[] = "{!tag=" . self::mapWebFacetToSolr($set) . "}" . self::mapWebFacetToSolr($set) . ":" . $params['filters'][$set][0] . "";
            }
            $tags[] = self::mapWebFacetToSolr($set);
        }

        $fq = self::addDateFacetQueries($fq);
        if (isset($_REQUEST['starttimespan_y']) || isset($_REQUEST['starttimespan_d']) || isset($_REQUEST['starttimespan_c'])) {
            $tags[] = "startDate";
        }
        if (isset($_REQUEST['endtimespan_y']) || isset($_REQUEST['endtimespan_d']) || isset($_REQUEST['endtimespan_c'])) {
            $tags[] = "endDate";
        }

        $ff = self::getNameFacets();
        foreach ($ff as $k => $v) {
            if (in_array($v, $tags)) {
                $ff[$k] = "{!ex=$v}$v";
            }
        }

        $data = array(
            "fq" => $fq,
            "ff" => $ff
        );

        return array(
            "fq" => $fq,
            "ff" => $ff
        );
    }

    //Added by Justin for Names as not in previously
    protected static function processInstitutionFilters($params)
    {
        $params = self::escapeFilterValues($params);

        $tags = array();
        $fq = array();
        foreach ($params['filters'] as $set => $values) {
            if (count($params['filters'][$set]) > 1) {
                $fq[] = "{!tag=" . self::mapWebFacetToSolr($set) . "}" . self::mapWebFacetToSolr($set) . ":(" . implode(" OR ", $params['filters'][$set]) . ")";
            } else {
                $fq[] = "{!tag=" . self::mapWebFacetToSolr($set) . "}" . self::mapWebFacetToSolr($set) . ":" . $params['filters'][$set][0] . "";
            }
            $tags[] = self::mapWebFacetToSolr($set);
        }

        $ff = self::getInstitutionFacets();
        foreach ($ff as $k => $v) {
            if (in_array($v, $tags)) {
                $ff[$k] = "{!ex=$v}$v";
            }
        }

        $data = array(
            "fq" => $fq,
            "ff" => $ff
        );

        return array(
            "fq" => $fq,
            "ff" => $ff
        );
    }

    protected static function mapWebFacetToSolr($facet_set_name)
    {

        $mapFilpped = self::getSolrToWebFacetMap();
        $map = array_flip($mapFilpped);

        if (isset($map[$facet_set_name])) {
            return $map[$facet_set_name];
        }
        throw new \Exception(__METHOD__ . " facet [" . $facet_set_name . "] not recognised!"); // stop injection of random facets
        return false;
    }

    public static function getSolrResultsArchives($term, $params)
    {

        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_archives");
        $solr = self::getSolr($core);
        $query = $term;

        $fData = self::processArchiveFilters($params);


        /*
$fData['fq'] = array(
 "0" => "{!tag=country}country:UNITED_KINGDOM\:G\:27",
 //"1" => "{!tag=startDate}startDate:2016-02-01T03\:00Z",
  "1" => "{!tag=startDate}startDate:1901\-01\-01T00\:00\:01Z+10YEAR",
  //"1" => "{!tag=startDate}startDate:1901\-01\-01T00\:00\:01Z",
 //"1" => "{!tag=startDate}startDate:2016-02-01T03:00Z",
);
        */



        $additionalParameters = array(
            //'qt' => "list",
            'facet' => 'true',
            'fq' => $fData['fq'],
            "q.op" => "AND",
            "q.alt" => "*:*",
            "echoParams" => "explicit",
            "tie" => 0.1,
            "hl.fragmenter" => "regex",
            'facet.field' => $fData['ff'],
            'facet.limit' => 2000
        );

        if (isset($params['using'])) {
            switch (strtolower($params['using'])) {
                case "title":
                    $additionalParameters['df'] = "unitTitle";
                    break;
                case "content summary":
                    $additionalParameters['df'] = "scopeContent";
                    break;
                case "reference code":
                    $additionalParameters['df'] = "unitId";
                    break;
                default:
                    $additionalParameters['df'] = "unitTitle";
                    $additionalParameters['qf'] = "unitTitle^2.5 scopeContent^1.3 other^0.5 unitDate^0.4";
            }
        } else {
            $additionalParameters['df'] = "unitTitle";
            $additionalParameters['qf'] = "unitTitle^2.5 scopeContent^1.3 other^0.5 unitDate^0.4";
        }



        // sort by
        if (isset($params['sort'])) {

            switch (strtolower($params['sort'])) {
                case "date":
                    $additionalParameters['sort'] = "startDate asc"; // correct, same as live
                    break;
                case "title":
                    $additionalParameters['sort'] = "unitTitle asc"; // think this is correct, but doesn't match live
                    break;
                case "reference code":
                    $additionalParameters['sort'] = "unitId asc"; // think this is correct, but doesn't match live
                    break;
                case "finding aid no":
                    $additionalParameters['sort'] = "recordId asc"; // correct, same as live
                    break;
                default:
                    // do nothing (relevance) // correct, same as live
            }
        }

        // separate terms
        if (isset($params['separate'])) {
            switch (strtolower($params['separate'])) {
                case true:
                    $additionalParameters['defType'] = "dismax";
                    $additionalParameters['q.op'] = "OR";
                    break;
                default:
                    $additionalParameters['defType'] = "edismax";
            }
        } else {
            $additionalParameters['defType'] = "edismax";
        }

        // since
        //self::dump($params);
        if (isset($params['since']) && strlen($params['since']) == 10) {
            $additionalParameters['fq'][] = "timestamp: [" . $params['since'] . "T00\:00\:00.000Z TO *]";
        }
        //self::dump($additionalParameters);
        //exit();


        return self::processSolrResults($solr, $query, $additionalParameters);
    }

    public static function getSolrResultsNames($term, $params)
    {
        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_names");
        $solr = self::getSolr($core);
        $query = $term;
        $fData = self::processNameFilters($params);

        // @TODO - add facet params

        $additionalParameters = array(
            //'qt' => "list",
            'facet' => 'true',
            //"df" => "names",
            'fq' => $fData['fq'],
            'facet.field' => $fData['ff'],
        );
        // using
        if (isset($params['using'])) {
            switch (strtolower($params['using'])) {
                case "name":
                    $additionalParameters['df'] = "names";
                    break;
                case "identifier":
                    $additionalParameters['df'] = "recordId";
                    break;
                case "place":
                    $additionalParameters['df'] = "places";
                    break;
                case "occupation":
                    $additionalParameters['df'] = "occupations";
                    break;
                case "mandate":
                    $additionalParameters['df'] = "mandatesFacet";
                    break;
                case "function":
                    $additionalParameters['df'] = "functions";
                    break;
                default:
                    $additionalParameters['df'] = "names";
            }
        } else {
            $additionalParameters['df'] = "names";
            $additionalParameters['qf'] = "names^1.3 description other^0.5 places^0.7 mandates^0.7 functions^0.7 occupations^0.7";
        }

        // Relevance | Date

        if (isset($params['sort'])) {

            switch (strtolower($params['sort'])) {
                case "date":
                    $additionalParameters['sort'] = "startDate asc";
                    break;
                default:
                    // do nothing (relevance)
            }
        }

        // separate terms
        if (isset($params['separate'])) {
            switch (strtolower($params['separate'])) {
                case true:
                    $additionalParameters['defType'] = "dismax";
                    $additionalParameters['q.op'] = "OR";
                    break;
                default:
                    $additionalParameters['defType'] = "edismax";
            }
        } else {
            $additionalParameters['defType'] = "edismax";
        }

        return self::processSolrResults($solr, $query, $additionalParameters);
    }

    public static function getSolrResultsInstitutions($term, $params)
    {

        $modx = self::$modx;
        self::$solr_core = $core = $modx->getOption("solr_core_inst");
        $solr = self::getSolr($core);
        $query = $term;

        $fData = self::processInstitutionFilters($params);
        // @TODO - add facet params

        $additionalParameters = array(
            //'qt' => "list",
            'facet' => 'true',
            'fq' => $fData['fq'],
            'facet.field' => $fData['ff']
        );

        // using
        if (isset($params['using'])) {
            switch (strtolower($params['using'])) {
                case "name":
                    $additionalParameters['df'] = "name";
                    break;
                case "place":
                    $additionalParameters['df'] = "places";
                    break;
                    break;
                default:
                    $additionalParameters['df'] = "name";
            }
        } else {
            $additionalParameters['df'] = "name";
            $additionalParameters['qf'] = "name^2.5 otherNames^2 repositories^1.3 address^0.7 places^0.5 description^0.5 other^0.2 countries^0.7 aiGroups^0.7";
        }

        if (isset($params['sort'])) {

            switch (strtolower($params['sort'])) {
                case "name":
                    $additionalParameters['sort'] = "name asc";
                    break;
                default:
                    // do nothing (relevance)
            }
        }

        // separate terms
        if (isset($params['separate'])) {
            switch (strtolower($params['separate'])) {
                case true:
                    $additionalParameters['defType'] = "dismax";
                    $additionalParameters['q.op'] = "OR";
                    break;
                default:
                    $additionalParameters['defType'] = "edismax";
            }
        } else {
            $additionalParameters['defType'] = "edismax";
        }

        return self::processSolrResults($solr, $query, $additionalParameters);
    }

    protected static function processSolrResults($solr, $query, $additionalParameters, $context = false, $all = false)
    {
        try {
            if ($all) {
                $s_results = $solr->search($query, 0, 99999, $additionalParameters);
            } else {
                $s_results = $solr->search($query, self::$request_result_start, self::$results_per_page, $additionalParameters);
            }
        } catch (Exception $e) {
            self::logError("SOLR ERROR - " . print_r($e, 1));
            return false;
        }

        $limit = self::$results_per_page;

        // MH - example of date query
        // http://localhost:8080/solr/ead3s/select?facet.date=startDate&facet.date=endDate&hl=true&f.startDate.facet.date.start=0000-01-01T00:00:00Z&f.daoType.facet.limit=11&f.endDate.facet.date.start=0000-01-01T00:00:00Z&f.endDate.facet.date.end=NOW&wt=javabin&f.country.facet.limit=11&f.endDate.facet.date.gap=%2B200YEARS&f.startDate.facet.date.end=NOW&facet.field=%7B%21ex%3Dcountry%7Dcountry&facet.field=%7B%21ex%3Dai%7Dai&facet.field=%7B%21ex%3Dtopic%7Dtopic&facet.field=%7B%21ex%3DrecordType%7DrecordType&facet.field=%7B%21ex%3DlevelName%7DlevelName&facet.field=%7B%21ex%3Ddao%7Ddao&facet.field=%7B%21ex%3DdaoType%7DdaoType&facet.field=%7B%21ex%3DdateType%7DdateType&qt=list&start=0&f.topic.facet.limit=11&f.recordType.facet.limit=11&f.startDate.facet.date.gap=%2B200YEARS&facet.date.include=lower&rows=10&version=2&f.dateType.facet.limit=11&q=sociedade+manuel&f.ai.facet.limit=11&f.dao.facet.limit=11&spellcheck=on&facet.method=uif&facet.mincount=1&facet=true&f.levelName.facet.limit=11

        // sort counts
        $results = array();
        $results['count'] = (int) $s_results->response->numFound;
        $results['start'] = (self::$request_result_start + 1);
        $results['end'] = (self::$request_result_start + self::$results_per_page);

        // sort facets
        $filters = array();
        foreach ($s_results->facet_counts->facet_fields as $fk => $ff) {

            foreach ($ff as $fi => $v) {
                if ($v > 0) {
                    $filters[self::mapSolrFacetsToWeb($fk)][$fi] = $v;
                }
            }
        }
        $results['filters'] = $filters;
        // sort results
        foreach ($s_results->response->docs as $doc) {

            $results['results'][$doc->id]['matching_term'] = $query;
            foreach ($doc as $field => $value) {
                //JUSTIN UPDATE
                //Updated this code to better reflect arrays.
                //I am handling each field individually until
                // we have worked out all fields Array variables
                //if(is_array($value)) $value = $value[0];
                if (is_array($value)) {
                    if ($field === 'repositoryTypeFacet') {
                        $typeArray = [];
                        foreach ($value as $valueItem) {
                            $typeArray[] = $valueItem;
                        }
                        $typeString = implode(', ', $typeArray);
                        $value = $typeString;
                    } else {
                        $value = $value[0];
                    }
                };
                $results['results'][$doc->id][self::mapSolrFieldToWeb($field)] = $value;
            }
        }
        //        var_dump($_REQUEST);
        //        var_dump($all);
        //        var_dump($query);
        //        var_dump($additionalParameters);
        //        var_dump($results);
        //        die();
        return $results;
    }

    protected static function getSolr($core)
    {

        $modx = self::$modx;
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/Service.php');
        require_once(__DIR__ . '/lib/solr-php/Apache/Solr/HttpTransport/Curl.php');
        return new \Apache_Solr_Service($modx->getOption("solr_address"), $modx->getOption("solr_port"), '/solr/' . $core . '/');
    }

    protected static function mapSolrFacetsToWeb($filter)
    {

        $map = self::getSolrToWebFacetMap();
        if (isset($map[$filter]))
            return $map[$filter];
        return $filter;
    }

    protected static function getSolrToWebFacetMap()
    {

        // @TODO - this may need to be switched by core if it starts to clash
        $map = array(
            // archives
            "country"       => "countries",
            "ai"            => "institutions",
            "recordType"    => "types",
            "levelName"     => "levels",
            "dao"           => "containsdigital",
            "daoType"       => "digitaltypes",
            "dateType"      => "datetypes",
            "aids"          => "aids",
            "startDate"     => "startDate",
            "endDate"       => "endDate",
            "topic"         => "topics",
            "language"      => "language",
            "entityTypeFacet" => "entityTypeFacet",
            "repositoryTypeFacet" => "repositoryTypeFacet"
        );
        return $map;
    }

    protected static function mapSolrFieldToWeb($field)
    {

        // @TODO - this may need to be switched by core if it starts to clash

        $map = array(

            // archives
            "unitTitle" => "title_value",
            "titleProper" => "description_value",
            "unitId" => "reference_value",
            "country" => "country_value",
            "ai" => "institution_value",
            'alternateUnitdate' => "date_display_value_archive",
            // archive link data - keep original names for now

            // names
            "names" => "sample_name_value",
            "dateDescription" => "date_display_value",
            "description" => "description_value",
            "country" => "country_value", // DUPE
            "other" => "other_value",
            "repositoryCode" => "code_value",
            "numberOfArchivalMaterialRelations" => "material_count",
            "numberOfNameRelations" => "name_count",

            // inst
            "name" => "institution_value",
            "address" => "address_value",
            "country" => "country_value", // DUPE
            "repositoryTypeFacet" => "type_value",

        );
        if (isset($map[$field]))
            return $map[$field];
        return $field;
    }

    // returns the single result
    public static function fetchSingleResult($section)
    {

        if (self::$mode == "TEST") {
            // for test mode, we regenerate the set from the key

            self::$single_result = Fixtures::getSingleResult();
        } else {

            if ($section == "search-in-names") {
            } else {
                // for live, we query the postgre database for the resource
                $data = self::getPostgreResults($section);
            }

            $data['xml_formatted'] = self::formatXml($data['xml']);
            if ($section == "search-in-archives") {
                $data['solr_detail'] = self::fetchSolrDetail($_REQUEST['c'], "archive");
            }
            if ($section == "search-in-names") {
                $data['solr_detail'] = self::fetchSolrDetail($_REQUEST['id'], "name");
            }
            self::$single_result = $data;
        }

        return self::$single_result;
    }

    // translates site filter names to database filter names
    public static function translate_params($params)
    {

        $remapped = array();
        $map = self::getMapping();
        foreach ($params['filters'] as $k => $v) {
            if (isset($map[$k])) {
                $remapped[$map[$k]] = $v;
            } else {
                $remapped[$k] = $v;
            }
        }
        return $remapped;
    }

    // @returns array of mapping based on self::$mode
    // @TODO - update this to read from site database
    public static function getMapping()
    {

        // website name => api name

        $map['TEST'] = array(
            "countries" => "country",
            "institutions" => "institution",
            "aids" => "aid",
            "types" => "type",
            "levels" => "level",
            "containsdigitals" => "containsdigital",
            "digitaltypes" => "digitaltype",
            "datetypes" => "datetype",
            "starttimespans" => "starttimespan",
            "endtimespans" => "endtimespan",
            "materiallanguages" => "materiallanguage",
            "topics" => "topic",
            "usings" => "using",
            "starttimespans" => "starttimespan",
        );

        return $map[self::$mode];
    }

    public static function mapFieldToEnglish($field_name)
    {

        $map = array(
            "countries" => "Countries",
            "country" => "Countries",
            "institution" => "Institutions",
            "aid" => "Aids",
            "type" => "Types",
            "level" => "Levels",
            "containsdigital" => "Contains Digital",
            "digitaltype" => "Digital Types",
            "datetype" => "Date Type",
            "starttimespan" => "Start Time Span",
            "endtimespan" => "End Time Span",
            "materiallanguage" => "Material Language",
            "topic" => "Topics",
            "using" => "Using"
        );

        if (isset($map[$field_name])) {
            return $map[$field_name];
        }
        if (isset($map[substr($field_name, 0, -1)])) {
            return $map[substr($field_name, 0, -1)];
        }
        return $field_name;
    }

    // @TODO - this is duped in search JS
    public static function mapValueToEnglish($value)
    {

        $value = strtolower($value);

        $map = array(
            "1" => "Yes",
            "0" => "No",
            "fa" => "Finding Aid",
            "hg" => "Holdings guide",
            "sg" => "Source Guide",
            "separate" => "Separate Terms",
            "clevel" => "Other descriptions",
            "archdesc" => "Fonds description",
            "otherdate" => "Other Date",
            "nodate" => "No Date",
            "first.world.war" => "First World War (1914-1918)",
            "second.world.war" => "Second World War (1939-1945)",
            "civil.wars.events" => "Civil wars (events)",
            "french.revolution" => "French Revolution (1789-1799)",
            "french.revolutionary.wars" => "French Revolutionary Wars (1792-1800)",
            "french.napoleon.i" => "Napoléon I, Emperor of the French, 1769-1821",
            "french.Nnpoleon.iii" => "Napoléon III, Emperor of the French, 1808-1873",
            "napoleonic.wars" => "Napoleonic Wars (1800-1815)",
            "wars.events" => "Wars (events)",
            "germany.sed.fdgb" => "GDR parties and trade unions",
            "german.democratic.republic" => "GDR (German Democratic Republic)",
            "corporatebody" => "Corporate Body",
            "unknownstartdate" => "Unknown Start Date",
            "unknowndate" => "Unknown Date",
            "unknownenddate" => "Unknown End Date",
        );

        if (isset($map[$value])) return $map[$value];

        if (strpos($value, ":") !== false) {
            $bits = explode(":", $value);
            $value = $bits[0];
        }
        $replaceValue = str_replace('_', ' ', $value);
        $value = ucwords($replaceValue);



        return $value;
    }

    public static function renderParametersHtmlFull($search, $format)
    {

        //TODO JUSTIN - Have a look at the mapValueToEnglish function and see if this is right for approach
        $params = $search['params'];
        $params_decoded = json_decode($params);

        $html = null;

        $html .= "<div class='alignedText row'>";
        $html .= "<div class='col col-xs-6 col-md-4'><span class='title'>[[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]:</span></div><div class='col col-xs-6 col-md-8'><span class='param-values'><small>" . $search['name'] . "</small></span></div>";
        $html .= "</div>";
        $html .= "<div class='alignedText row'>";
        $html .= "<div class='col col-xs-6 col-md-4'><span class='title'>[[!%asi.title_search_term? &topic=`default` &namespace=`asi`]]:</span></div><div class='col col-xs-6 col-md-8'><span class='param-values'><small>" . $search['term'] . "</small></span></div>";
        $html .= "</div>";


        foreach ($params_decoded as $k => $v) {
            if (count($params_decoded->$k) > 0) {
                $valueCount = 0;
                $arrayValues = [];
                foreach ($params_decoded->$k as $item) {
                    $englishItem = self::mapValueToEnglish($item);
                    array_push($arrayValues, $englishItem);
                }
                $newValue = implode(', ', $arrayValues);
                $html .= "<div class='alignedText row'>";
                $html .= "<div class='col col-xs-6 col-md-4'><span class='title'>" . self::mapFieldToEnglish($k) . ":</span></div><div class='col col-xs-6 col-md-8'><span class='param-values'><small>" . $newValue . "</small></span></div>";
                $html .= "</div>";
            }
        }


        return $html;
    }

    public static function renderParametersHtml($params, $format)
    {

        //TODO Fixed the function to correctly display params but there is a newer function above called renderParametersHtmlFull which also includes search terms and other filters not previously seen in this one.
        //
        $params_decoded = json_decode($params);

        $html = null;
        foreach ($params_decoded as $k => $v) {
            if (count($params_decoded->$k) > 0) {
                $html .= "<div class='alignedText row'>";
                $html .= "<div class='col col-xs-6 col-md-4'><span class='title'>" . self::mapFieldToEnglish($k) . ":</span></div><div class='col col-xs-6 col-md-8'><span class='param-values'></div>";
                $valueCount = 0;
                $arrayValues = [];
                foreach ($params_decoded->$k as $item) {
                    $englishItem = self::mapValueToEnglish($item);
                    array_push($arrayValues, $englishItem);
                }
                $newValue = implode(', ', $arrayValues);
                $html .= "<small>" . $newValue . "</small>";
                $html .= "</span></div>";
            }
        }


        return $html;
    }

    // @returns array - all filters found in results
    public static function fetchFiltersFromResults($params)
    {

        $map = self::getMapping();

        if (self::$mode == "TEST") {

            $filters = array();
            foreach ($map as $k => $v) {
                $filters[$k] = self::fetchUniqueFilterValues($v, $params);
            }
            return $filters;
        } else {
            return self::$filter_results;
        }
    }

    public static function fetchUniqueFilterValues($name, $params)
    {

        //echo "<br />NAME IS ".$name;

        $vals = array();
        $map = self::getMapping();
        $map_flipped = array_flip($map);

        //var_dump(self::$filter_results);

        foreach (self::$filter_results as $r) {

            // dates do separately
            $vals['starttimespan'] = self::sortDateFilterValues($r);
            $vals['endtimespan'] = self::sortDateFilterValues($r);

            if (isset($r[$name])) {
                $valueKey = $name . "_value";
                $vals[$r[$name]]['filter_name'] = $name;
                $vals[$r[$name]]['filter_name_english'] = self::mapFieldToEnglish($name);
                $vals[$r[$name]]['value'] = $r[$name];
                $vals[$r[$name]]['name'] = $r[$valueKey];
                $vals[$r[$name]]['count'] = (isset($vals[$r[$name]]['count'])) ? ($vals[$r[$name]]['count'] + 1) : 1;


                if (!is_array($params['filters'][$map_flipped[$name]])) {
                    //self::logError($name." could not be found in the mapping!");
                    continue;
                }

                if (in_array($r[$name], $params['filters'][$map_flipped[$name]])) {
                    $vals[$r[$name]]['selected'] = true;
                } else {
                    $vals[$r[$name]]['selected'] = false;
                }
            }
        }
        return $vals;
    }

    protected static function sortDateFilterValues($result)
    {

        // 'date_value' => string '1984-06-04T00:00:01Z' (length=20)




    }

    // sorts params into array from request
    public static function buildParams($request)
    {

        // @TODO - probably want to split these by section
        $filters = array(
            "countries",
            "institutions",
            "aids",
            "types",
            "levels",
            "containsdigital",
            "digitaltypes",
            "datetypes",
            "starttimespan",
            "endtimespan",
            "materiallanguage",
            "topics",
            "startDate",
            "endDate",
            "language",
            "entityTypeFacet",
            "repositoryTypeFacet"
        );

        $active_filters = array();
        foreach ($filters as $f) {
            if (isset($request[$f])) {
                $active_filters[$f] = $request[$f];
            }
        }

        $page = (isset($request['page'])) ? $request['page'] : 0;
        $sort = (isset($request['sort'])) ? $request['sort'] : 0;
        $using = (isset($request['using'])) ? $request['using'] : "default";
        $section = (isset($request['section'])) ? $request['section'] : 0;
        $term = (isset($request['term'])) ? $request['term'] : null;
        $since = (isset($request['since'])) ? $request['since'] : null;
        $separate = (isset($request['separate'])) ? true : null;

        $params = array(
            "term" => $term,
            "section" => $section,
            "page" => $page,
            "sort" => $sort,
            "using" => $using,
            "since" => $since,
            "filters" => $active_filters,
            "separate" => $separate,
        );

        //var_dump($params);

        return $params;
    }

    //JUSTIN I have been editing this to be used on Find An Institution searches
    // searches landscapes based on selected countries
    public static function searchLandscapes($countriesArr)
    {
        $fixtures = self::loadLandscapesSolr();
        //        var_dump($landscapesSolr);
        //        $fixtures = Fixtures::getFixtures();
        $results = array();
        $counter = 0;
        foreach ($countriesArr as $k => $v) {
            $results[$k]['country'] = $k;
            foreach ($fixtures['landscapes'] as $lk => $lv) {
                $results[$k]['landscapes'][$lk] = $lv;
                $counter++;
            }
        }
        return $results;
    }

    // searches institutions based on selected landscapes
    public static function searchInstitutions($landscapesArr, $page)
    {

        $unique = sha1(implode("_", $landscapesArr));
        $unique = substr($unique, 0, 4);

        if (self::$mode == "TEST") {
            self::$results = Fixtures::createResultSet($unique);
        } else {
        }
        return self::$results;
    }

    // @NOTE  - the following peer methods only look at THIS CURRENT user
    // for admin functions, use the ASI ADMIN class extension

    public static function getSearchById($id)
    {

        $modx = self::$modx;

        $id = $modx->quote($id);
        $user_id = $modx->getUser()->get('id');

        $result = $modx->query("SELECT * FROM modx_asi_search WHERE id=" . $id . " AND user_id = " . $user_id);
        if (is_object($result)) {
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    public static function getCollectionById($id)
    {

        $modx = self::$modx;

        $id = $modx->quote($id);
        $user_id = $modx->getUser()->get('id');

        $result = $modx->query("SELECT * FROM modx_asi_collection WHERE id=" . $id . " AND user_id = " . $user_id);
        if (is_object($result)) {
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    // note - this function doesn't check user ownership!
    public static function getCollectionSearches($collection_id)
    {

        $modx = self::$modx;

        $collection_id = $modx->quote($collection_id);

        $sql = "SELECT 
            s.*
            FROM 
            modx_asi_collection c 
            JOIN modx_asi_collection_search cs ON c.id = cs.collection_id 
            JOIN modx_asi_search s ON cs.search_id = s.id 
            WHERE 
            c.id = $collection_id";

        $result = $modx->query($sql);

        if (is_object($result)) {
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    // note - this function doesn't check user ownership!
    public static function getCollectionBookmarks($collection_id)
    {

        $modx = self::$modx;

        $collection_id = $modx->quote($collection_id);

        $sql = "SELECT 
            b.*
            FROM 
            modx_asi_collection c 
            JOIN modx_asi_collection_bookmark cb ON c.id = cb.collection_id 
            JOIN modx_asi_bookmark b ON cb.bookmark_id = b.id 
            WHERE 
            c.id = $collection_id";

        $result = $modx->query($sql);

        if (is_object($result)) {
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    // note this doesn't check ownership
    public static function getCollectionByToken($token)
    {

        $modx = self::$modx;

        $token = $modx->quote($token);

        $sql = "SELECT 
            c.*
            FROM 
            modx_asi_collection c 
            WHERE 
            c.token = $token";

        $result = $modx->query($sql);

        if (is_object($result)) {
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    public static function getBookmarkById($id)
    {

        $modx = self::$modx;

        $id = $modx->quote($id);
        $user_id = $modx->getUser()->get('id');

        $result = $modx->query("SELECT * FROM modx_asi_bookmark WHERE id=" . $id . " AND user_id = " . $user_id);
        if (is_object($result)) {
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    public static function dataIsAllowed($allowed, $data)
    {

        foreach ($data as $k => $v) {
            if (!in_array($k, $allowed)) {
                return false;
            }
        }
        return true;
    }

    public static function buildSqlSets($data)
    {

        $modx = self::$modx;
        $bits = array();
        foreach ($data as $k => $v) {
            $bits[] = "`" . $k . "` = " . $modx->quote($v);
        }
        return implode(', ', $bits);
    }

    public static function updateSearch($id, $data)
    {

        $modx = self::$modx;
        $search = self::getSearchById($id);
        if ($search == false) return false;

        if (self::dataIsAllowed(array('name', 'description'), $data)) {

            $sql = "UPDATE modx_asi_search SET " . self::buildSqlSets($data) . " WHERE id = " . $id . " LIMIT 1";
            $stmt = $modx->prepare($sql);
            $result = $stmt->execute();
            return $result;
        }
        return false;
    }

    public static function updateBookmark($id, $data)
    {

        $modx = self::$modx;
        $bookmark = self::getBookmarkById($id);
        if ($bookmark == false) return false;

        if (self::dataIsAllowed(array('description'), $data)) {

            $sql = "UPDATE modx_asi_bookmark SET " . self::buildSqlSets($data) . " WHERE id = " . $id . " LIMIT 1";
            $stmt = $modx->prepare($sql);
            $result = $stmt->execute();
            return $result;
        }
        return false;
    }

    public static function updateCollection($id, $data)
    {

        $modx = self::$modx;
        $c = self::getCollectionById($id);
        if ($c == false) return false;

        if (self::dataIsAllowed(array('name', 'description'), $data)) {

            $sql = "UPDATE modx_asi_collection SET " . self::buildSqlSets($data) . " WHERE id = " . $id . " LIMIT 1";
            $stmt = $modx->prepare($sql);
            $result = $stmt->execute();
            return $result;
        }
        return false;
    }

    // @TODO - add ID option for update and check ownership
    public static function saveSearch($request)
    {

        //self::logError(print_r($request, 1));

        $modx = self::$modx;

        if (!$request['term']) {
            $request['term'] = $request['name'];
        }
        $data = array(
            'created_at' => date('Y-m-d h:i:s'),
            'last_checked' => date('Y-m-d h:i:s'),
            'name' => $request['name'],
            'description' => $request['description'],
            'params' => $request['filters'],
            'user_id' => $modx->getUser()->get('id'),
            'term' => $request['term'],
            'archive_type' => $request['type'],
            'url' => $request['url']
        );

        if ($request['existing']) {
            $search = $modx->getObject('Search', $request['existing']);
        } else {
            $search = $modx->newObject('Search', $data);
        }

        if ($search->save() == true) {
            //            var_export($data);
            //            die();
            return $search->get('id');
        }

        return false;
    }

    // @TODO - add ID option for update and check ownership
    public static function saveBookmark($request)
    {

        $modx = self::$modx;
        $data = array(
            'created_at' => date('Y-m-d h:i:s'),
            'name' => $request['name'],
            'description' => $request['description'],
            'archive_type' => $request['type'],
            'user_id' => $modx->getUser()->get('id'),
            'url' => $request['url'],
            'resource_id' => $request['resource_id'],
            'param_string' => $request['params'],
        );

        $bookmark = $modx->newObject('Bookmark', $data);
        if ($bookmark->save() == true) {
            return $bookmark->get('id');
        }
        return false;
    }

    public static function saveCollection($request)
    {

        $modx = self::$modx;
        $data = array(
            'created_at' => date('Y-m-d h:i:s'),
            'name' => $request['name'],
            //'description' => $request['description'],
            'user_id' => $modx->getUser()->get('id'),
            'token' => sha1("APE_" . rand(0, 999999) . date('U')),
        );

        $bookmark = $modx->newObject('Collection', $data);
        if ($bookmark->save() == true) {
            return true;
        }
        return false;
    }

    public static function listCollections($request = false)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        // grab the collections with their associated searches and bookmarks
        $sql = "SELECT 
            c.*, 
            GROUP_CONCAT(DISTINCT(cs.search_id)) AS searches,
            GROUP_CONCAT(DISTINCT(cb.bookmark_id)) AS bookmarks,
            COUNT(DISTINCT(cs.search_id)) AS total_searches,
            COUNT(DISTINCT(cb.bookmark_id)) AS total_bookmarks
            FROM 
            modx_asi_collection c 
            LEFT JOIN modx_asi_collection_search cs ON c.id = cs.collection_id 
            LEFT JOIN modx_asi_collection_bookmark cb ON c.id = cb.collection_id 
            WHERE 
            user_id = $user_id 
            GROUP BY c.id 
            ORDER BY priority ASC";

        //echo $sql;
        //self::logError($sql);

        $result = $modx->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($data as $k => $v) { // remove user ids for good practice
            unset($data[$k]['user_id']);
        }

        return $data;
    }

    public static function listCollectionsNotAssignedToThis($target, $target_id)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        if (!is_numeric($target_id)) throw new \Exception(__METHOD__ . " Target ID is not numeric!");

        $sql_target = ($target == "bookmark") ? "cb" : "cs";

        // grab the collections with their associated searches and bookmarks
        $sql = "SELECT 
            c.*, 
            GROUP_CONCAT(DISTINCT(cs.search_id)) AS searches,
            GROUP_CONCAT(DISTINCT(cb.bookmark_id)) AS bookmarks,
            COUNT(DISTINCT(cs.search_id)) AS total_searches,
            COUNT(DISTINCT(cb.bookmark_id)) AS total_bookmarks
            FROM 
            modx_asi_collection c 
            LEFT JOIN modx_asi_collection_search cs ON c.id = cs.collection_id 
            LEFT JOIN modx_asi_collection_bookmark cb ON c.id = cb.collection_id 
            WHERE 
            user_id = $user_id 
            GROUP BY c.id 
            ORDER BY priority ASC";



        //echo $sql;
        //self::logError($sql);

        $result = $modx->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);

        // query is complicated enough as it is, so filter out the target here...
        foreach ($data as $k => $v) {
            unset($data[$k]['user_id']); // remove user ids for good practice
            if ($target == "search") {
                $search_ids = explode(",", $data[$k]['searches']);
                if (in_array($target_id, $search_ids)) {
                    unset($data[$k]);
                }
            }
            if ($target == "bookmark") {
                $bookmark_ids = explode(",", $data[$k]['bookmarks']);
                if (in_array($target_id, $bookmark_ids)) {
                    unset($data[$k]);
                }
            }
        }

        return $data;
    }

    public static function listSearches($request = false)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        $sql = "SELECT s.* FROM modx_asi_search s LEFT JOIN modx_asi_collection_search cs ON s.id = cs.search_id WHERE s.user_id = " . $user_id;

        if (isset($request['params']) and isset($request['params']['collection_id'])) {
            $sql .= " AND cs.collection_id = " . $modx->quote($request['params']['collection_id']);
        }

        $sql .= " GROUP BY s.id";

        $result = $modx->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public static function listBookmarks($request = false)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        // @TODO - this needs a clean up

        $sql = "SELECT b.* FROM modx_asi_bookmark b WHERE b.user_id = " . $user_id;

        if (isset($request['params']) and isset($request['params']['collection_id'])) {
            $sql = "SELECT b.* FROM modx_asi_bookmark b JOIN modx_asi_collection_bookmark cb ON b.id = cb.bookmark_id WHERE user_id = " . $user_id;
            $sql .= " AND cb.collection_id = " . $modx->quote($request['params']['collection_id']);
            $sql .= " GROUP BY b.id";
        }

        //echo $sql;

        $result = $modx->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public static function addSearchToCollection($search, $collection)
    {

        $modx = self::$modx;
        $data = array(
            'created_at' => date('Y-m-d h:i:s'),
            'collection_id' => $collection['id'],
            'search_id' => $search['id'],
        );

        $cs = $modx->newObject('CollectionSearch', $data);
        if ($cs->save() == true) {
            return true;
        }
        return false;
    }

    public static function removeSearchFromCollection($search, $collection)
    {

        $modx = self::$modx;

        $search_id = $search['id'];
        $collection_id = $collection['id'];

        if (!is_numeric($search_id) || !is_numeric($collection_id)) return false;

        $sql = "DELETE FROM modx_asi_collection_search WHERE search_id = " . $search_id . " AND collection_id =" . $collection_id;
        self::logError($sql);
        $stmt = $modx->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public static function removeBookmarkFromCollection($bookmark, $collection)
    {

        $modx = self::$modx;

        $bookmark_id = $bookmark['id'];
        $collection_id = $collection['id'];

        if (!is_numeric($bookmark_id) || !is_numeric($collection_id)) return false;

        $sql = "DELETE FROM modx_asi_collection_bookmark WHERE bookmark_id = " . $bookmark_id . " AND collection_id =" . $collection_id;
        self::logError($sql);
        $stmt = $modx->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public static function addBookmarkToCollection($bookmark, $collection)
    {

        self::logError("Bookmark : " . print_r($bookmark, 1));
        self::logError("Collection : " . print_r($collection, 1));

        $modx = self::$modx;
        $data = array(
            'created_at' => date('Y-m-d h:i:s'),
            'collection_id' => $collection['id'],
            'bookmark_id' => $bookmark['id'],
        );

        $cb = $modx->newObject('CollectionBookmark', $data);
        if ($cb->save() == true) {
            return true;
        }
        return false;
    }

    public static function deleteSearch($search_id)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        if (!is_numeric($search_id)) return false;

        $sql = "DELETE FROM modx_asi_search WHERE user_id = " . $user_id . " AND id =" . $search_id;
        $stmt = $modx->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public static function deleteBookmark($bookmark_id)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        if (!is_numeric($bookmark_id)) return false;

        $sql = "DELETE FROM modx_asi_bookmark WHERE user_id = " . $user_id . " AND id =" . $bookmark_id;
        $stmt = $modx->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public static function deleteCollection($collection_id)
    {

        $modx = self::$modx;
        $user_id = $modx->getUser()->get('id');

        if (!is_numeric($collection_id)) return false;

        $sql = "DELETE FROM modx_asi_collection WHERE user_id = " . $user_id . " AND id =" . $collection_id;
        $stmt = $modx->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public static function query($method, $args = false)
    {

        // @TODO - load presets from user here...

        $call = "get" . ucfirst($method);
        $results = self::$call($args);

        return $results;
    }

    public static function storeFilters($filters)
    {

        foreach ($filters as $key => $value) {
            $_SESSION['filters'][$key] = $value;
        }
    }

    public static function getSelectedFilterValue($identifier)
    {

        $selecteds = array();
        if (isset($_GET[$identifier])) {
            $selecteds = $_GET[$identifier];
        }
        return $selecteds;
    }

    // extracts arrays of avail centuries, decades, years, months from an array of dates
    protected static function extractDateParts($datesArr)
    {

        $centuries = array();
        $decades = array();
        $years = array();
        $months = array();

        rsort($datesArr);
        $datesArr = array_reverse($datesArr);

        foreach ($datesArr as $d) {

            // create the date object
            $short = substr($d, 0, 10);
            $date = \DateTime::createFromFormat("Y-m-d", $short);

            // extract century range
            $centuryStart = substr($date->format('Y'), 0, 2) . "00";
            $clone = clone $date;
            $clone->add(new \DateInterval('P100Y'));
            $centuryEnd = substr($clone->format('Y'), 0, 2) . "00";
            $centuries[$centuryStart] = $centuryStart . " - " . $centuryEnd;

            // extract decades range
            $decadeStart = substr($date->format('Y'), 0, 3) . "0";
            $clone = clone $date;
            $clone->add(new \DateInterval('P10Y'));
            $decadeEnd = substr($clone->format('Y'), 0, 3) . "0";
            $decades[$decadeStart] = $decadeStart . " - " . $decadeEnd;

            // extract years range
            $yearStart = $date->format('Y');
            $clone = clone $date;
            $clone->add(new \DateInterval('P1Y'));
            $yearEnd = $clone->format('Y');
            $years[$yearStart] = $yearStart . " - " . $yearEnd;

            // extract months range
            $month = $date->format('M Y');
            $months[$month] = $month;
        }

        return array(
            "centuries" => $centuries,
            "decades" => $decades,
            "years" => $years,
            "months" => $months
        );
    }

    public static function getStartTimespan()
    {

        // 1920-01-01T00:00:01Z - this is a sample date from the system - 'c' format?

        $dates = array(
            "1972-06-11T00:00:01Z",
            "1981-06-17T00:00:01Z",
            "1981-03-13T00:00:01Z",
            "1984-02-12T00:00:01Z",
            "1984-06-04T00:00:01Z",
            "1985-08-08T00:00:01Z",
            "1986-02-22T00:00:01Z",
            "1988-02-27T00:00:01Z",
            "1989-01-21T00:00:01Z",
            "1989-07-19T00:00:01Z",
            "1994-06-21T00:00:01Z",
            "1997-03-20T00:00:01Z",
            "1999-07-10T00:00:01Z",
            "1901-05-21T00:00:01Z",
            "1907-03-11T00:00:01Z",
            "1920-11-05T00:00:01Z",
            "1922-04-07T00:00:01Z",
            "1934-04-03T00:00:01Z",
            "1945-07-09T00:00:01Z",
            "1946-02-03T00:00:01Z",
            "1949-04-02T00:00:01Z",
            "1953-07-01T00:00:01Z",
            "1957-06-05T00:00:01Z",
            "1958-01-03T00:00:01Z",
            "1963-08-07T00:00:01Z",
            "1966-08-11T00:00:01Z",
            "1969-12-29T00:00:01Z",
            "1972-11-30T00:00:01Z",
            "1972-12-31T00:00:01Z",
        );

        return self::extractDateParts($dates);
    }

    public static function getEndTimespan()
    {

        $dates = array(
            "1972-06-11T00:00:01Z",
            "1981-06-17T00:00:01Z",
            "1981-03-13T00:00:01Z",
            "1984-02-12T00:00:01Z",
            "1984-06-04T00:00:01Z",
            "1985-08-08T00:00:01Z",
            "1986-02-22T00:00:01Z",
            "1988-02-27T00:00:01Z",
            "1989-01-21T00:00:01Z",
            "1989-07-19T00:00:01Z",
            "1994-06-21T00:00:01Z",
            "1997-03-20T00:00:01Z",
            "1999-07-10T00:00:01Z",
            "1901-05-21T00:00:01Z",
            "1907-03-11T00:00:01Z",
            "1920-11-05T00:00:01Z",
            "1922-04-07T00:00:01Z",
            "1934-04-03T00:00:01Z",
            "1945-07-09T00:00:01Z",
            "1946-02-03T00:00:01Z",
            "1949-04-02T00:00:01Z",
            "1953-07-01T00:00:01Z",
            "1957-06-05T00:00:01Z",
            "1958-01-03T00:00:01Z",
            "1963-08-07T00:00:01Z",
            "1966-08-11T00:00:01Z",
            "1969-12-29T00:00:01Z",
            "1972-11-30T00:00:01Z",
            "1972-12-31T00:00:01Z",
        );

        return self::extractDateParts($dates);
    }

    public static function getCountries($args = false)
    {

        /*
        $countries = self::fetchUniqueFilterValues('country');
        var_dump($countries);
        return self::fetchUniqueFilterValues('country');
        */

        $countries = array(
            "Austria",
            "Belgium",
            "Bulgaria",
            "Croatia",
            "Cyprus",
            "Czechia",
            "Denmark",
            "Estonia",
            "Finland",
            "France",
            "Germany",
            "Greece",
            "Hungary",
            "Ireland",
            "Italy",
            "Latvia",
            "Lithuania",
            "Luxembourg",
            "Malta",
            "Netherlands",
            "Poland",
            "Portugal",
            "Romania",
            "Slovakia",
            "Slovenia",
            "Spain",
            "Sweden",
            "United Kingdom"
        );

        $response = array();

        $counter = 0;
        foreach ($countries as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }


    public static function getInstitutions($args = false)
    {

        $ins = array(
            "School of Oriental and African Studies (SOAS) Archives, University of London",
            "Hull University Archives, Hull History Centre",
            "West Glamorgan Archive Service",
            "V&A Archive of Art and Design",
            "University of Manchester Library",
            "V&A Theatre and Performance Collections",
            "University of Glasgow Archive Services",
            "Flintshire Record Office",
            "Borthwick Institute for Archives, University of York",
            "Internationaal Instituut voor Sociale Geschiedenis",
            "Seven Stories Archive",
            "Glamorgan Archives",
            "Cardiff University Archives",
            "National Archives of Ireland",
            "National Co-operative Archive",
            "British Library Manuscript Collections",
            "Newcastle University Special Collections and Archives",
            "Archifau Sir Ddinbych",
            "Heritage Quay, University of Huddersfield",
            "University of Strathclyde Archives and Special Collections",
            "Modern Records Centre, University of Warwick",
            "Archifau Sir Ddinbych",
            "University of Strathclyde Archives and Special Collections"
        );

        $response = array();

        $counter = 0;
        foreach ($ins as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getAids($args = false)
    {

        $aids = array(
            "Finding Aid 1",
            "Finding Aid 2",
            "Finding Aid 3"
        );

        $response = array();

        $counter = 0;
        foreach ($aids as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getTypes($args = false)
    {

        $items = array(
            "Finding aid",
            "Holdings guide",
            "Source guide"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getLevels($args = false)
    {

        $items = array(
            "Other descriptions",
            "Fonds description"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getContainsDigital($args = false)
    {

        $items = array(
            "No digital objects",
            "Contains digital objects"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getDigitalTypes($args = false)
    {

        $items = array(
            "Unspecified",
            "Image",
            "Text",
            "Sound",
            "Video",
            "3D"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getDateTypes($args = false)
    {

        $items = array(
            "Full date",
            "Only descriptive date",
            "No date specified"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getNameDateTypes($args = false)
    {

        $items = array(
            "Unknown date",
            "Timespan with unknown start date",
            "Timespan with unknown end date",
            "Full date",
            "Only descriptive date",
            "No date specified"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getMaterialLanguage($args = false)
    {

        $items = array(
            "English",
            "French",
            "German",
            "Russian"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getLanguage($args = false)
    {

        $items = array(
            "English",
            "French",
            "German",
            "Russian"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getTopic($args = false)
    {

        $items = array(
            "Agriculture",
            "Architecture",
            "Armed forces",
            "Arts",
            "Buildings",
            "Catholicism",
            "Charity",
            "Charters",
            "Churches",
            "Church records and registers",
            "Colonialism",
            "Communism",
            "Concentration camp",
            "Crime",
            "Culture",
            "Democracy",
            "Early modern period",
            "Economics",
            "Education",
            "European Union",
            "First World War",
            "French Revolution",
            "GDR (German Democratic Republic)",
            "GDR parties and trade unions",
            "Genealogy",
            "Genealogy archives",
            "Health",
            "Heresy",
            "Industrialisation",
            "Justice",
            "Lifestyle",
            "Maps",
            "Medical sciences",
            "Medieval period",
            "Monasteries",
            "Municipal government",
            "Music",
            "Napoléon I, Emperor of the French",
            "Napoléon III, Emperor of the French",
            "National administration",
            "Notaries",
            "Photography",
            "Politics",
            "Population cencuses",
            "Poverty",
            "Protestantism",
            "Religion",
            "Revolutions of",
            "Royalty",
            "Schools",
            "Science",
            "Second World War",
            "Slavery",
            "Social history",
            "Socialism",
            "Statistics",
            "Taxation",
            "Trade unions",
            "Transport",
            "Universities",
            "Wars (events)",
            "Women"
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getUsing($args = false)
    {

        $items = array(
            "Title",
            "Content Summary",
            "Reference code",
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getNameusing($args = false)
    {

        $items = array(
            "Name",
            "Identifier",
            "Place",
            "Occupation",
            "Mandate",
            "Function",
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getInstusing($args = false)
    {

        $items = array(
            "Name",
            "Place",
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getEntitytypes($args = false)
    {

        $items = array(
            "Person",
            "Family",
            "Corporate body",
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getRepositoryTypeFacet($args = false)
    {
        return null;
    }

    public static function getEntityTypeFacet($args = false)
    {

        $items = array(
            "Person",
            "Family",
            "Corporate body",
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function getArchivetypes($args = false)
    {

        $items = array(
            "Business archives",
            "Church and religious archives",
            "County/local authority archives",
            "Specialised non-governmental archives and archives of other cultural (heritage) institutions",
            "Media archives",
            "Municipal archives",
            "National archives",
            "Archives of political parties, popular/labour movement and other non-governmental organisations, associations, agencies and foundations",
            "Private persons and family archives",
            "Regional archives",
            "Specialised governmental archives",
            "University and research archives",
        );

        $response = array();

        $counter = 0;
        foreach ($items as $c) {
            $response[] = array('name' => $c, 'value' => $counter);
            $counter++;
        }

        return $response;
    }

    public static function updateUserPrefConfirmDelete($value)
    {

        $modx = self::$modx;
        $user =  $modx->getUser();
        $profile = $user->getOne('Profile');
        $extended = $profile->get('extended');
        if ($value == 1) {
            $extended['userpref_delete'] = "yes";
        } else {
            $extended['userpref_delete'] = "no";
        }
        $profile->set("extended", $extended);
        $profile->save();
        return true;
    }

    public static function domHTML($html)
    {
        $doc = new \DOMDocument();
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        return $doc;
    }

    public static function camelToSpace($str)
    {
        $arr = preg_split('/(?=[A-Z])/', $str);
        return implode(" ", $arr);
    }
}
