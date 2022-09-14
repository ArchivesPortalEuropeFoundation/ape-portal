$query = $modx->newQuery('modResource');
$query->where(array(
    'deleted' => 0,
    'published' => 1,
));

$query->sortby('pagetitle', 'ASC');

$resArray = $modx->getCollection('modResource', $query);

$resources = array();

$resources[] = 'Please select a resource...==';

foreach($resArray as $res) {
  if ($res instanceof modResource) {

  	$string = $res->get('pagetitle');

	if ($res->get('parent') != 0) {
		$parent = $modx->getObject('modResource', $res->get('parent'));

		$string .= " (" . $parent->get('pagetitle') . ")";
	}
    $resources[] = $string . '==' . $res->get('id');
  }
}
$out = implode("||",$resources);

return $out;