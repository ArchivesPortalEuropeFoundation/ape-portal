// load the api manager
require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

$page = 0;
$countries = $_REQUEST['countries'];
$landscapes = 0;

$landscapes = array_merge($countries, $landscapes);

$results = asi::searchInstitutions($landscapes, $page);

$html = null;
foreach($results AS $r){
    $html.=$modx->getChunk("asi_institution_result", array(
        'name' => $r['title_value'],
        'type_value' => $r['type_value'],
        'matching_term' => $r['matching_term'],
        'description_value' => $r['description_value'],
    ));
}

return $html;