<?php
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$mgOptions = array();
if (isset($_REQUEST['resource']) && is_numeric($_REQUEST['resource']))
{
    $mgOptions['resource'] = (int)$_REQUEST['resource'];
}

$corePath = $modx->getOption('moregallery.core_path',null,$modx->getOption('core_path').'components/moregallery/');
$moreGallery = $modx->getService('moregallery', 'moreGallery' , $corePath . 'model/moregallery/', $mgOptions);
if (!($moreGallery instanceof moreGallery)) {
    return 'Error loading moreGallery class from ' . $corePath;
}

$modx->lexicon->load('moregallery:default');

/* handle request */
$modx->request->handleRequest(array(
    'processors_path' => $corePath.'processors/',
    'location' => '',
));
