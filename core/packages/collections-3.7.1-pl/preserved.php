<?php return array (
  'ff4d59772d55b0ac4ceb81aff19faf8a' => 
  array (
    'criteria' => 
    array (
      'category' => 'Collections',
    ),
    'object' => 
    array (
      'id' => 20,
      'parent' => 0,
      'category' => 'Collections',
      'rank' => 0,
    ),
  ),
  'b3e0070e097f055fc1a5708334295f84' => 
  array (
    'criteria' => 
    array (
      'name' => 'getSelections',
    ),
    'object' => 
    array (
      'id' => 54,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'getSelections',
      'description' => '',
      'editor_type' => 0,
      'category' => 20,
      'cache_type' => 0,
      'snippet' => '/**
 * getSelections
 *
 * DESCRIPTION
 *
 * This snippet is a helper for getResources call.
 * It will allows you to select all linked resources under specific Selection with a usage of getResources snippet.
 * Returns distinct list of linked Resources for given Selections
 *
 * getResources are required
 *
 * PROPERTIES:
 *
 * &sortdir                 string  optional    Direction of sorting by linked resource\'s menuindex. Default: ASC
 * &selections              string  optional    Comma separated list of Selection IDs for which should be retrieved linked resources. Default: empty string
 * &getResourcesSnippet     string  optional    Name of getResources snippet. Default: getResources
 *
 * USAGE:
 *
 * [[getSelections? &selections=`1` &tpl=`rowTpl`]]
 * [[getSelections? &selections=`1` &tpl=`rowTpl` &sortby=`RAND()`]]
 *
 */

$collections = $modx->getService(\'collections\',\'Collections\',$modx->getOption(\'collections.core_path\',null,$modx->getOption(\'core_path\').\'components/collections/\').\'model/collections/\',$scriptProperties);
if (!($collections instanceof Collections)) return \'\';

$getResourcesSnippet = $modx->getOption(\'getResourcesSnippet\', $scriptProperties, \'getResources\');

$getResourcesExists = $modx->getCount(\'modSnippet\', array(\'name\' => $getResourcesSnippet));
if ($getResourcesExists == 0) return \'getResources not found\';

$sortDir = strtolower($modx->getOption(\'sortdir\', $scriptProperties, \'asc\'));
$selections = $modx->getOption(\'selections\', $scriptProperties, \'\');
$sortBy = $modx->getOption(\'sortby\', $scriptProperties, \'\');
$excludeToPlaceholder = $modx->getOption(\'excludeToPlaceholder\', $scriptProperties, \'\');

$selections = $modx->collections->explodeAndClean($selections);

if ($sortDir != \'asc\') {
    $sortDir = \'desc\';
}

$linkedResourcesQuery = $modx->newQuery(\'CollectionSelection\');

if (!empty($selections)) {
    $linkedResourcesQuery->where(array(
        \'collection:IN\' => $selections
    ));
}

if ($sortBy == \'\') {
    $linkedResourcesQuery->sortby(\'menuindex\', $sortDir);
}

$linkedResourcesQuery->select(array(
    \'resource\' => \'DISTINCT(resource)\',
    \'menuindex\' => \'menuindex\'
));

$linkedResourcesQuery->prepare();

$linkedResourcesQuery->stmt->execute();

$linkedResources = $linkedResourcesQuery->stmt->fetchAll(PDO::FETCH_COLUMN, 0);

if (!empty($excludeToPlaceholder)) {
    $excludeResources = array();
    foreach($linkedResources as $res) {
        $excludeResources[] = \'-\' . $res;
    }
    $excludeResources = implode(\',\', $excludeResources);
    $modx->setPlaceholder($excludeToPlaceholder, $excludeResources);
}

$linkedResources = implode(\',\', $linkedResources);

$properties = $scriptProperties;
unset($properties[\'selections\']);

$properties[\'resources\'] = $linkedResources;
$properties[\'parents\'] = ($properties[\'getResourcesSnippet\'] == \'pdoResources\') ? 0 : -1;

if ($sortBy == \'\') {
    $properties[\'sortby\'] = \'FIELD(modResource.id, \' . $linkedResources . \' )\';
    $properties[\'sortdir\'] = \'asc\';
}

return $modx->runSnippet($getResourcesSnippet, $properties);',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * getSelections
 *
 * DESCRIPTION
 *
 * This snippet is a helper for getResources call.
 * It will allows you to select all linked resources under specific Selection with a usage of getResources snippet.
 * Returns distinct list of linked Resources for given Selections
 *
 * getResources are required
 *
 * PROPERTIES:
 *
 * &sortdir                 string  optional    Direction of sorting by linked resource\'s menuindex. Default: ASC
 * &selections              string  optional    Comma separated list of Selection IDs for which should be retrieved linked resources. Default: empty string
 * &getResourcesSnippet     string  optional    Name of getResources snippet. Default: getResources
 *
 * USAGE:
 *
 * [[getSelections? &selections=`1` &tpl=`rowTpl`]]
 * [[getSelections? &selections=`1` &tpl=`rowTpl` &sortby=`RAND()`]]
 *
 */

$collections = $modx->getService(\'collections\',\'Collections\',$modx->getOption(\'collections.core_path\',null,$modx->getOption(\'core_path\').\'components/collections/\').\'model/collections/\',$scriptProperties);
if (!($collections instanceof Collections)) return \'\';

$getResourcesSnippet = $modx->getOption(\'getResourcesSnippet\', $scriptProperties, \'getResources\');

$getResourcesExists = $modx->getCount(\'modSnippet\', array(\'name\' => $getResourcesSnippet));
if ($getResourcesExists == 0) return \'getResources not found\';

$sortDir = strtolower($modx->getOption(\'sortdir\', $scriptProperties, \'asc\'));
$selections = $modx->getOption(\'selections\', $scriptProperties, \'\');
$sortBy = $modx->getOption(\'sortby\', $scriptProperties, \'\');
$excludeToPlaceholder = $modx->getOption(\'excludeToPlaceholder\', $scriptProperties, \'\');

$selections = $modx->collections->explodeAndClean($selections);

if ($sortDir != \'asc\') {
    $sortDir = \'desc\';
}

$linkedResourcesQuery = $modx->newQuery(\'CollectionSelection\');

if (!empty($selections)) {
    $linkedResourcesQuery->where(array(
        \'collection:IN\' => $selections
    ));
}

if ($sortBy == \'\') {
    $linkedResourcesQuery->sortby(\'menuindex\', $sortDir);
}

$linkedResourcesQuery->select(array(
    \'resource\' => \'DISTINCT(resource)\',
    \'menuindex\' => \'menuindex\'
));

$linkedResourcesQuery->prepare();

$linkedResourcesQuery->stmt->execute();

$linkedResources = $linkedResourcesQuery->stmt->fetchAll(PDO::FETCH_COLUMN, 0);

if (!empty($excludeToPlaceholder)) {
    $excludeResources = array();
    foreach($linkedResources as $res) {
        $excludeResources[] = \'-\' . $res;
    }
    $excludeResources = implode(\',\', $excludeResources);
    $modx->setPlaceholder($excludeToPlaceholder, $excludeResources);
}

$linkedResources = implode(\',\', $linkedResources);

$properties = $scriptProperties;
unset($properties[\'selections\']);

$properties[\'resources\'] = $linkedResources;
$properties[\'parents\'] = ($properties[\'getResourcesSnippet\'] == \'pdoResources\') ? 0 : -1;

if ($sortBy == \'\') {
    $properties[\'sortby\'] = \'FIELD(modResource.id, \' . $linkedResources . \' )\';
    $properties[\'sortdir\'] = \'asc\';
}

return $modx->runSnippet($getResourcesSnippet, $properties);',
    ),
  ),
  'ccff462c18b5f45ebab463b95b25a999' => 
  array (
    'criteria' => 
    array (
      'name' => 'Collections',
    ),
    'object' => 
    array (
      'id' => 19,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Collections',
      'description' => '',
      'editor_type' => 0,
      'category' => 20,
      'cache_type' => 0,
      'plugincode' => '/**
 * Collections
 *
 * DESCRIPTION
 *
 * This plugin inject JS to handle proper working of close buttons in Resource\'s panel (OnDocFormPrerender)
 * This plugin handles setting proper show_in_tree parameter (OnBeforeDocFormSave, OnResourceSort)
 *
 * @var modX $modx
 * @var array $scriptProperties
 */
$corePath = $modx->getOption(\'collections.core_path\', null, $modx->getOption(\'core_path\', null, MODX_CORE_PATH) . \'components/collections/\');
/** @var Collections $collections */
$collections = $modx->getService(
    \'collections\',
    \'Collections\',
    $corePath . \'model/collections/\',
    array(
        \'core_path\' => $corePath
    )
);

if (!($collections instanceof Collections)) return \'\';

$className = "\\\\Collections\\\\Events\\\\{$modx->event->name}";
if (class_exists($className)) {
    /** @var \\Collections\\Events\\Event $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}

return;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Collections
 *
 * DESCRIPTION
 *
 * This plugin inject JS to handle proper working of close buttons in Resource\'s panel (OnDocFormPrerender)
 * This plugin handles setting proper show_in_tree parameter (OnBeforeDocFormSave, OnResourceSort)
 *
 * @var modX $modx
 * @var array $scriptProperties
 */
$corePath = $modx->getOption(\'collections.core_path\', null, $modx->getOption(\'core_path\', null, MODX_CORE_PATH) . \'components/collections/\');
/** @var Collections $collections */
$collections = $modx->getService(
    \'collections\',
    \'Collections\',
    $corePath . \'model/collections/\',
    array(
        \'core_path\' => $corePath
    )
);

if (!($collections instanceof Collections)) return \'\';

$className = "\\\\Collections\\\\Events\\\\{$modx->event->name}";
if (class_exists($className)) {
    /** @var \\Collections\\Events\\Event $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}

return;',
    ),
  ),
  '55e95853c81f2ac7cd1ba50bc8a7661b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnManagerPageInit',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnManagerPageInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '54cf5fed1c34df9919da65db413e07af' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnBeforeDocFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnBeforeDocFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '0ff741145b3d2eb79035852fc1006d09' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnResourceBeforeSort',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnResourceBeforeSort',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '976270e0b176b5cb737a59b26b3eef11' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '2ba7b5a306475dfae0003a16a18d734e' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnBeforeEmptyTrash',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnBeforeEmptyTrash',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '603a88f3ad4d811a48fbdf8225efc6b0' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnDocFormRender',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnDocFormRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '352b406b421fe58f46e3909da82b0c91' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'aa5b0de9093bcf0cc9094509556ddfa7' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'FredOnBeforeGetResourceTree',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'FredOnBeforeGetResourceTree',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '9cf5292ca79214e26a7a50dc29f8f757' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'FredBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'FredBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '04e220064ddad620ba726453ce10f1bc' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnResourceDuplicate',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnResourceDuplicate',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);