<?php
/**
 * Gel Studios Ape API lzy data processor (snippet)
 *
 * This helper takes an ID and returns data for items
 * which cannot be obtained from solr
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     Gel Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 * @param      var recordId (the ID of the FA record in postgre)
 * @param      var section (the section eg "search-in-archives")
 * @return     json response
 */


require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

$params = $_REQUEST;
$id = $params['fa_id'];
$term = $params['term'];
ini_set('max_execution_time', 0);
$response = asi::fetchLazyData($_REQUEST);
header('Content-Type: application/json');
echo json_encode($response);