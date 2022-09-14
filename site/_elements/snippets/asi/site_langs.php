<?php
/** 
 * This script takes the site_langs option 
 * and returns an array or single lang attr
 * 
 * Name: Name of language 
 * Key: Two letter ISO code
 * Code: Three letter ISO code
 */

$site_langs = $modx->getOption('site_langs');
$site_languages = [];

$languages = explode(',', $site_langs);

foreach ($languages as $language) {
    $lang_parts = explode(":", $language);
    // ["English","en","eng"]

    $site_languages[$lang_parts[0]] = [
        "name" => $lang_parts[0],
        "key" => $lang_parts[1],
        "code" => $lang_parts[2]
    ];
}

$tpl = $modx->getOption('tpl', $scriptProperties, null);
$key = $modx->getOption('key', $scriptProperties, null);
$name = $modx->getOption('name', $scriptProperties, null);
$code = $modx->getOption('code', $scriptProperties, null);
$debug = $modx->getOption('debug', $scriptProperties, false);