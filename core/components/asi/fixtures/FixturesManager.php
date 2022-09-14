<?php
/**
 * GEL Studios Asi Fixtures Manager class
 *
 * Builds fixtures for testing ASI
 *
 * Takes a search term and produces a reproducible unique fake set of data
 * Fake data can then be filtered and paginated for accurate behaviour
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     GEL Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 */

namespace asi\fixtures;

class FixturesManager
{
    protected static $injects = array("title", "description", "sample_name");
    protected static $sample_size = 1000;
    protected static $fixtures = null;
    protected static $fixtures_file = MODX_CORE_PATH . 'components/asi/fixtures/data/fixtures.php';

    // returns a single set generated from the id
    public static function getSingleResult($id, $term) {

        $fixtures = self::getFixtures();
        return self::generateSet($id, $term, $fixtures);
    }

    // loads fixtures from the file;
    public static function getFixtures() {

        if(is_null(self::$fixtures)) {
            require(self::$fixtures_file);
            self::$fixtures = $fixtures;
        }
        return self::$fixtures;
    }

    // returns a 'term set' based on filters and pagination
    public static function getResultSet($term, $params, $limit=false, $start=0) {

        $limit = ($limit == false) ? self::$sample_size : $limit;

        $term_set = self::createTermSet($term);
        $result_set = array();
        foreach($term_set AS $term_result) {
            $add = true;
            foreach($term_result AS $k => $v) {
                if(isset($params[$k])) {
                    if(in_array($v, $params[$k])) {
                        // param matches, so carry on
                    }
                    else {
                        // param is set and doesn't match - flag it for removal
                        $add = false;
                        continue;
                    }
                }
            }
            if($add == true) {
                $result_set[]=$term_result;
            }
        }
        // @TODO - this can be improved to stop looping once enough have been found
        return array_slice($result_set, $start, $limit);
    }

    // creates a unique set of results with terms from string
    public static function createTermSet($term, $params=null, $limit=false) {

        $limit = ($limit == false) ? self::$sample_size : $limit;

        $fixtures = self::getFixtures();

        // generate string from params
        $paramsString = (is_array($params)) ? implode("", self::flatten($params) ) : null;

        $ids = array();
        for ($i =0; $i < $limit; $i++) {
            $hash = substr(sha1($i.$term.$paramsString),-6);
            $dec = hexdec($hash);
            $ids[] = $dec;
        }

        $sets = array();
        foreach($ids AS $id) {
            $sets[] = self::generateSet($id, $term, $fixtures);
        }

        return $sets;
    }

    protected static function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a,$b) use (&$return) { $return[$b] = $a; });
        return $return;
    }

    protected static function generateSet($id, $term, $fixtures) {

        $set = array(
            'id' => $id,
            'matching_term' => $term,
        );

        foreach($fixtures AS $key => $value) {
            $doc_key = substr($key, 0, -1);
            $doc_key_value = $doc_key."_value";

            if(in_array($doc_key, self::$injects)) {
                $set[$doc_key_value] = self::pickValue($fixtures[$key], $id, $term, true, true);
                continue;
            }

            $set[$doc_key] = self::pickValue($fixtures[$key], $id, $term);
            $set[$doc_key_value] = self::pickValue($fixtures[$key], $id, $term, true);
        }

        return $set;
    }

    protected static function pickValue($arr, $key, $term, $return_value=false, $inject=false) {

        $arr_len = count($arr);
        $result = ($key / $arr_len);
        if((ctype_digit((string)$result))) {
            $remainder = 0;
        }else{
            $floor = floor($result);
            $closest = $arr_len*$floor;
            $remainder = $key - $closest;
        }
        if($return_value == true) {
            if($inject == true) {
                return self::inject($arr[$remainder], $term, $remainder);
            }
            return $arr[$remainder];
        }
        return $remainder;
    }

    // injects a term into the results to make them appear relevant to search
    protected static function inject($string, $term, $index) {

        $bits = explode(" ", $string);
        array_splice( $bits, $index, 0, "<strong>".$term."</strong>" );
        return implode(" ", $bits);
    }

}