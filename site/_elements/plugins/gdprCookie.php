<?php
/**
 * GDPR Cookie Check 
 * Plugin for MODX that checks if GDPR has been accepted. If so it will 
 * output scripts
 */

 $headScripts   = $modx->getOption('head', $scriptProperties, $modx->getOption('scripts'));
 $bodyScripts   = $modx->getOption('body', $scriptProperties, $modx->getOption('body_scripts'));
 $footerScripts = $modx->getOption('footer', $scriptProperties, $modx->getOption('footer_scripts'));
 $cookieName    =  $modx->getOption('cookie', $scriptProperties, 'cookiesAccept');
 


$eventName = $modx->event->name;
switch ($eventName) {
    case 'OnLoadWebDocument':
        // get the cookie 
        if (isset($_COOKIE[$cookieName]) && !empty($_COOKIE[$cookieName]) && boolval($_COOKIE[$cookieName])) {
 
            // register the client scripts
            $modx->regClientStartupHTMLBlock($headScripts);
            $modx->regClientHTMLBlock($footerScripts);
            // output to placeholder 
            $modx->setPlaceholder('body_scripts', $bodyScripts);
        }
        break;
}