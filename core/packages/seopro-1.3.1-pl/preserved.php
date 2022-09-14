<?php return array (
  'c1a0b460b3e0dd91794e1d91fe702770' => 
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
  '59945d8d8441d2c3e239c551160d54c5' => 
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
  'a62ccdcf5a3a02b619c967ef1a0e5dc9' => 
  array (
    'criteria' => 
    array (
      'key' => 'seopro.fields',
    ),
    'object' => 
    array (
      'key' => 'seopro.fields',
      'value' => 'pagetitle:90,longtitle:90,description:300,alias:2023,menutitle:2023',
      'xtype' => 'textfield',
      'namespace' => 'seopro',
      'area' => 'general',
      'editedon' => '2019-02-06 20:25:05',
    ),
  ),
  '7644c8e74bd5b0c32b9a007e4fd2cf9e' => 
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
  'bf750cedc6a94dc59823910629ec73b9' => 
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
  'f08ea1e12d638185bdd3aabf3733eb1b' => 
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
  '6027c4851722375e488ef8d75a30399e' => 
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
  '5035298d5bcae5ef1a69a6b14db84563' => 
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
  '71cc7ebc4ef61eee7e3cbd0c754ad7f3' => 
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
  '948f15c9a323e68fb9207ad3a3c5292c' => 
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
  '72b7e474f48a3d253297b9ae1befbfec' => 
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
  '953fda60b234315300df5ae6bb27c447' => 
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
  'b08823ec8f864f7bf106b50012406ec8' => 
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
    case \'OnMODXInit\':
        $version = $modx->getVersionData();
        $version = (int)($version[\'version\'] . $version[\'major_version\']);
        if ($version < 27) {
            $modx->loadClass(\'modResource\');
            $modx->map[\'modResource\'][\'fieldMeta\'][\'description\'] = array(
                \'dbtype\' => \'text\',
                \'phptype\' => \'string\',
                \'index\' => \'fulltext\',
                \'indexgrp\' => \'content_ft_idx\',
            );
        }
        break;

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
        $strFields = $modx->getOption(\'seopro.fields\', null, \'pagetitle:70,longtitle:70,description:320,alias:2023,menutitle:2023\');
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
        });</script>\');

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
    case \'OnMODXInit\':
        $version = $modx->getVersionData();
        $version = (int)($version[\'version\'] . $version[\'major_version\']);
        if ($version < 27) {
            $modx->loadClass(\'modResource\');
            $modx->map[\'modResource\'][\'fieldMeta\'][\'description\'] = array(
                \'dbtype\' => \'text\',
                \'phptype\' => \'string\',
                \'index\' => \'fulltext\',
                \'indexgrp\' => \'content_ft_idx\',
            );
        }
        break;

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
        $strFields = $modx->getOption(\'seopro.fields\', null, \'pagetitle:70,longtitle:70,description:320,alias:2023,menutitle:2023\');
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
        });</script>\');

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
  'f760c94dd04702b9ebf8d344e3e0b350' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 18,
      'event' => 'OnMODXInit',
    ),
    'object' => 
    array (
      'pluginid' => 18,
      'event' => 'OnMODXInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'a839131d8a68d90eceab16c1699f338b' => 
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
  '8e7d5e2ac5360257a457a451f354855f' => 
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
  '8c5d7a03bbccfc37ca2e4ecbcf9eae22' => 
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
  'd9d8bb2b506054cd668f57fa1e794391' => 
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