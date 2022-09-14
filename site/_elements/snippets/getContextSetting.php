<?php
$path = $modx->getOption('clientconfig.core_path', null, $modx->getOption('core_path') . 'components/clientconfig/');
$path .= 'model/clientconfig/';
$clientConfig = $modx->getService('clientconfig','ClientConfig', $path);


/* If we got the class (gotta be careful of failed migrations), grab settings and go! */
if ($clientConfig instanceof ClientConfig) {

    $contextKey = $modx->getOption('context', $scriptProperties, $modx->resource->context_key);

    $settings = $clientConfig->getSettings($contextKey);

    /* Make settings available as [[+context.]] */
    $modx->setPlaceholders($settings,'context.');
};