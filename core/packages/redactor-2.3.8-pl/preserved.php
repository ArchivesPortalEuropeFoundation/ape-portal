<?php return array (
  'b52dbffa8e904daeb063dde056da208b' => 
  array (
    'criteria' => 
    array (
      'name' => 'redactor',
    ),
    'object' => 
    array (
      'name' => 'redactor',
      'path' => '{core_path}components/redactor/',
      'assets_path' => '',
    ),
  ),
  '2a3016885e8409785aeac48ca12dea50' => 
  array (
    'criteria' => 
    array (
      'name' => 'Redactor',
    ),
    'object' => 
    array (
      'id' => 7,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Redactor',
      'description' => 'Redactor WYSIWYG editor plugin for MODX Revolution',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * Redactor WYSIWYG Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnRichTextBrowserInit, OnDocFormPrerender
 *
 * @author JP DeVries <mail@devries.jp>
 *
 * @package redactor
 */

$corePath = $modx->getOption(\'redactor.core_path\', null, $modx->getOption(\'core_path\').\'components/redactor/\');

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tvs/input/\');
        break;

    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tvs/inputoptions/\'); 
        break;

    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tvs/properties/\');
        break;

    case \'OnManagerPageBeforeRender\':
        break;

    case \'OnRichTextEditorRegister\':
        $modx->event->output(\'Redactor\');
        break;

    case \'OnFileManagerFileRename\':
        /**
         * @var string $path
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }
        $redactor->renames[] = $path;

        break;

    case \'OnRichTextEditorInit\':
        /**
         * @var string $editor
         * @var array $elements
         *
         * Only load up the editor if the editor is Redactor, and use_editor is enabled.
         */
        $rte = isset($editor) ? $editor : $modx->getOption(\'which_editor\', null, \'\');
        if ($rte !== \'Redactor\' || !$modx->getOption(\'use_editor\', null, true)) {
            return;
        }

        /**
         * Attempt to load the Redactor service class. Log error and halt processing if it fails.
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }

        if (isset($resource) && $resource instanceof modResource) {
            $redactor->setResource($resource);
        }
        elseif ($modx->resource) {
            $redactor->setResource($modx->resource);
        }
        elseif ($modx->controller && isset($modx->controller->resource) && $modx->controller->resource instanceof modResource) {
            $redactor->setResource($modx->controller->resource);
        }

        $customCss = $redactor->getOption(\'redactor.css\');

        if ($modx->controller && !($modx->controller instanceof modManagerControllerDeprecated)) {
            $modx->controller->addLexiconTopic(\'redactor:default\');
            $modx->controller->addCss($redactor->config[\'assetsUrl\'].\'redactor-2.3.4.min.css\');
            if ($redactor->degradeUI) $modx->controller->addCss($redactor->config[\'assetsUrl\'].\'buttons-legacy.min.css\');
            if ($redactor->rebeccaDay) $modx->controller->addCss($redactor->config[\'assetsUrl\'].\'rebecca.min.css\');
            if ($customCss) $modx->controller->addCss($customCss);
        }
        else {
            $modx->lexicon->load(\'redactor:default\');
            $modx->regClientCSS($redactor->config[\'assetsUrl\'].\'redactor-2.3.4.min.css\');
            if($redactor->degradeUI) $modx->regClientCSS($redactor->config[\'assetsUrl\'].\'buttons-legacy.min.css\');
            if($redactor->rebeccaDay) $modx->regClientCSS($redactor->config[\'assetsUrl\'].\'rebecca.min.css\');
            if($customCss) $modx->regClientCSS($customCss);
        }

        $html = $redactor->getHtml();
        $modx->event->output($html);
        break;
}

return;',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Redactor WYSIWYG Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnRichTextBrowserInit, OnDocFormPrerender
 *
 * @author JP DeVries <mail@devries.jp>
 *
 * @package redactor
 */

$corePath = $modx->getOption(\'redactor.core_path\', null, $modx->getOption(\'core_path\').\'components/redactor/\');

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tvs/input/\');
        break;

    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tvs/inputoptions/\'); 
        break;

    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tvs/properties/\');
        break;

    case \'OnManagerPageBeforeRender\':
        break;

    case \'OnRichTextEditorRegister\':
        $modx->event->output(\'Redactor\');
        break;

    case \'OnFileManagerFileRename\':
        /**
         * @var string $path
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }
        $redactor->renames[] = $path;

        break;

    case \'OnRichTextEditorInit\':
        /**
         * @var string $editor
         * @var array $elements
         *
         * Only load up the editor if the editor is Redactor, and use_editor is enabled.
         */
        $rte = isset($editor) ? $editor : $modx->getOption(\'which_editor\', null, \'\');
        if ($rte !== \'Redactor\' || !$modx->getOption(\'use_editor\', null, true)) {
            return;
        }

        /**
         * Attempt to load the Redactor service class. Log error and halt processing if it fails.
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }

        if (isset($resource) && $resource instanceof modResource) {
            $redactor->setResource($resource);
        }
        elseif ($modx->resource) {
            $redactor->setResource($modx->resource);
        }
        elseif ($modx->controller && isset($modx->controller->resource) && $modx->controller->resource instanceof modResource) {
            $redactor->setResource($modx->controller->resource);
        }

        $customCss = $redactor->getOption(\'redactor.css\');

        if ($modx->controller && !($modx->controller instanceof modManagerControllerDeprecated)) {
            $modx->controller->addLexiconTopic(\'redactor:default\');
            $modx->controller->addCss($redactor->config[\'assetsUrl\'].\'redactor-2.3.4.min.css\');
            if ($redactor->degradeUI) $modx->controller->addCss($redactor->config[\'assetsUrl\'].\'buttons-legacy.min.css\');
            if ($redactor->rebeccaDay) $modx->controller->addCss($redactor->config[\'assetsUrl\'].\'rebecca.min.css\');
            if ($customCss) $modx->controller->addCss($customCss);
        }
        else {
            $modx->lexicon->load(\'redactor:default\');
            $modx->regClientCSS($redactor->config[\'assetsUrl\'].\'redactor-2.3.4.min.css\');
            if($redactor->degradeUI) $modx->regClientCSS($redactor->config[\'assetsUrl\'].\'buttons-legacy.min.css\');
            if($redactor->rebeccaDay) $modx->regClientCSS($redactor->config[\'assetsUrl\'].\'rebecca.min.css\');
            if($customCss) $modx->regClientCSS($customCss);
        }

        $html = $redactor->getHtml();
        $modx->event->output($html);
        break;
}

return;',
    ),
  ),
  '7e03d7e359a5b69fe552c50f59967599' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnRichTextBrowserInit',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnRichTextBrowserInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '0cc03cd8172b012abfe0a3b8cb7c0d5a' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'b1881033b06f12880ed2c58dca6b608d' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '2fee763b0552ac4f465556898c2a72ea' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnRichTextEditorRegister',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnRichTextEditorRegister',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'fbb0565d7030e0ee51d67f2723de1d7e' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '62f353faffc5beb84c7995848afb61d3' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVOutputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVOutputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'aec84df36b6c6fda22926cf000e136f7' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '5dd051e78a005f4638e4d5ea54c6aadd' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVOutputRenderPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnTVOutputRenderPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '9172dc2019213145b1932ecbac8a4fac' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnRichTextEditorInit',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'onRichTextEditorInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'a0d528fff8c2688f863b5cb421849aed' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnFileManagerFileRename',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnFileManagerFileRename',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'cbc43ca132d419312f545e71f7b143e2' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.lang',
    ),
    'object' => 
    array (
      'key' => 'redactor.lang',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Internationalisation',
      'editedon' => NULL,
    ),
  ),
  'fc34ed5208af03f2a57bf17cb00706e4' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.direction',
    ),
    'object' => 
    array (
      'key' => 'redactor.direction',
      'value' => 'ltr',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Internationalisation',
      'editedon' => NULL,
    ),
  ),
  '795c229681ba2a22b8839d99cdb8af60' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.buttons',
    ),
    'object' => 
    array (
      'key' => 'redactor.buttons',
      'value' => 'html,|,formatting,|,bold,italic,deleted,|,unorderedlist,orderedlist,outdent,indent,|,image,video,file,table,link,|,fontcolor,backcolor,|,alignment,|,horizontalrule,|',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  'd4d246654701acf3a888659aa004d99a' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.activeButtons',
    ),
    'object' => 
    array (
      'key' => 'redactor.activeButtons',
      'value' => 'deleted,italic,bold,underline,unorderedlist,orderedlist,alignleft,aligncenter,alignright,justify',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '5b089f12d52197bfd3d349877e5dc9e8' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.activeButtonsStates',
    ),
    'object' => 
    array (
      'key' => 'redactor.activeButtonsStates',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '041bfadd1a7cb3e232fd48e0f8d0bdcb' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.formattingTags',
    ),
    'object' => 
    array (
      'key' => 'redactor.formattingTags',
      'value' => 'p,blockquote,pre,h1,h2,h3,h4',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '25ca3c5cc8e2f68abce10b36b7f451b3' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.buttonSource',
    ),
    'object' => 
    array (
      'key' => 'redactor.buttonSource',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '827c5565bafed2bf44b9006173b28c58' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.buttonFullScreen',
    ),
    'object' => 
    array (
      'key' => 'redactor.buttonFullScreen',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '751d406c8d8db1cebfc1fb6ccfd9347d' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.css',
    ),
    'object' => 
    array (
      'key' => 'redactor.css',
      'value' => '/site/css/redactor.css',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  '32b84cc6b119c4e72e30795cc67ee16f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.shortcuts',
    ),
    'object' => 
    array (
      'key' => 'redactor.shortcuts',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'a82607be07edb5bbb788a0bb760ee49f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.cleanup',
    ),
    'object' => 
    array (
      'key' => 'redactor.cleanup',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '06e3f43d73cbd389dc9ad522beffac8b' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.convertLinks',
    ),
    'object' => 
    array (
      'key' => 'redactor.convertLinks',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '4acadb9c78a98ed6c6dcda9f5426812c' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.tabindex',
    ),
    'object' => 
    array (
      'key' => 'redactor.tabindex',
      'value' => '0',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '0b2bc76afecffec0a9f4e8e991278105' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.minHeight',
    ),
    'object' => 
    array (
      'key' => 'redactor.minHeight',
      'value' => '200',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '979e754e57683b4f3ec5f51a5c30fb0f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.colors',
    ),
    'object' => 
    array (
      'key' => 'redactor.colors',
      'value' => '#ffffff,#000000,#eeece1,#1f497d,#4f81bd,#c0504d,#9bbb59,#8064a2,#4bacc6,#f79646,#ffff00,#f2f2f2,#7f7f7f,#ddd9c3,#c6d9f0,#dbe5f1,#f2dcdb,#ebf1dd,#e5e0ec,#dbeef3,#fdeada,#fff2ca,#d8d8d8,#595959,#c4bd97,#8db3e2,#b8cce4,#e5b9b7,#d7e3bc,#ccc1d9,#b7dde8,#fbd5b5,#ffe694,#bfbfbf,#3f3f3f,#938953,#548dd4,#95b3d7,#d99694,#c3d69b,#b2a2c7,#b7dde8,#fac08f,#f2c314,#a5a5a5,#262626,#494429,#17365d,#366092,#953734,#76923c,#5f497a,#92cddc,#e36c09,#c09100,#7f7f7f,#0c0c0c,#1d1b10,#0f243e,#244061,#632423,#4f6128,#3f3151,#31859b,#974806,#7f6000',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '629f8e82de3719661d1ec6ff05aea5f2' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.wym',
    ),
    'object' => 
    array (
      'key' => 'redactor.wym',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'd14d76bf358543393915efd8a1e15a6c' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkProtocol',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkProtocol',
      'value' => 'http://',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  '6bb00cb9bc5cf217597dc182d48b9e13' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.placeholder',
    ),
    'object' => 
    array (
      'key' => 'redactor.placeholder',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '6e295bfa89c15f7f7456a36759f7edd0' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linebreaks',
    ),
    'object' => 
    array (
      'key' => 'redactor.linebreaks',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '4c42170d3ee5e812945c6aaccdd4469d' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.allowedTags',
    ),
    'object' => 
    array (
      'key' => 'redactor.allowedTags',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '00e9db84aeb4df7a37019dfe05378946' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.deniedTags',
    ),
    'object' => 
    array (
      'key' => 'redactor.deniedTags',
      'value' => 'html,head,link,body,meta,script,style,applet',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  'b0eb50d31cbe8ccab5e425b90b6ebe14' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkEmail',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkEmail',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'ded39c2be8419809cb6b32b4b27c383c' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkAnchor',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkAnchor',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'ab52372f672168e2001c5d79e68cbe77' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.pastePlainText',
    ),
    'object' => 
    array (
      'key' => 'redactor.pastePlainText',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'b1932721c53ed78894982cc1cd86df97' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.paragraphize',
    ),
    'object' => 
    array (
      'key' => 'redactor.paragraphize',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '1840e0408a640d2c6d36c313114bc617' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.removeComments',
    ),
    'object' => 
    array (
      'key' => 'redactor.removeComments',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  'cef0cf5f4138d97fffc6c7e861629122' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.visual',
    ),
    'object' => 
    array (
      'key' => 'redactor.visual',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '8e1b36d144c565afe9b9c40a009dbbf0' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.marginFloatLeft',
    ),
    'object' => 
    array (
      'key' => 'redactor.marginFloatLeft',
      'value' => '0 10px 10px 0',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '27bcef9e20bb55efef3c635594b61b4d' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.marginFloatRight',
    ),
    'object' => 
    array (
      'key' => 'redactor.marginFloatRight',
      'value' => '0 0 10px 10px',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '3309bd5eedf38faef9488f5c95034448' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.mediasource',
    ),
    'object' => 
    array (
      'key' => 'redactor.mediasource',
      'value' => '2',
      'xtype' => 'modx-combo-source',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '067098c33287a5e68eb06a07ab2b9db0' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.file_mediasource',
    ),
    'object' => 
    array (
      'key' => 'redactor.file_mediasource',
      'value' => '',
      'xtype' => 'modx-combo-source',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '84dcb0a3d9666b25a8e3352311aeccdc' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.image_upload_path',
    ),
    'object' => 
    array (
      'key' => 'redactor.image_upload_path',
      'value' => 'images/[[+year]]/[[+month]]/',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '9653b41aa1c7a5c37b75b9ec3d239aab' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.image_browse_path',
    ),
    'object' => 
    array (
      'key' => 'redactor.image_browse_path',
      'value' => 'images/',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '6f29315d91eea5e29659012f577c6a2e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.file_upload_path',
    ),
    'object' => 
    array (
      'key' => 'redactor.file_upload_path',
      'value' => 'images/[[+year]]/[[+month]]/',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '58ea56f4dbb0db20fe7338786fcae897' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.file_browse_path',
    ),
    'object' => 
    array (
      'key' => 'redactor.file_browse_path',
      'value' => 'images/',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'eef9882c772243a8b9563c6f7875e1c8' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.browse_files',
    ),
    'object' => 
    array (
      'key' => 'redactor.browse_files',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '41ed36bf35bce2990f3554f3d5d85bf9' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.date_images',
    ),
    'object' => 
    array (
      'key' => 'redactor.date_images',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '53dc1671fbaf447d884805864288ba58' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.date_files',
    ),
    'object' => 
    array (
      'key' => 'redactor.date_files',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '8d623fa789e358ed33d889e91b3857d7' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.typeahead.include_introtext',
    ),
    'object' => 
    array (
      'key' => 'redactor.typeahead.include_introtext',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Resource Typeahead',
      'editedon' => NULL,
    ),
  ),
  '6266170640c28c6836cdd94a146d879e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.prefetch_ttl',
    ),
    'object' => 
    array (
      'key' => 'redactor.prefetch_ttl',
      'value' => '3600000',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Resource Typeahead',
      'editedon' => NULL,
    ),
  ),
  '2b17f65e59ef34df2a8fa59fb3f0f5d9' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkResource',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkResource',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '139811337332806f6ab2afcbda2551e2' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.cleanFileNames',
    ),
    'object' => 
    array (
      'key' => 'redactor.cleanFileNames',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  'e9ca317656af573804a2f8db4921e625' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.dynamicThumbs',
    ),
    'object' => 
    array (
      'key' => 'redactor.dynamicThumbs',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'ebf6a1f7c7b7ddae229b637e72bffe36' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.clipsJson',
    ),
    'object' => 
    array (
      'key' => 'redactor.clipsJson',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '558a77bae9113c0128c2d638bff666f3' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.additionalPlugins',
    ),
    'object' => 
    array (
      'key' => 'redactor.additionalPlugins',
      'value' => 'fontsize:../assets/components/redactor/lib/fontsize.js,fontcolor:../assets/components/redactor/lib/fontcolor.js,fontfamily:../assets/components/redactor/lib/fontfamily.js',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  'b8e7354a488e93c2c8fcab550d044b78' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.dragUpload',
    ),
    'object' => 
    array (
      'key' => 'redactor.dragUpload',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'f9c531cf5fc5182abf8c7c0d342bc1e7' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.convertImageLinks',
    ),
    'object' => 
    array (
      'key' => 'redactor.convertImageLinks',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '3ba4d5e4dbd05b26863498951c06077c' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.convertVideoLinks',
    ),
    'object' => 
    array (
      'key' => 'redactor.convertVideoLinks',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '44d77a31b75e07b62eba988fc8a05474' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.tabAsSpaces',
    ),
    'object' => 
    array (
      'key' => 'redactor.tabAsSpaces',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'c4c7fdb9114e3c348ca34d300c7a9cfc' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.removeEmptyTags',
    ),
    'object' => 
    array (
      'key' => 'redactor.removeEmptyTags',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '67b48122a463e787b75e8a111e654ba1' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.sanitizePattern',
    ),
    'object' => 
    array (
      'key' => 'redactor.sanitizePattern',
      'value' => '/([[:alnum:]_\\.-]*)/',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  'c7743c93841b67ffa7eb9ad0e7fcf5b8' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.sanitizeReplace',
    ),
    'object' => 
    array (
      'key' => 'redactor.sanitizeReplace',
      'value' => '_',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  '22953b1ebce7c64568862b1574fe242f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkSize',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkSize',
      'value' => '50',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '5596484396f2c5680a5d91bb04cd5664' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.advAttrib',
    ),
    'object' => 
    array (
      'key' => 'redactor.advAttrib',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => NULL,
    ),
  ),
  'dda6891339ac02f0877c5e3e2a8d6005' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkNofollow',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkNofollow',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '6d3cc36de6bdce2743fda16599369b40' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.typewriter',
    ),
    'object' => 
    array (
      'key' => 'redactor.typewriter',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'f138c2f0d55c9a5a132c8fb215a3eccb' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.buttonsHideOnMobile',
    ),
    'object' => 
    array (
      'key' => 'redactor.buttonsHideOnMobile',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  'f464393eac7c61e4ada31e5082ffaeca' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.toolbarOverflow',
    ),
    'object' => 
    array (
      'key' => 'redactor.toolbarOverflow',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  'c0a57b59a80bd80f77ac6fb81c85a754' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.cleanSpaces',
    ),
    'object' => 
    array (
      'key' => 'redactor.cleanSpaces',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  'd55595d7892355182af39768d4208783' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.predefinedLinks',
    ),
    'object' => 
    array (
      'key' => 'redactor.predefinedLinks',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '57ebc17926873fa2b515e96b69e5b36f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.shortcutsAdd',
    ),
    'object' => 
    array (
      'key' => 'redactor.shortcutsAdd',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '109812f25bed19ad29fe07f60b4ea409' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.commemorateRebecca',
    ),
    'object' => 
    array (
      'key' => 'redactor.commemorateRebecca',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  'f8709066326eeabb1b695bdddc0f01de' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.toolbarFixed',
    ),
    'object' => 
    array (
      'key' => 'redactor.toolbarFixed',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '1d414bb93dbdcea3efcc4963ef1cbbff' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.focus',
    ),
    'object' => 
    array (
      'key' => 'redactor.focus',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'b8a4b0311de38e3ef2e90b674d0730ef' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.focusEnd',
    ),
    'object' => 
    array (
      'key' => 'redactor.focusEnd',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'f3c420bd729018d10ae5ab3d32b95bed' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.scrollTarget',
    ),
    'object' => 
    array (
      'key' => 'redactor.scrollTarget',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '4644582e1f00caab91c03818d088aa09' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.enterKey',
    ),
    'object' => 
    array (
      'key' => 'redactor.enterKey',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'e492652b1a2b9ca0c1816538fbad84fc' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.cleanStyleOnEnter',
    ),
    'object' => 
    array (
      'key' => 'redactor.cleanStyleOnEnter',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '6369906f6050b226f67663f7d560c2f8' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.linkTooltip',
    ),
    'object' => 
    array (
      'key' => 'redactor.linkTooltip',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'a161eba86467472c19fc9cedfbddac57' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.imageEditable',
    ),
    'object' => 
    array (
      'key' => 'redactor.imageEditable',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '3d24e6e87f60b6c6ad578a680f29c1ef' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.imageResizable',
    ),
    'object' => 
    array (
      'key' => 'redactor.imageResizable',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'ee381e4608068be5b9eedc3ec412b209' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.imageLink',
    ),
    'object' => 
    array (
      'key' => 'redactor.imageLink',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '4e384044791cab1d2f2801e152af47c1' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.imagePosition',
    ),
    'object' => 
    array (
      'key' => 'redactor.imagePosition',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'b5de037bb1428eefa12607908624c36f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.buttonsHide',
    ),
    'object' => 
    array (
      'key' => 'redactor.buttonsHide',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Toolbar',
      'editedon' => NULL,
    ),
  ),
  '256ec9cad3fcbd9c38baeda4c20290a1' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.formattingAdd',
    ),
    'object' => 
    array (
      'key' => 'redactor.formattingAdd',
      'value' => '[]',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => '2017-07-07 12:39:35',
    ),
  ),
  '6d43f53a7855914f2705db5f70b8f1b7' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.tabifier',
    ),
    'object' => 
    array (
      'key' => 'redactor.tabifier',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  'f5474b70dd015c077ff79534e69060e3' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.replaceTags',
    ),
    'object' => 
    array (
      'key' => 'redactor.replaceTags',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  'b982b0f993771bc021bc88845d4bdc73' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.replaceStyles',
    ),
    'object' => 
    array (
      'key' => 'redactor.replaceStyles',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '3b338c00cb961af2de5ff98b7178797c' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.removeDataAttr',
    ),
    'object' => 
    array (
      'key' => 'redactor.removeDataAttr',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '969497d9e62cbec06d2e64099e6e39fb' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.removeAttr',
    ),
    'object' => 
    array (
      'key' => 'redactor.removeAttr',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  'f798c8181e9dcef8b872486aa01c69a0' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.allowedAttr',
    ),
    'object' => 
    array (
      'key' => 'redactor.allowedAttr',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  'f776b9005930ca9fcbfd6e5a5d0a5d4e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.dragImageUpload',
    ),
    'object' => 
    array (
      'key' => 'redactor.dragImageUpload',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'c2b13a4e26ec302bcacfe477893c24ff' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.dragFileUpload',
    ),
    'object' => 
    array (
      'key' => 'redactor.dragFileUpload',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '07d9d2811bc403564a35bbee3ec82263' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.replaceDivs',
    ),
    'object' => 
    array (
      'key' => 'redactor.replaceDivs',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'e8871bf72eb837b1d9e719e279f61575' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.preSpaces',
    ),
    'object' => 
    array (
      'key' => 'redactor.preSpaces',
      'value' => '4',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Markup',
      'editedon' => NULL,
    ),
  ),
  '71e279e5b57bfa372bbd21a8c412a60c' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.parse_parent_path',
    ),
    'object' => 
    array (
      'key' => 'redactor.parse_parent_path',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '81f177deb9f387c3877e8708067dc9dd' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.increment_file_names',
    ),
    'object' => 
    array (
      'key' => 'redactor.increment_file_names',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '76bf439ea514198ab9dcb03187abd2bd' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.parse_parent_path_height',
    ),
    'object' => 
    array (
      'key' => 'redactor.parse_parent_path_height',
      'value' => '10',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'ec12ae0248790a69a5696f7b8319f99b' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.baseurls_mode',
    ),
    'object' => 
    array (
      'key' => 'redactor.baseurls_mode',
      'value' => 'relative',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'f99e5e2e61520e21b5eed03a4efc86b6' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.showDimensionsOnResize',
    ),
    'object' => 
    array (
      'key' => 'redactor.showDimensionsOnResize',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'c2b10433187a177f9e5f76e402b5fab5' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_counter',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_counter',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '521649f300f3190f1da15658a900597e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_fontcolor',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_fontcolor',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '1ee67e6dde03f5c7333571995cc1965d' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_fontfamily',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_fontfamily',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '4aee6c497a4d9e4bffc4795d939c4eb5' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_fontsize',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_fontsize',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'ae16b02821eea8db3ff39666e74a37db' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_limiter',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_limiter',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '2a527a91073a8ed220807f90e50aee4a' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_table',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_table',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '25a8241a20c66ab0fff01b74e25b2ad9' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_textdirection',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_textdirection',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '965503b9c71b6dd428787ec04da89016' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_video',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_video',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'd599a390b74cc04616a17024f71917bd' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_replacer',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_replacer',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '040f68c548e563d43f07ed5611adc91d' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_syntax',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_syntax',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '9899547fd541d395156a25f3571b22ca' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_speek',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_speek',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'eae40de76990e14281f992f707719ab5' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_contrast',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_contrast',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'c9811c5a2e1a6e867075247fea05236f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_eureka',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_eureka',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '09cf0804a6112460aba9521977a18e72' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_eureka_shivie9',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_eureka_shivie9',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  'f155c140160021d48b209dd4fd9f792b' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.eurekaUpload',
    ),
    'object' => 
    array (
      'key' => 'redactor.eurekaUpload',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '15aef2c6f0b0125c1c2b5cb508cf0ee9' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.initial_directory_depth',
    ),
    'object' => 
    array (
      'key' => 'redactor.initial_directory_depth',
      'value' => '3',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Media',
      'editedon' => NULL,
    ),
  ),
  '273d948b1abcd581926f7542a44bd477' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_zoom',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_zoom',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'ae8af597d6c354ff88d1e0b737c13b70' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_download',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_download',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '3f4c30f2f1799b25b3ca312363cb6f53' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_imagepx',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_imagepx',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '1ee6c5e57fde94e868b51e1d445c0ad2' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_imageurl',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_imageurl',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '69b9ad21066bab12a92a00d6ab32f317' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_breadcrumb',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_breadcrumb',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '8c680721a6ade07eb2f61422bc45f480' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_norphan',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_norphan',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'c85416fde7554a458e6cc1f5aaa4dfa3' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_baseurls',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_baseurls',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  'c5a2b2b09681df5615452224faab36b3' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.textexpander',
    ),
    'object' => 
    array (
      'key' => 'redactor.textexpander',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => NULL,
    ),
  ),
  '307d1206ba7c74461e1a1961edcef09e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.speechPitch',
    ),
    'object' => 
    array (
      'key' => 'redactor.speechPitch',
      'value' => '1',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => NULL,
    ),
  ),
  '5862207eca0e339d72ec7c47530d1b86' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.speechRate',
    ),
    'object' => 
    array (
      'key' => 'redactor.speechRate',
      'value' => '1',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => NULL,
    ),
  ),
  '5185d19eee11754aac5b48986cdd1949' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.speechVolume',
    ),
    'object' => 
    array (
      'key' => 'redactor.speechVolume',
      'value' => '1',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => NULL,
    ),
  ),
  'd4abb35705e27134136136c71a2e85aa' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.speechVoice',
    ),
    'object' => 
    array (
      'key' => 'redactor.speechVoice',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => NULL,
    ),
  ),
  'e6a0c417110971164c14faca53c38f10' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.counterWPM',
    ),
    'object' => 
    array (
      'key' => 'redactor.counterWPM',
      'value' => '275',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => NULL,
    ),
  ),
  '35ffd227bcddd358db21635437362fcf' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.codemirror',
    ),
    'object' => 
    array (
      'key' => 'redactor.codemirror',
      'value' => '1',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '94acdc061846af635c61e3f4305b44e8' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.plugin_uploadcare',
    ),
    'object' => 
    array (
      'key' => 'redactor.plugin_uploadcare',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Plugin',
      'editedon' => NULL,
    ),
  ),
  '124caa685f1ea0ef0e6f1e2d53be279e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.uploadcare_pub_key',
    ),
    'object' => 
    array (
      'key' => 'redactor.uploadcare_pub_key',
      'value' => 'demopublickey',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Uploadcare',
      'editedon' => NULL,
    ),
  ),
  '8a90cdab8520f3e75c7a89b19445685f' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.uploadcare_locale',
    ),
    'object' => 
    array (
      'key' => 'redactor.uploadcare_locale',
      'value' => 'en',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Uploadcare',
      'editedon' => NULL,
    ),
  ),
  '4983d3618a6eb32df32e2dbee1ce5614' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.uploadcare_crop',
    ),
    'object' => 
    array (
      'key' => 'redactor.uploadcare_crop',
      'value' => 'free',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Uploadcare',
      'editedon' => NULL,
    ),
  ),
  '22de0153622426e449d5d1082d17b5d0' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.uploadcare_tabs',
    ),
    'object' => 
    array (
      'key' => 'redactor.uploadcare_tabs',
      'value' => 'all',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Uploadcare',
      'editedon' => NULL,
    ),
  ),
  '3f8bdb1c354b6dc5a3c5a57ea7ca2431' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.loadIntrotext',
    ),
    'object' => 
    array (
      'key' => 'redactor.loadIntrotext',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
  '61627d3b9c97a5c56f0f1d9f60b19fac' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.limiter',
    ),
    'object' => 
    array (
      'key' => 'redactor.limiter',
      'value' => '150',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'Editor',
      'editedon' => NULL,
    ),
  ),
);