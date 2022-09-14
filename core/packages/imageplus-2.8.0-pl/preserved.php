<?php return array (
  'afb8d2e8fcc62d3bd943491b5b1ebe05' => 
  array (
    'criteria' => 
    array (
      'name' => 'imageplus',
    ),
    'object' => 
    array (
      'name' => 'imageplus',
      'path' => '{core_path}components/imageplus/',
      'assets_path' => '{assets_path}components/imageplus/',
    ),
  ),
  '3d547b98f2370ef83f14607ee9d9ff11' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.debug',
    ),
    'object' => 
    array (
      'key' => 'imageplus.debug',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'imageplus',
      'area' => 'system',
      'editedon' => NULL,
    ),
  ),
  '5f1ff689d05bdf31caee82b8596c30da' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.target_width',
    ),
    'object' => 
    array (
      'key' => 'imageplus.target_width',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '1b264919c990434ce4f1f2b6053220ae' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.target_height',
    ),
    'object' => 
    array (
      'key' => 'imageplus.target_height',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '5e4c2c6387399d1d8f152da847119097' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.target_ratio',
    ),
    'object' => 
    array (
      'key' => 'imageplus.target_ratio',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '6a40d43387a246b7f6594331ad728997' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.thumbnail_width',
    ),
    'object' => 
    array (
      'key' => 'imageplus.thumbnail_width',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  'f3dd795af6450c150635454cc0e8fd29' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.allow_alt_tag',
    ),
    'object' => 
    array (
      'key' => 'imageplus.allow_alt_tag',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '7239bf000ae57fb4fc0b5606d6e94935' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.allow_caption',
    ),
    'object' => 
    array (
      'key' => 'imageplus.allow_caption',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '710a03faf56a7356d65276ee46d6705b' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.allow_credits',
    ),
    'object' => 
    array (
      'key' => 'imageplus.allow_credits',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  'c9dac8edf37f07f01815dbb928f9ce5b' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.select_config',
    ),
    'object' => 
    array (
      'key' => 'imageplus.select_config',
      'value' => '[]',
      'xtype' => 'sizes-ratio-grid',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '936daef7eebcf5a8e5c023aef3523c24' => 
  array (
    'criteria' => 
    array (
      'key' => 'imageplus.force_config',
    ),
    'object' => 
    array (
      'key' => 'imageplus.force_config',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'imageplus',
      'area' => 'imageplus',
      'editedon' => NULL,
    ),
  ),
  '095e60f35c1b726c4821d91c06a09fcd' => 
  array (
    'criteria' => 
    array (
      'category' => 'ImagePlus',
    ),
    'object' => 
    array (
      'id' => 28,
      'parent' => 0,
      'category' => 'ImagePlus',
      'rank' => 0,
    ),
  ),
  'f88d2e574df9b0a6df8c8090e5c2fee1' => 
  array (
    'criteria' => 
    array (
      'name' => 'ImagePlus.demo',
    ),
    'object' => 
    array (
      'id' => 20,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ImagePlus.demo',
      'description' => 'Demo chunk for Image+ template variable output.',
      'editor_type' => 0,
      'category' => 28,
      'cache_type' => 0,
      'snippet' => '<div>
    <h3>Image+ Demo Chunk</h3>
    <table>
        <thead>
        <tr>
            <th>Description</th>
            <th>Current Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>[[%imageplus.placeholder.url? &namespace=`imageplus`]]</td>
            <td>[[+url]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.alt? &namespace=`imageplus`]]</td>
            <td>[[+alt]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.width? &namespace=`imageplus`]]</td>
            <td>[[+width]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.height? &namespace=`imageplus`]]</td>
            <td>[[+height]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.source.src? &namespace=`imageplus`]]</td>
            <td>[[+source.src]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.source.width? &namespace=`imageplus`]]</td>
            <td>[[+source.width]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.source.height? &namespace=`imageplus`]]</td>
            <td>[[+source.height]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.width? &namespace=`imageplus`]]</td>
            <td>[[+crop.width]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.height? &namespace=`imageplus`]]</td>
            <td>[[+crop.height]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.x? &namespace=`imageplus`]]</td>
            <td>[[+crop.x]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.y? &namespace=`imageplus`]]</td>
            <td>[[+crop.y]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.options? &namespace=`imageplus`]]</td>
            <td>[[+options]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.options? &namespace=`imageplus`]]</td>
            <td>[[+crop.options]]</td>
        </tr>
        </tbody>
    </table>

    <h4>Default image output</h4>

    <div>
        <img src="[[+url]]" alt="[[+alt]]"/>
        [[+caption:notempty=`<p class="caption">[[+caption]]</p>`]]
        [[+credits:notempty=`<p class="credits">[[+credits]]</p>`]]
    </div>

    <h4>Responsive image output (different crops for different viewports)</h4>

    <p>
        <picture>
            <source media="(min-width: 36em)"
                    srcset="[[+source.src:pthumb=`w=1024`]] 1024w,
                        [[+source.src:pthumb=`w=640`]] 640w,
                        [[+source.src:pthumb=`w=320`]] 320w"
                    sizes="33.3vw"/>
            <source srcset="[[+source.src:pthumb=`[[+crop.options]]&w=640`]] 2x,
                        [[+source.src:pthumb=`[[+crop.options]]&w=320`]] 1x"/>
            <img src="[[+url]]" alt="[[+alt]]"/>
        </picture>
    </p>
    [[+caption:notempty=`<p class="caption">[[+caption]]</p>`]]
    [[+credits:notempty=`<p class="credits">[[+credits]]</p>`]]
</div>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<div>
    <h3>Image+ Demo Chunk</h3>
    <table>
        <thead>
        <tr>
            <th>Description</th>
            <th>Current Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>[[%imageplus.placeholder.url? &namespace=`imageplus`]]</td>
            <td>[[+url]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.alt? &namespace=`imageplus`]]</td>
            <td>[[+alt]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.width? &namespace=`imageplus`]]</td>
            <td>[[+width]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.height? &namespace=`imageplus`]]</td>
            <td>[[+height]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.source.src? &namespace=`imageplus`]]</td>
            <td>[[+source.src]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.source.width? &namespace=`imageplus`]]</td>
            <td>[[+source.width]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.source.height? &namespace=`imageplus`]]</td>
            <td>[[+source.height]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.width? &namespace=`imageplus`]]</td>
            <td>[[+crop.width]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.height? &namespace=`imageplus`]]</td>
            <td>[[+crop.height]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.x? &namespace=`imageplus`]]</td>
            <td>[[+crop.x]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.y? &namespace=`imageplus`]]</td>
            <td>[[+crop.y]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.options? &namespace=`imageplus`]]</td>
            <td>[[+options]]</td>
        </tr>
        <tr>
            <td>[[%imageplus.placeholder.crop.options? &namespace=`imageplus`]]</td>
            <td>[[+crop.options]]</td>
        </tr>
        </tbody>
    </table>

    <h4>Default image output</h4>

    <div>
        <img src="[[+url]]" alt="[[+alt]]"/>
        [[+caption:notempty=`<p class="caption">[[+caption]]</p>`]]
        [[+credits:notempty=`<p class="credits">[[+credits]]</p>`]]
    </div>

    <h4>Responsive image output (different crops for different viewports)</h4>

    <p>
        <picture>
            <source media="(min-width: 36em)"
                    srcset="[[+source.src:pthumb=`w=1024`]] 1024w,
                        [[+source.src:pthumb=`w=640`]] 640w,
                        [[+source.src:pthumb=`w=320`]] 320w"
                    sizes="33.3vw"/>
            <source srcset="[[+source.src:pthumb=`[[+crop.options]]&w=640`]] 2x,
                        [[+source.src:pthumb=`[[+crop.options]]&w=320`]] 1x"/>
            <img src="[[+url]]" alt="[[+alt]]"/>
        </picture>
    </p>
    [[+caption:notempty=`<p class="caption">[[+caption]]</p>`]]
    [[+credits:notempty=`<p class="credits">[[+credits]]</p>`]]
</div>',
    ),
  ),
  '35ff6b6bd8620567be3bb84677024ade' => 
  array (
    'criteria' => 
    array (
      'name' => 'ImagePlus.image',
    ),
    'object' => 
    array (
      'id' => 21,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ImagePlus.image',
      'description' => 'Demo chunk for Image+ snippet output.',
      'editor_type' => 0,
      'category' => 28,
      'cache_type' => 0,
      'snippet' => '<img src="[[+url]]" alt="[[+alt]]"/>
[[+caption:notempty=`<p class="caption">[[+caption]]</p>`]]
[[+credits:notempty=`<p class="credits">[[+credits]]</p>`]]
',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<img src="[[+url]]" alt="[[+alt]]"/>
[[+caption:notempty=`<p class="caption">[[+caption]]</p>`]]
[[+credits:notempty=`<p class="credits">[[+credits]]</p>`]]
',
    ),
  ),
  'fd88bb4770410a8dfe936cc87e62555d' => 
  array (
    'criteria' => 
    array (
      'name' => 'ImagePlus',
    ),
    'object' => 
    array (
      'id' => 80,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ImagePlus',
      'description' => 'Snippet as alternative to Image+ TV Output Type',
      'editor_type' => 0,
      'category' => 28,
      'cache_type' => 0,
      'snippet' => '/**
 * ImagePlus Snippet as alternative to Image+ TV Output Type
 *
 * Copyright 2013-2015 by Alan Pich <alan.pich@gmail.com>
 * Copyright 2015-2017 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package imageplus
 * @subpackage snippet
 *
 * @author Alan Pich <alan.pich@gmail.com>
 * @author Thomas Jakobi <thomas.jakobi@partout.info>
 * @copyright Alan Pich 2013-2015
 * @copyright Thomas Jakobi 2015-2017
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$corePath = $modx->getOption(\'imageplus.core_path\', null, $modx->getOption(\'core_path\') . \'components/imageplus/\');
/** @var ImagePlus $imageplus */
$imageplus = $modx->getService(\'imageplus\', \'ImagePlus\', $corePath . \'model/imageplus/\', array(
    \'core_path\' => $corePath
));

$tvname = $modx->getOption(\'tvname\', $scriptProperties, \'\', true);
$docid = $modx->getOption(\'docid\', $scriptProperties, $modx->resource->get(\'id\'), true);
$type = $modx->getOption(\'type\', $scriptProperties, \'\', true);
$options = $modx->getOption(\'options\', $scriptProperties, \'\', true);
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'ImagePlus.image\', true);
$value = $modx->getOption(\'value\', $scriptProperties, \'\', true);
$debug = $modx->getOption(\'debug\', $scriptProperties, $imageplus->getOption(\'debug\'), false);

if ($value) {
    // Value is set by snippet property
    $data = json_decode($value);
    if (!$data) {
        if ($debug) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, \'Unable to decode JSON in snippet property\', \'\', \'Image+\');
            return \'Unable to decode JSON in snippet property\';
        }
    }
    // No TV is used
    $tv = null;
    $tvOutputProperties = array();
} else {
    // Value is retreived from template variable
    /** @var modTemplateVar $tv */
    $tv = $modx->getObject(\'modTemplateVar\', array(\'name\' => $tvname));
    if ($tv) {
        // Get the raw content of the TV
        $value = $tv->getValue($docid);
        $value = $tv->processBindings($value, $docid);
        $tvOutputProperties = $tv->get(\'output_properties\');
        foreach ($tvOutputProperties as &$tvOutputProperty) {
            switch ($tvOutputProperty) {
                case \'true\' :
                    $tvOutputProperty = true;
                    break;
                case \'false\' :
                    $tvOutputProperty = false;
                    break;
            }
        }
    } else {
        if ($debug) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, "Template Variable \'{$tvname}\' not found.", \'\', \'Image+\');
            return "Template Variable \'{$tvname}\' not found.";
        }
        $tvOutputProperties = array();
    }
}

$output = \'\';
// Render output
switch ($type) {
    case \'check\':
        $data = json_decode($value);
        $output = ($data && $data->sourceImg->src) ? \'image\' : \'noimage\';
        break;
    case \'tpl\':
        $data = json_decode($value);
        $output = ($value) ? $imageplus->getImageURL($value, array_merge($tvOutputProperties, $scriptProperties, array(
            \'docid\' => $docid,
            \'phpThumbParams\' => $options,
            \'outputChunk\' => $tpl,
            \'caption\' => ($data && $data->caption) ? $data->caption : \'\',
            \'credits\' => ($data && $data->credits) ? $data->credits : \'\'
        )), $tv) : \'\';
        break;
    case \'thumb\':
    default:
        $output = ($value) ? $imageplus->getImageURL($value, array_merge($tvOutputProperties, $scriptProperties, array(
            \'docid\' => $docid,
            \'phpThumbParams\' => $options
        )), $tv) : \'\';
        break;
}
return $output;',
      'locked' => 0,
      'properties' => 'a:6:{s:6:"tvname";a:7:{s:4:"name";s:6:"tvname";s:4:"desc";s:26:"imageplus.imageplus.tvname";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:20:"imageplus:properties";s:4:"area";s:0:"";}s:5:"docid";a:7:{s:4:"name";s:5:"docid";s:4:"desc";s:25:"imageplus.imageplus.docid";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:20:"imageplus:properties";s:4:"area";s:0:"";}s:4:"type";a:7:{s:4:"name";s:4:"type";s:4:"desc";s:24:"imageplus.imageplus.type";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:20:"imageplus:properties";s:4:"area";s:0:"";}s:7:"options";a:7:{s:4:"name";s:7:"options";s:4:"desc";s:27:"imageplus.imageplus.options";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:20:"imageplus:properties";s:4:"area";s:0:"";}s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:23:"imageplus.imageplus.tpl";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:15:"ImagePlus.image";s:7:"lexicon";s:20:"imageplus:properties";s:4:"area";s:0:"";}s:8:"fromJson";a:7:{s:4:"name";s:8:"fromJson";s:4:"desc";s:28:"imageplus.imageplus.fromJson";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:20:"imageplus:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * ImagePlus Snippet as alternative to Image+ TV Output Type
 *
 * Copyright 2013-2015 by Alan Pich <alan.pich@gmail.com>
 * Copyright 2015-2017 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package imageplus
 * @subpackage snippet
 *
 * @author Alan Pich <alan.pich@gmail.com>
 * @author Thomas Jakobi <thomas.jakobi@partout.info>
 * @copyright Alan Pich 2013-2015
 * @copyright Thomas Jakobi 2015-2017
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$corePath = $modx->getOption(\'imageplus.core_path\', null, $modx->getOption(\'core_path\') . \'components/imageplus/\');
/** @var ImagePlus $imageplus */
$imageplus = $modx->getService(\'imageplus\', \'ImagePlus\', $corePath . \'model/imageplus/\', array(
    \'core_path\' => $corePath
));

$tvname = $modx->getOption(\'tvname\', $scriptProperties, \'\', true);
$docid = $modx->getOption(\'docid\', $scriptProperties, $modx->resource->get(\'id\'), true);
$type = $modx->getOption(\'type\', $scriptProperties, \'\', true);
$options = $modx->getOption(\'options\', $scriptProperties, \'\', true);
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'ImagePlus.image\', true);
$value = $modx->getOption(\'value\', $scriptProperties, \'\', true);
$debug = $modx->getOption(\'debug\', $scriptProperties, $imageplus->getOption(\'debug\'), false);

if ($value) {
    // Value is set by snippet property
    $data = json_decode($value);
    if (!$data) {
        if ($debug) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, \'Unable to decode JSON in snippet property\', \'\', \'Image+\');
            return \'Unable to decode JSON in snippet property\';
        }
    }
    // No TV is used
    $tv = null;
    $tvOutputProperties = array();
} else {
    // Value is retreived from template variable
    /** @var modTemplateVar $tv */
    $tv = $modx->getObject(\'modTemplateVar\', array(\'name\' => $tvname));
    if ($tv) {
        // Get the raw content of the TV
        $value = $tv->getValue($docid);
        $value = $tv->processBindings($value, $docid);
        $tvOutputProperties = $tv->get(\'output_properties\');
        foreach ($tvOutputProperties as &$tvOutputProperty) {
            switch ($tvOutputProperty) {
                case \'true\' :
                    $tvOutputProperty = true;
                    break;
                case \'false\' :
                    $tvOutputProperty = false;
                    break;
            }
        }
    } else {
        if ($debug) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, "Template Variable \'{$tvname}\' not found.", \'\', \'Image+\');
            return "Template Variable \'{$tvname}\' not found.";
        }
        $tvOutputProperties = array();
    }
}

$output = \'\';
// Render output
switch ($type) {
    case \'check\':
        $data = json_decode($value);
        $output = ($data && $data->sourceImg->src) ? \'image\' : \'noimage\';
        break;
    case \'tpl\':
        $data = json_decode($value);
        $output = ($value) ? $imageplus->getImageURL($value, array_merge($tvOutputProperties, $scriptProperties, array(
            \'docid\' => $docid,
            \'phpThumbParams\' => $options,
            \'outputChunk\' => $tpl,
            \'caption\' => ($data && $data->caption) ? $data->caption : \'\',
            \'credits\' => ($data && $data->credits) ? $data->credits : \'\'
        )), $tv) : \'\';
        break;
    case \'thumb\':
    default:
        $output = ($value) ? $imageplus->getImageURL($value, array_merge($tvOutputProperties, $scriptProperties, array(
            \'docid\' => $docid,
            \'phpThumbParams\' => $options
        )), $tv) : \'\';
        break;
}
return $output;',
    ),
  ),
  '26a82906db1d5de105c6369948d074f3' => 
  array (
    'criteria' => 
    array (
      'name' => 'ImagePlus',
    ),
    'object' => 
    array (
      'id' => 26,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ImagePlus',
      'description' => 'Image+ runtime hooks - registers custom TV input & output types and includes javascripts on document edit pages.',
      'editor_type' => 0,
      'category' => 28,
      'cache_type' => 0,
      'plugincode' => '/**
 * Image+ runtime hooks
 * Registers custom TV input & output types and includes javascripts on document
 * edit pages so that the TV can be used from within other extras (i.e. MIGX,
 * Collections)
 *
 * Copyright 2013-2015 by Alan Pich <alan.pich@gmail.com>
 * Copyright 2015-2017 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package imageplus
 * @subpackage plugin
 *
 * @author Alan Pich <alan.pich@gmail.com>
 * @author Thomas Jakobi <thomas.jakobi@partout.info>
 * @copyright Alan Pich 2013-2015
 * @copyright Thomas Jakobi 2015-2017
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVOutputRenderList
 * @event OnTVInputPropertiesList
 * @event OnTVOutputRenderPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 */

$eventName = $modx->event->name;

$corePath = $modx->getOption(\'imageplus.core_path\', null, $modx->getOption(\'core_path\') . \'components/imageplus/\');
$imageplus = $modx->getService(\'imageplus\', \'ImagePlus\', $corePath . \'model/imageplus/\', array(
    \'core_path\' => $corePath
));

switch ($eventName) {
    case \'OnManagerPageBeforeRender\':
        $modx->controller->addLexiconTopic(\'imageplus:default\');
        $imageplus->includeScriptAssets();
        break;
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath . \'elements/tv/input/\');
        break;
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath . \'elements/tv/output/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/input/options/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/output/options/\');
        break;
    case \'OnDocFormRender\':
        $imageplus->includeScriptAssets();
        break;
};',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Image+ runtime hooks
 * Registers custom TV input & output types and includes javascripts on document
 * edit pages so that the TV can be used from within other extras (i.e. MIGX,
 * Collections)
 *
 * Copyright 2013-2015 by Alan Pich <alan.pich@gmail.com>
 * Copyright 2015-2017 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package imageplus
 * @subpackage plugin
 *
 * @author Alan Pich <alan.pich@gmail.com>
 * @author Thomas Jakobi <thomas.jakobi@partout.info>
 * @copyright Alan Pich 2013-2015
 * @copyright Thomas Jakobi 2015-2017
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVOutputRenderList
 * @event OnTVInputPropertiesList
 * @event OnTVOutputRenderPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 */

$eventName = $modx->event->name;

$corePath = $modx->getOption(\'imageplus.core_path\', null, $modx->getOption(\'core_path\') . \'components/imageplus/\');
$imageplus = $modx->getService(\'imageplus\', \'ImagePlus\', $corePath . \'model/imageplus/\', array(
    \'core_path\' => $corePath
));

switch ($eventName) {
    case \'OnManagerPageBeforeRender\':
        $modx->controller->addLexiconTopic(\'imageplus:default\');
        $imageplus->includeScriptAssets();
        break;
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath . \'elements/tv/input/\');
        break;
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath . \'elements/tv/output/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/input/options/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/output/options/\');
        break;
    case \'OnDocFormRender\':
        $imageplus->includeScriptAssets();
        break;
};',
    ),
  ),
  '58467696f218c29ac5d8e42ba2afad39' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 26,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 26,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'fa02a18895a061b1cfe30adff6c30882' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'd2cf387b2dfa663f9999f567975076c8' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '428cd74ccf7caa84001da6c94da9055b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVOutputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVOutputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'e6883141d68b8e0c47a66b453b4e36d2' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVOutputRenderPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 26,
      'event' => 'OnTVOutputRenderPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'a57555a9e4b8b7630582eb71451976d2' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 26,
      'event' => 'OnDocFormRender',
    ),
    'object' => 
    array (
      'pluginid' => 26,
      'event' => 'OnDocFormRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);