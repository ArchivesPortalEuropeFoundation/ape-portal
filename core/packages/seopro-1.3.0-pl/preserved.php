<?php return array (
  '05503c3e06c2c32f286b17e615d18a7c' => 
  array (
    'criteria' => 
    array (
      'name' => 'seopro',
    ),
    'object' => 
    array (
      'name' => 'seopro',
      'path' => '{core_path}components/seopro/',
      'assets_path' => '{assets_path}components/seopro/',
    ),
  ),
  '2c0551ab870f76f8053041bb53316293' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.delimiter',
    ),
    'object' => 
    array (
      'key' => 'seopro.delimiter',
      'value' => '|',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '6959aea3e3cb8994ae5f618ce7bb52b6' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.fields',
    ),
    'object' => 
    array (
      'key' => 'seopro.fields',
      'value' => 'pagetitle:70,longtitle:70,description:155,alias:2023,menutitle:2023',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '9adc2c8c98e6b7f157366b1744936a36' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.usesitename',
    ),
    'object' => 
    array (
      'key' => 'seopro.usesitename',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '4c9f093b9432f69a3767391a9f3318e3' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.title_format',
    ),
    'object' => 
    array (
      'key' => 'seopro.title_format',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '039d0a33ea1ead14b1ff7eb4ce2e9503' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.disabledtemplates',
    ),
    'object' => 
    array (
      'key' => 'seopro.disabledtemplates',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  'e7a69cd80b2ca800f7431ff4193fe4dd' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.max_keywords_title',
    ),
    'object' => 
    array (
      'key' => 'seopro.max_keywords_title',
      'value' => '4',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '2052b83f9afb2beb7385469f7e8c1cf6' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.max_keywords_description',
    ),
    'object' => 
    array (
      'key' => 'seopro.max_keywords_description',
      'value' => '8',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '94d5f213ed39dd46b4b307017d879a9c' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.searchengine',
    ),
    'object' => 
    array (
      'key' => 'seopro.searchengine',
      'value' => 'google',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '298040724b30099176d447540f08c8ff' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.user_name',
    ),
    'object' => 
    array (
      'key' => 'seopro.user_name',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '85860eccb170cd57b1589715ac911423' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.user_email',
    ),
    'object' => 
    array (
      'key' => 'seopro.user_email',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => NULL,
    ),
  ),
  '7a9daa308e55eca2aa261f71d93c7508' => 
  array (
    'criteria' => 
    array (
      'category' => 'seoPro',
    ),
    'object' => 
    array (
      'id' => 32,
      'parent' => 0,
      'category' => 'seoPro',
      'rank' => 0,
    ),
  ),
  '6467ed1cddf854f73c71524689687311' => 
  array (
    'criteria' => 
    array (
      'name' => 'seoPro',
    ),
    'object' => 
    array (
      'id' => 18,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'seoPro',
      'description' => 'SEO optimizing plugin for MODx Revolution.',
      'editor_type' => 0,
      'category' => 32,
      'cache_type' => 0,
      'plugincode' => '/**
 * The base seoPro snippet.
 *
 * @package seopro
 */
$seoPro = $modx->getService(\'seopro\', \'seoPro\', $modx->getOption(\'seopro.core_path\', null, $modx->getOption(\'core_path\') . \'components/seopro/\') . \'model/seopro/\', $scriptProperties);
if (!($seoPro instanceof seoPro)) {
    return \'\';
}

$disabledTemplates = explode(\',\', $modx->getOption(\'seopro.disabledtemplates\', null, \'0\'));

switch ($modx->event->name) {
    case \'OnDocFormRender\':
        $template = (string)$resource->get(\'template\');
        $override = false;
        if (isset($_REQUEST[\'template\'])) {
            $template = (string)$_REQUEST[\'template\'];
            $override = true;
        }
        if (($override && $template === \'0\') || (!empty($template) && in_array($template, $disabledTemplates))) {
            break;
        }
        
        
        $currClassKey = $resource->get(\'class_key\');
        $strFields = $modx->getOption(\'seopro.fields\', null, \'pagetitle:70,longtitle:70,description:155,alias:2023,menutitle:2023\');
        $arrFields = array();
        if (is_array(explode(\',\', $strFields))) {
            foreach (explode(\',\', $strFields) as $field) {
                list($fieldName, $fieldCount) = explode(\':\', $field);
                $arrFields[$fieldName] = $fieldCount;
            }
        } else {
            return \'\';
        }

        $keywords = \'\';
        $modx->controller->addLexiconTopic(\'seopro:default\');
        $ctxKey = !empty($resource) ? $resource->get(\'context_key\') : $modx->getOption(\'default_context\');
        $ctx = $modx->getContext($ctxKey);
        if ($ctx) {
            $url = $ctx->getOption(\'site_url\', \'\', $modx->getOption(\'site_url\'));
        } else {
            $url = $modx->getOption(\'site_url\');
        }
        if ($mode == \'upd\') {
            if ($ctx) {
                if ($resource->get(\'id\') != $ctx->getOption(\'site_start\', \'\', $modx->getOption(\'site_start\'))) {
                    $url .= $resource->get(\'uri\');
                }
            } else {
                $url = $modx->makeUrl($resource->get(\'id\'), \'\', \'\', \'full\');
            }
            $url = str_replace(
                $resource->get(\'alias\'),
                \'<span id=\\"seopro-replace-alias\\">\' . $resource->get(\'alias\') . \'</span>\',
                $url
            );
            $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
            if ($seoKeywords) {
                $keywords = $seoKeywords->get(\'keywords\');
            }
        }

        if ($_REQUEST[\'id\'] == $modx->getOption(\'site_start\')) {
            unset($arrFields[\'alias\']);
            unset($arrFields[\'menutitle\']);
        }


        $config = $seoPro->config;
        unset($config[\'resource\']);
        $modx->regClientStartupHTMLBlock(\'<script type="text/javascript">
        Ext.onReady(function() {
            seoPro.config = \' . $modx->toJSON($config) . \';
            seoPro.config.record = "\' . $keywords . \'";
            seoPro.config.values = {};
            seoPro.config.fields = "\' . implode(",", array_keys($arrFields)) . \'";
            seoPro.config.chars = \' . $modx->toJSON($arrFields) . \'
            seoPro.config.url = "\' . $url . \'";
        });
    </script>\');

        /* include CSS and JS*/
        $version = $modx->getVersionData();
        if($version[\'version\'] == 2 && $version[\'major_version\'] == 2){
            $modx->regClientCSS($seoPro->config[\'assetsUrl\'] . \'css/mgr.css\');
        }else{
            $modx->regClientCSS($seoPro->config[\'assetsUrl\'] . \'css/mgr23.css\');
        }
        $modx->regClientStartupScript($seoPro->config[\'assetsUrl\'] . \'js/mgr/seopro.js??v=\' . $modx->getOption(\'seopro.version\', null, \'v1.0.0\'));
        $modx->regClientStartupScript($seoPro->config[\'assetsUrl\'] . \'js/mgr/resource.js?v=\' . $modx->getOption(\'seopro.version\', null, \'v1.0.0\'));

        break;

    case \'OnDocFormSave\':
        $template = (string)$resource->get(\'template\');
        $override = false;
        if (isset($_REQUEST[\'template\'])) {
            $template = (string)$_REQUEST[\'template\'];
            $override = true;
        }
        if (($override && $template === \'0\') || (!empty($template) && in_array($template, $disabledTemplates))) {
            break;
        }
        $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        if (!$seoKeywords && isset($resource)) {
            $seoKeywords = $modx->newObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        }
        if($seoKeywords){
            if (isset($_POST[\'keywords\'])){
                $seoKeywords->set(\'keywords\', trim($_POST[\'keywords\'], \',\'));
            } else {
                $seoKeywords->set(\'keywords\', \'\');
            }
            $seoKeywords->save();
        }
        break;

    case \'onResourceDuplicate\':
        $template = (string)$resource->get(\'template\');
        $override = false;
        if (isset($_REQUEST[\'template\'])) {
            $template = (string)$_REQUEST[\'template\'];
            $override = true;
        }
        if (($override && $template === \'0\') || (!empty($template) && in_array($template, $disabledTemplates))) {
            break;
        }

        $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        if (!$seoKeywords) {
            $seoKeywords = $modx->newObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        }
        $newSeoKeywords = $modx->newObject(\'seoKeywords\');
        $newSeoKeywords->fromArray($seoKeywords->toArray());
        $newSeoKeywords->set(\'resource\', $newResource->get(\'id\'));
        $newSeoKeywords->save();
        break;

    case \'OnLoadWebDocument\':
        if ($modx->context->get(\'key\') == "mgr") {
            break;
        }
        $template = ($modx->resource->get(\'template\')) ? (string)$modx->resource->get(\'template\') : \'\';
        if (in_array($template, $disabledTemplates)) {
            break;
        }
        $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $modx->resource->get(\'id\')));
        if ($seoKeywords) {
            $keyWords = $seoKeywords->get(\'keywords\');
            $modx->setPlaceholder(\'seoPro.keywords\', $keyWords);
        }
        // Render the meta title, based on system settings
        $titleFormat = $modx->getOption(\'seopro.title_format\');
        if (empty($titleFormat)) {
            $siteDelimiter = $modx->getOption(\'seopro.delimiter\', null, \'/\');
            $siteUseSitename = (boolean)$modx->getOption(\'seopro.usesitename\', null, true);
            $siteID = $modx->resource->get(\'id\');
            $siteName = $modx->getOption(\'site_name\');
            $longtitle = $modx->resource->get(\'longtitle\');
            $pagetitle = $modx->resource->get(\'pagetitle\');
            $seoProTitle = array();
            if ($siteID == $modx->getOption(\'site_start\')) {
                $seoProTitle[\'pagetitle\'] = !empty($longtitle) ? $longtitle : $siteName;
            } else {
                $seoProTitle[\'pagetitle\'] = !empty($longtitle) ? $longtitle : $pagetitle;
                if ($siteUseSitename) {
                    $seoProTitle[\'delimiter\'] = $siteDelimiter;
                    $seoProTitle[\'sitename\'] = $siteName;
                }
            }
            $title = implode(\' \', $seoProTitle);
        } else {
            $title = $modx->getOption(\'seopro.title_format\');
        }
        $modx->setPlaceholder(\'seoPro.title\', $title);
        break;
}',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * The base seoPro snippet.
 *
 * @package seopro
 */
$seoPro = $modx->getService(\'seopro\', \'seoPro\', $modx->getOption(\'seopro.core_path\', null, $modx->getOption(\'core_path\') . \'components/seopro/\') . \'model/seopro/\', $scriptProperties);
if (!($seoPro instanceof seoPro)) {
    return \'\';
}

$disabledTemplates = explode(\',\', $modx->getOption(\'seopro.disabledtemplates\', null, \'0\'));

switch ($modx->event->name) {
    case \'OnDocFormRender\':
        $template = (string)$resource->get(\'template\');
        $override = false;
        if (isset($_REQUEST[\'template\'])) {
            $template = (string)$_REQUEST[\'template\'];
            $override = true;
        }
        if (($override && $template === \'0\') || (!empty($template) && in_array($template, $disabledTemplates))) {
            break;
        }
        
        
        $currClassKey = $resource->get(\'class_key\');
        $strFields = $modx->getOption(\'seopro.fields\', null, \'pagetitle:70,longtitle:70,description:155,alias:2023,menutitle:2023\');
        $arrFields = array();
        if (is_array(explode(\',\', $strFields))) {
            foreach (explode(\',\', $strFields) as $field) {
                list($fieldName, $fieldCount) = explode(\':\', $field);
                $arrFields[$fieldName] = $fieldCount;
            }
        } else {
            return \'\';
        }

        $keywords = \'\';
        $modx->controller->addLexiconTopic(\'seopro:default\');
        $ctxKey = !empty($resource) ? $resource->get(\'context_key\') : $modx->getOption(\'default_context\');
        $ctx = $modx->getContext($ctxKey);
        if ($ctx) {
            $url = $ctx->getOption(\'site_url\', \'\', $modx->getOption(\'site_url\'));
        } else {
            $url = $modx->getOption(\'site_url\');
        }
        if ($mode == \'upd\') {
            if ($ctx) {
                if ($resource->get(\'id\') != $ctx->getOption(\'site_start\', \'\', $modx->getOption(\'site_start\'))) {
                    $url .= $resource->get(\'uri\');
                }
            } else {
                $url = $modx->makeUrl($resource->get(\'id\'), \'\', \'\', \'full\');
            }
            $url = str_replace(
                $resource->get(\'alias\'),
                \'<span id=\\"seopro-replace-alias\\">\' . $resource->get(\'alias\') . \'</span>\',
                $url
            );
            $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
            if ($seoKeywords) {
                $keywords = $seoKeywords->get(\'keywords\');
            }
        }

        if ($_REQUEST[\'id\'] == $modx->getOption(\'site_start\')) {
            unset($arrFields[\'alias\']);
            unset($arrFields[\'menutitle\']);
        }


        $config = $seoPro->config;
        unset($config[\'resource\']);
        $modx->regClientStartupHTMLBlock(\'<script type="text/javascript">
        Ext.onReady(function() {
            seoPro.config = \' . $modx->toJSON($config) . \';
            seoPro.config.record = "\' . $keywords . \'";
            seoPro.config.values = {};
            seoPro.config.fields = "\' . implode(",", array_keys($arrFields)) . \'";
            seoPro.config.chars = \' . $modx->toJSON($arrFields) . \'
            seoPro.config.url = "\' . $url . \'";
        });
    </script>\');

        /* include CSS and JS*/
        $version = $modx->getVersionData();
        if($version[\'version\'] == 2 && $version[\'major_version\'] == 2){
            $modx->regClientCSS($seoPro->config[\'assetsUrl\'] . \'css/mgr.css\');
        }else{
            $modx->regClientCSS($seoPro->config[\'assetsUrl\'] . \'css/mgr23.css\');
        }
        $modx->regClientStartupScript($seoPro->config[\'assetsUrl\'] . \'js/mgr/seopro.js??v=\' . $modx->getOption(\'seopro.version\', null, \'v1.0.0\'));
        $modx->regClientStartupScript($seoPro->config[\'assetsUrl\'] . \'js/mgr/resource.js?v=\' . $modx->getOption(\'seopro.version\', null, \'v1.0.0\'));

        break;

    case \'OnDocFormSave\':
        $template = (string)$resource->get(\'template\');
        $override = false;
        if (isset($_REQUEST[\'template\'])) {
            $template = (string)$_REQUEST[\'template\'];
            $override = true;
        }
        if (($override && $template === \'0\') || (!empty($template) && in_array($template, $disabledTemplates))) {
            break;
        }
        $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        if (!$seoKeywords && isset($resource)) {
            $seoKeywords = $modx->newObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        }
        if($seoKeywords){
            if (isset($_POST[\'keywords\'])){
                $seoKeywords->set(\'keywords\', trim($_POST[\'keywords\'], \',\'));
            } else {
                $seoKeywords->set(\'keywords\', \'\');
            }
            $seoKeywords->save();
        }
        break;

    case \'onResourceDuplicate\':
        $template = (string)$resource->get(\'template\');
        $override = false;
        if (isset($_REQUEST[\'template\'])) {
            $template = (string)$_REQUEST[\'template\'];
            $override = true;
        }
        if (($override && $template === \'0\') || (!empty($template) && in_array($template, $disabledTemplates))) {
            break;
        }

        $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        if (!$seoKeywords) {
            $seoKeywords = $modx->newObject(\'seoKeywords\', array(\'resource\' => $resource->get(\'id\')));
        }
        $newSeoKeywords = $modx->newObject(\'seoKeywords\');
        $newSeoKeywords->fromArray($seoKeywords->toArray());
        $newSeoKeywords->set(\'resource\', $newResource->get(\'id\'));
        $newSeoKeywords->save();
        break;

    case \'OnLoadWebDocument\':
        if ($modx->context->get(\'key\') == "mgr") {
            break;
        }
        $template = ($modx->resource->get(\'template\')) ? (string)$modx->resource->get(\'template\') : \'\';
        if (in_array($template, $disabledTemplates)) {
            break;
        }
        $seoKeywords = $modx->getObject(\'seoKeywords\', array(\'resource\' => $modx->resource->get(\'id\')));
        if ($seoKeywords) {
            $keyWords = $seoKeywords->get(\'keywords\');
            $modx->setPlaceholder(\'seoPro.keywords\', $keyWords);
        }
        // Render the meta title, based on system settings
        $titleFormat = $modx->getOption(\'seopro.title_format\');
        if (empty($titleFormat)) {
            $siteDelimiter = $modx->getOption(\'seopro.delimiter\', null, \'/\');
            $siteUseSitename = (boolean)$modx->getOption(\'seopro.usesitename\', null, true);
            $siteID = $modx->resource->get(\'id\');
            $siteName = $modx->getOption(\'site_name\');
            $longtitle = $modx->resource->get(\'longtitle\');
            $pagetitle = $modx->resource->get(\'pagetitle\');
            $seoProTitle = array();
            if ($siteID == $modx->getOption(\'site_start\')) {
                $seoProTitle[\'pagetitle\'] = !empty($longtitle) ? $longtitle : $siteName;
            } else {
                $seoProTitle[\'pagetitle\'] = !empty($longtitle) ? $longtitle : $pagetitle;
                if ($siteUseSitename) {
                    $seoProTitle[\'delimiter\'] = $siteDelimiter;
                    $seoProTitle[\'sitename\'] = $siteName;
                }
            }
            $title = implode(\' \', $seoProTitle);
        } else {
            $title = $modx->getOption(\'seopro.title_format\');
        }
        $modx->setPlaceholder(\'seoPro.title\', $title);
        break;
}',
    ),
  ),
  'bca63b9e5aa81845f9bb6a2fb024821b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 18,
      'event' => 'OnDocFormRender',
    ),
    'object' => 
    array (
      'pluginid' => 18,
      'event' => 'OnDocFormRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '2fb6b17a4de9e077a6280c2421f9ee04' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 18,
      'event' => 'OnDocFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 18,
      'event' => 'OnDocFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'c99ad4631dd72b20a6f21cf582409337' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 18,
      'event' => 'OnResourceDuplicate',
    ),
    'object' => 
    array (
      'pluginid' => 18,
      'event' => 'OnResourceDuplicate',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'fa1699d9b8485994a1cc742098c34ec5' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 18,
      'event' => 'OnLoadWebDocument',
    ),
    'object' => 
    array (
      'pluginid' => 18,
      'event' => 'OnLoadWebDocument',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);