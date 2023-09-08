<?php
/**
 *
 * getUrlParam
 *
 * A simple snippet to return a value passed through a URL parameter.
 *
 * @ author Paul Merchant
 * @ copyright 2010 Paul Merchant
 * @ version 1.0.0 - October 15, 2010
 * @ MIT License
 *
 * OPTIONS
 * name - The parameter name, defaults to p
 * int - (Opt) Set as true to only allow integer values
 * max - (Opt) The maximum length of the returned value, defaults to 20
 * default - (Opt) The value returned if no URL parameter is found
 *
 * Example: [[getUrlParam? &name=`pageid` &int=`1`]]
 *
**/

// set defaults
$param1 = $modx->getOption('param1',$scriptProperties,'p');
$param2 = $modx->getOption('param2',$scriptProperties,'p');
$int = $modx->getOption('int',$scriptProperties,false);
$max = $modx->getOption('max',$scriptProperties,20);
$output = $modx->getOption('default',$scriptProperties,'');

// get the sanitized value if there is one
if (isset($_GET[$param1])) {
    return 'true';
}
else {
    if (isset($_GET[$param2])) {
        return 'false';
    }
    else {
        return 'both';
    }
}

return '';