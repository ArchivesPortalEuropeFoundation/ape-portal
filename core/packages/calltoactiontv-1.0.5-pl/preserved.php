<?php return array (
  'f208a2dd3a945d27233aca925886e09f' => 
  array (
    'criteria' => 
    array (
      'name' => 'calltoactiontv',
    ),
    'object' => 
    array (
      'name' => 'calltoactiontv',
      'path' => '{core_path}components/calltoactiontv/',
      'assets_path' => '{assets_path}components/calltoactiontv/',
    ),
  ),
  'bac83e9b80234509102921e33ebc15d8' => 
  array (
    'criteria' => 
    array (
      'key' => 'calltoactiontv.user_name',
    ),
    'object' => 
    array (
      'key' => 'calltoactiontv.user_name',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'calltoactiontv',
      'area' => 'default',
      'editedon' => NULL,
    ),
  ),
  '0d4c49020ab444caf7ac050f30ceb148' => 
  array (
    'criteria' => 
    array (
      'key' => 'calltoactiontv.user_email',
    ),
    'object' => 
    array (
      'key' => 'calltoactiontv.user_email',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'calltoactiontv',
      'area' => 'default',
      'editedon' => NULL,
    ),
  ),
  'fa8568522795c3aa237ee76453fa99e5' => 
  array (
    'criteria' => 
    array (
      'category' => 'CallToActionTV',
    ),
    'object' => 
    array (
      'id' => 33,
      'parent' => 0,
      'category' => 'CallToActionTV',
      'rank' => 0,
    ),
  ),
  'f948cfc0f20a8c2d69c5d1506b8df50f' => 
  array (
    'criteria' => 
    array (
      'name' => 'callToActionTV',
    ),
    'object' => 
    array (
      'id' => 29,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'callToActionTV',
      'description' => '',
      'editor_type' => 0,
      'category' => 33,
      'cache_type' => 0,
      'snippet' => '[[+text:notempty=`<a href="[[+href]]"[[+style:notempty=` class="[[+style]]"`]][[+target:notempty=` target="[[+target]]"`]][[+rel:notempty=` rel="[[+rel]]"`]]>[[+text]]</a>`:isempty=` `]]',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '[[+text:notempty=`<a href="[[+href]]"[[+style:notempty=` class="[[+style]]"`]][[+target:notempty=` target="[[+target]]"`]][[+rel:notempty=` rel="[[+rel]]"`]]>[[+text]]</a>`:isempty=` `]]',
    ),
  ),
  '34ca5a959b9e2c5b230fe604f21709f1' => 
  array (
    'criteria' => 
    array (
      'name' => 'calltoactiontv',
    ),
    'object' => 
    array (
      'id' => 100,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'calltoactiontv',
      'description' => '',
      'editor_type' => 0,
      'category' => 33,
      'cache_type' => 0,
      'snippet' => '/**
 * Snippet/Output Filter for the CallToActionTV.
 *
 * Example call: [[*ctaTV:calltoactiontv=`chunk_name`]]
 * Example call: [[*ctaTV:calltoactiontv]]
 *
 * @package calltoactiontv
 * @subpackage snippet/output filter
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @var string $options
 * @var string $input
 */
$service = $modx->getService(
    \'calltoactiontv\',
    \'CallToActionTV\',
    $modx->getOption(
        \'calltoactiontv.core_path\',
        null,
        $modx->getOption(\'core_path\') . \'components/calltoactiontv/\'
    ) . \'model/calltoactiontv/\'
);

if (!($service instanceof CallToActionTV)) {
    return;
}

$cta            = $modx->fromJSON($input);
$chunk          = (!empty($options)) ? $options : \'callToActionTV\';
$toPlaceholders = !empty($toPlaceholders) ? $toPlaceholders : false;

if (!is_array($cta) ||
    !isset($cta[\'type\'], $cta[\'value\'], $cta[\'style\'], $cta[\'text\'], $cta[\'resource\'])) {
    return;
}

$cta[\'target\'] = \'\';
switch ($cta[\'type\']) {
    case \'resource\':
        if (!empty($cta[\'resource\'])) {
            $params = [];
            if (!empty($cta[\'query_params\'])) {
                parse_str(ltrim($cta[\'query_params\'], \'?\'), $params);
            }
            
            $cta[\'href\'] = $modx->makeUrl($cta[\'resource\'], \'\', $params, \'full\');
        } else {
            $cta[\'href\'] = \'\';
        }

        break;
    case \'tel\':
        $cta[\'href\'] = \'tel:\' . preg_replace(\'/[^\\d+]/\', \'\', $cta[\'value\']);

        break;
    case \'mailto\':
        if (filter_var($cta[\'value\'], FILTER_VALIDATE_EMAIL)) {
            $cta[\'href\'] = \'mailto:\' . $cta[\'value\'];
        } else {
            $cta[\'href\'] = $cta[\'value\'];
        }

        break;
    case \'external\':
        $cta[\'href\']   = strpos($cta[\'value\'], \'http\') !== 0 ? \'http://\' . $cta[\'value\'] : $cta[\'value\'];
        $cta[\'target\'] = \'_blank\';
        $cta[\'rel\']    = \'noopener\';

        break;
}

if (!$toPlaceholders) {
    return $service->getChunk($chunk, $cta);
}

$modx->setPlaceholders($cta, $toPlaceholders);',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Snippet/Output Filter for the CallToActionTV.
 *
 * Example call: [[*ctaTV:calltoactiontv=`chunk_name`]]
 * Example call: [[*ctaTV:calltoactiontv]]
 *
 * @package calltoactiontv
 * @subpackage snippet/output filter
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @var string $options
 * @var string $input
 */
$service = $modx->getService(
    \'calltoactiontv\',
    \'CallToActionTV\',
    $modx->getOption(
        \'calltoactiontv.core_path\',
        null,
        $modx->getOption(\'core_path\') . \'components/calltoactiontv/\'
    ) . \'model/calltoactiontv/\'
);

if (!($service instanceof CallToActionTV)) {
    return;
}

$cta            = $modx->fromJSON($input);
$chunk          = (!empty($options)) ? $options : \'callToActionTV\';
$toPlaceholders = !empty($toPlaceholders) ? $toPlaceholders : false;

if (!is_array($cta) ||
    !isset($cta[\'type\'], $cta[\'value\'], $cta[\'style\'], $cta[\'text\'], $cta[\'resource\'])) {
    return;
}

$cta[\'target\'] = \'\';
switch ($cta[\'type\']) {
    case \'resource\':
        if (!empty($cta[\'resource\'])) {
            $params = [];
            if (!empty($cta[\'query_params\'])) {
                parse_str(ltrim($cta[\'query_params\'], \'?\'), $params);
            }
            
            $cta[\'href\'] = $modx->makeUrl($cta[\'resource\'], \'\', $params, \'full\');
        } else {
            $cta[\'href\'] = \'\';
        }

        break;
    case \'tel\':
        $cta[\'href\'] = \'tel:\' . preg_replace(\'/[^\\d+]/\', \'\', $cta[\'value\']);

        break;
    case \'mailto\':
        if (filter_var($cta[\'value\'], FILTER_VALIDATE_EMAIL)) {
            $cta[\'href\'] = \'mailto:\' . $cta[\'value\'];
        } else {
            $cta[\'href\'] = $cta[\'value\'];
        }

        break;
    case \'external\':
        $cta[\'href\']   = strpos($cta[\'value\'], \'http\') !== 0 ? \'http://\' . $cta[\'value\'] : $cta[\'value\'];
        $cta[\'target\'] = \'_blank\';
        $cta[\'rel\']    = \'noopener\';

        break;
}

if (!$toPlaceholders) {
    return $service->getChunk($chunk, $cta);
}

$modx->setPlaceholders($cta, $toPlaceholders);',
    ),
  ),
  '986bd82b97eba134d209b977c7d8018f' => 
  array (
    'criteria' => 
    array (
      'name' => 'CallToActionTV',
    ),
    'object' => 
    array (
      'id' => 30,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'CallToActionTV',
      'description' => '',
      'editor_type' => 0,
      'category' => 33,
      'cache_type' => 0,
      'plugincode' => '/**
 * CallToActionTV.
 *
 * @package calltoactiontv
 * @subpackage plugin
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVInputPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 */

$corePath = $modx->getOption(
    \'calltoactiontv.core_path\',
    null,
    $modx->getOption(\'core_path\') . \'components/calltoactiontv/\'
);
$callToActionTV = $modx->getService(\'calltoactiontv\', \'CallToActionTV\', $corePath . \'model/calltoactiontv/\');

switch ($modx->event->name) {
    case \'OnManagerPageBeforeRender\':
        $modx->controller->addLexiconTopic(\'calltoactiontv:default\');
        $callToActionTV->includeAssets();

        break;
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath . \'elements/tv/input/\');

        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/input/options/\');

        break;
    case \'OnDocFormRender\':
        $callToActionTV->includeAssets();

        break;
}',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * CallToActionTV.
 *
 * @package calltoactiontv
 * @subpackage plugin
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVInputPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 */

$corePath = $modx->getOption(
    \'calltoactiontv.core_path\',
    null,
    $modx->getOption(\'core_path\') . \'components/calltoactiontv/\'
);
$callToActionTV = $modx->getService(\'calltoactiontv\', \'CallToActionTV\', $corePath . \'model/calltoactiontv/\');

switch ($modx->event->name) {
    case \'OnManagerPageBeforeRender\':
        $modx->controller->addLexiconTopic(\'calltoactiontv:default\');
        $callToActionTV->includeAssets();

        break;
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath . \'elements/tv/input/\');

        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/input/options/\');

        break;
    case \'OnDocFormRender\':
        $callToActionTV->includeAssets();

        break;
}',
    ),
  ),
  'c545b57976ed1cc1512677898bae05a8' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '03b6fe3f2ff0acdd76bcd908828ee619' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '9ce2dac975d4834874b680f250d6b071' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'd13ff790199e5b9f00e437a22abcfeaf' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'OnDocFormRender',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'OnDocFormRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);