<?php return array (
  '04bb047d867ad98dabf06b70a85f58cb' => 
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
  'e65ee69abebb04006db5c196f9331f6d' => 
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
  '601de98105f536e42502b60b527aee25' => 
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
  '5551cb37e0bb594a21a5a6cee836381b' => 
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
  'c295666a79ccb5187882dec0cfbd9b82' => 
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
      'snippet' => '[[+text:neq=``:then=`
    <a href="[[+href]]" [[+style:notempty=`class="[[+style]]"`]] [[+target:notempty=`target="[[+target]]"`]]>[[+text]]</a>
`:else=`

`]]
',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '[[+text:neq=``:then=`
    <a href="[[+href]]" [[+style:notempty=`class="[[+style]]"`]] [[+target:notempty=`target="[[+target]]"`]]>[[+text]]</a>
`:else=`

`]]
',
    ),
  ),
  '4467635f0eea7f811dba3f1ca9e8cf59' => 
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

$cta = $modx->fromJSON($input);
$chunk = (!empty($options)) ? $options : \'callToActionTV\';

if (!is_array($cta) ||
    !isset($cta[\'type\'], $cta[\'value\'], $cta[\'style\'], $cta[\'text\'], $cta[\'resource\'])) {
    return;
}

$cta[\'target\'] = \'\';
switch ($cta[\'type\']) {
    case \'resource\':
        if (!empty($cta[\'resource\'])) {
            $cta[\'href\'] = $modx->makeUrl($cta[\'resource\']);
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
        $cta[\'href\'] = $cta[\'value\'];
        $cta[\'target\'] = \'_blank\';

        break;
}

return $modx->getChunk($chunk, $cta);',
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

$cta = $modx->fromJSON($input);
$chunk = (!empty($options)) ? $options : \'callToActionTV\';

if (!is_array($cta) ||
    !isset($cta[\'type\'], $cta[\'value\'], $cta[\'style\'], $cta[\'text\'], $cta[\'resource\'])) {
    return;
}

$cta[\'target\'] = \'\';
switch ($cta[\'type\']) {
    case \'resource\':
        if (!empty($cta[\'resource\'])) {
            $cta[\'href\'] = $modx->makeUrl($cta[\'resource\']);
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
        $cta[\'href\'] = $cta[\'value\'];
        $cta[\'target\'] = \'_blank\';

        break;
}

return $modx->getChunk($chunk, $cta);',
    ),
  ),
  '88f73ebf84c46e8b7a56f10fbb4a09eb' => 
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
  '0281cbbfc478c98480720436251672c7' => 
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
  'c33894af75ee366def525dd4fb9dd339' => 
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
  'aa3e8810c894d6d8dc21574b0da51359' => 
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
  '266bf03d546d22556ddfd542d4968918' => 
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