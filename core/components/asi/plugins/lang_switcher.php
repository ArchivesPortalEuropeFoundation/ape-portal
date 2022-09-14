<?php
/**
 * Lang switcher 
 * =============
 * Version 0.0.5 Alpha
 * 
 * This plugin sets session lang vars based on 
 * a GET request, then routes to the correct
 * resource based on the WEB context resource 
 * babel link matching the culture key.
 * 
 * 
 */
$eventName = $modx->event->name;
$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = explode(',', $modx->getOption('langKeys', $scriptProperties, "en,de,fr,es,it"));
$resourceTvs;

$holdingID = $modx->getOption('gateway', $scriptProperties, 393);
$babel_tv_id = $modx->getOption('babel_tv_id', $scriptProperties, 133);
    
switch($eventName) {
    case 'OnMODXInit':
    case 'OnHandleRequest':
        if ($modx->context->get('key') == 'mgr') return;

        if (isset($_REQUEST['lang'])) {
    
            switch (strtolower(rtrim($_REQUEST['lang']))) {
                case 'en':
                    $cultureKey = 'en';
                break;
            
                case 'de':
                    $cultureKey = 'de';
                break;
            
                case 'fr':
                    $cultureKey = 'fr';
                break;
            
                case 'es':
                    $cultureKey = 'es';
                break;
                case 'it':
                    $cultureKey = 'it';
                break;
            }

            $_SESSION['language'] = $cultureKey;
        }
        // Change lang based on browser pref
        if (!isset($_SESSION['language']) || $_SESSION['language'] == null || empty($_SESSION['language'])) {
            // No session lang 
            // check if the user is logged in and has a preferred lang
            if ($modx->user->hasSessionContext($modx->context->get('key'))) {
                $profile = $modx->user->getOne('Profile');
                $extended = $profile->get('extended');
                switch ($extended['userpref_language']) {
                    case "French":
                        $cultureKey = "fr";
                        break;
                    case "German":
                        $cultureKey = "de";
                        break;
                    case "Spanish":
                        $cultureKey = "es";
                        break;
                    case "Italian":
                        $cultureKey = "it";
                        break;
                    default:
                        $cultureKey = "en";
                }
            } else {
                // Not logged into the front end
                // Lets check the browser lang to see if we have 
                // a translation version
                $cultureKey = in_array($browser_lang, $acceptLang) ? $browser_lang : 'en';
            }
            // Set the session var 
            $_SESSION['language'] = $cultureKey;
        }

        switch ($_SESSION['language']) {
            case 'en':
                $lang = 'eng';
                $cultureKey = 'en';
                $contextKey = "web";
                $country = "United Kingdom";
                break;
            case 'de':
                $lang = 'ger';
                $cultureKey = 'de';
                $contextKey = "de";
                $country = "Germany";
                break;
            case 'fr':
                $lang = 'fra';
                $cultureKey = 'fr';
                $contextKey = "fr";
                $country = "France";
                break;
            case 'es':
                $lang = 'spa';
                $cultureKey = 'es';
                $contextKey = "es";
                $country = "Spain";
                break;
            case 'it':
                $lang = 'ita';
                $cultureKey = 'it';
                $contextKey = "it";
                $country = "Italy";
                break;
            default:
                $contextKey = "web";
                $country = "United Kingdom";
        }
        $modx->setOption('cultureKey', $cultureKey);
        $modx->setPlaceholder("language", $lang);
        $modx->setPlaceholder("usrCountry", $country);
        $modx->setPlaceholder("cultureKey", $cultureKey);
        $modx->setPlaceholder("contextKey", $contextKey);
        // $modx->setPlaceholder("browser", $browser_lang);
         //$modx->setPlaceholder("session", print_r($$_REQUEST, true));

    break;

    case 'OnLoadWebDocument':
        $modx->documentObject['cacheable'] = 0;

        // get the current resource ID 
        $id = $modx->resource->get('id');

        // Search TV table for babel 
        $babel = $modx->getObject('modTemplateVarResource', [
            'contentid' => $id,
            'tmplvarid' => $babel_tv_id
        ]);
        // do we have an object?
        if ($babel) {

            // explode the TV to get the context and resource IDs
            $resources = explode(';', $babel->get('value'));
            // [
            //     'web:1',
            //     'de:99'
            // ]
            foreach ($resources as $context) {
                $ctx_resource = explode(':', $context);

                if (trim($_SESSION['language']) == trim($ctx_resource[0])) {

                    // we have a match 
                    $translation =  $modx->getObject('modResource', $ctx_resource[1]);

                    // Check we have the translation 
                    if ($translation) {

                        // set the defaults 
                        $modx->resource->set('cacheable', 0);
                        $modx->resource->set('id', $translation->get('id'));
                        $modx->resource->set('pagetitle', $translation->get('pagetitle'));
                        $modx->resource->set('parent', $translation->get('parent'));
                        $modx->resource->set('longtitle', $translation->get('longtitle'));
                        $modx->resource->set('description', $translation->get('description'));
                        $modx->resource->set('introtext', $translation->get('introtext'));
                        $modx->resource->set('template', $translation->get('template'));

                        //$modx->resource->_content = $translation->get('content');
                        $TVs = $modx->getCollectionGraph('modTemplateVarResource', '{"TemplateVar":{}}', array('contentid' => $translation->get('id')));


                        // Lets set the TVs 
                        if ($TVs) {

                            foreach ($TVs as $t) {
                                $tvName = $t->TemplateVar->get('name');
                                $tvVal = $t->get($tvName);

                                $tvData = [
                                    $tvName,
                                    $t->get('value'),
                                    $t->TemplateVar->get('display'),
                                    null,
                                    $t->TemplateVar->get('type'),
                                ];
                                $modx->resource->set($tvName, $tvData);
                            }
                        }
                    }
                }
            }
        }


        break;

    case 'OnPageNotFound':
        // If a page is not found we'll need to search the 
        // alias to see if we actually have this in one of 
        // our contexts. If so, we'll need to load this 
        // document into our holding page and update the
        // templates.
        $resource = $modx->getObject('modResource', 
                [
                    'uri' => $_REQUEST['q'], 
                    'context_key' => $_SESSION['language']
                ]
            );
        if ($resource) {
            
            $modx->resource = $resource;
            // $modx->switchContext('web');
            $modx->sendForward($holdingID,['merge' =>true]);

        } 
        // else {
        //     $modx->sendErrorPage();
        // }
        break;
}