<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * Autotranslate
 * 
 * duplicate context
 * pass each resource to google translate
 * save each resource 
 * update babel tv with source and translated ids 
 */

$debug = [];

// Set user vars
$ctx_key   = $modx->getOption('lang', $scriptProperties);
$ctx_desc  = $modx->getOption('lang_desc', $scriptProperties, "new translation context");
$source    = $modx->getOption('source_lang', $scriptProperties, "en");
$api_key   = 'trnsl.1.1.20200402T085427Z.97784bd60766d09d.2392fc75f77cfa241a63ffe664e8af5da992d723';

// 1. Duplicate using the processor 
//
//
//

$createContext = $modx->runProcessor('context/duplicate', array(
    'key' => 'web',
    'newkey' => $ctx_key,
    'name' => $ctx_key,
    'description' => $ctx_desc,
    'preserve_resources' => 'on'
));

if ($createContext->isError()) {
    $debug['error']['duplicate_context'] = $createContext->getMessage();
}




// 2. Update the culture key
//
//
//

$updateCKey = $modx->getObject('modContextSetting', ['key' => 'cultureKey', 'context_key' => $ctx_key,]);
if(!$updateCKey) {
    $updateCKey = $modx->newObject('modContextSetting', array(
        'context_key' => $ctx_key,
        'key' => 'cultureKey'
    ));
}
$updateCKey->set('value', $ctx_key);

if ($updateCKey->save() == false) {

    //$modx->error->checkValidation($updateCKey);
    //$debug['error']['update_cultureKey'] = $this->failure($modx->lexicon($objectType . '_err_save'));
    $debug['error']['update_cultureKey'] = 'unable to set the culture key';
}

$debug['update']['cultureKey'] = $ctx_key;





// 3. Update system settings
//
//
//

$updateSystemSettings = array('babel.contextKeys', 'langrouter.contextKeys');

foreach ($updateSystemSettings as $setting) {
    $settingObj = $modx->getObject('modSystemSetting', $setting);
    if($settingObj) {
        if (empty($settingObj->value)) {
            $settingsStr = $ctx_key;
        } else {
            $settingsStr = $settingObj->value . ',' . $ctx_key;
        }
    
        $settingObj->set('value', $settingsStr);
    
        if ($settingObj->save() == false) {
    
            $modx->error->checkValidation($settingObj);
            $debug['error']['update_system_setting'][$setting] = $this->failure($modx->lexicon($objectType . '_err_save'));
        }
    
        $debug['update']['system_settings'][$setting] = $settingsStr;
    } else {
        $debug['update']['system_settings'][] = 'No settings to update';
    }
}


// rest tv vals for dev 
if($modx->getOption('reset', $scriptProperties, false)) {
    $reset = $modx->getCollection('modResource');
    foreach($reset as $rr) {
    
        $rr->setTVValue('babelLanguageLinks', '');
    }
}

// 4. Create babel link TVs 
//
//
$modx->reloadConfig();

// Get all resources from this context 
$resources = $modx->getCollection('modResource', ['context_key' => $ctx_key]);

if($resources) {
    foreach($resources as $r) {
        $babelTV = $r->getTVValue('babelLanguageLinks');

        // if the babel tv already has content 
        // this still needs working on 
        if($babelTV && !empty($babelTV)) {
            $ctxResourceTVval = $babelTV.','.$ctx_key.':'.$r->get('id');
            // Set the tv value 
            $r->setTVValue('babelLanguageLinks', $ctxResourceTVval);

            // Set the rest of the TV values
            $linked_resources = explode(',', $babelTV);
            foreach($linked_resources as $babel_sym) {
                $links = explode(":", $babel_sym);
                // ['web',1]

                $othTransResource = $modx->getObject('modResource', [
                    'id' => $links[1],
                ]);

                if($othTransResource) {
                    $othTransResourceTvVal = $othTransResource->getTVValue('babelLanguageLinks');
                    $othTransResource->setTVValue('babelLanguageLinks', $ctx_key . ':' . $r->get('id').','.$othTransResourceTvVal);
                }
            }
        } else {

            // get the modResource by alias 
            $webResource = $modx->getObject('modResource',[
                    'pagetitle' => $r->get('pagetitle'),
                    'context_key' => 'web',
                ]
            );
            $ctxResourceTVval = $ctx_key . ':' . $r->get('id');

            if ($webResource) {
                $webResourceTVval = 'web:' . $webResource->get('id');

                $babelTvVal = $webResourceTVval . ',' . $ctxResourceTVval;

                $webResource->setTVValue('babelLanguageLinks', $ctxResourceTVval . ',' . $webResourceTVval);
                $r->setTVValue('babelLanguageLinks', $webResourceTVval . ',' . $ctxResourceTVval);
            }

        }
            
    }
}



// 4. Create a link with Babel 

// $resources = $modx->getCollection(
//     'modResource',
//     array('deleted' => '0', 'context_key' => $ctx_key)
// );


// 4. Translate each resource
//
//
//

// // Get all resources from the new context
// $resources = $modx->getCollection(
//     'modResource',
//     array('deleted' => '0', 'context_key' => $ctx_key)
// );

// // Loop through each and prepare for sending to Google ML Translate
// foreach ($resources as $resource) {

//     $resource_tvs = [];
//     $resource_content = array(
//         'pagetitle'     => $resource->get('pagetitle'),
//         'longtitle'     => $resource->get('longtitle'),
//         'description'   => $resource->get('description'),
//         'introtext'     => $resource->get('introtext'),
//         'alias'         => $resource->get('alias'),
//         'content'       => $resource->get('content')
//     );

//     $translated_tvs = [];
//     $transalted_content = [];

//     // Get Template vars 
//     if ($tvs = $resource->getTemplateVars()) {

//         foreach ($tvs as $tv) {
//             $resource_tvs[$tv->get('name')] = $tv->get('value');
//         }
//     }

//     // Send content to Google for transaltion 
//     // Sending to Yandex for proof of concept
//     $arrContextOptions = array(
//         "ssl" => array(
//             "verify_peer" => false,
//             "verify_peer_name" => false,
//         ),
//     );

//     // Translate individually 
//     foreach ($resource_content as $modKey => $text_strings) {
//         // replace modx tags 
//         $text = str_replace(array("[[", "]]"), array("<modTag-", "\modTag>"), $text_strings);
//         $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $api_key . '&lang=' . $source . '-' . $ctx_key . '&format=html&text=' . urlencode($text), false, stream_context_create($arrContextOptions));
//         $json = json_decode($url);

//         $transalted_content[$modKey] = str_replace(array("<modTag-", "\modTag>"), array("[[", "]]"), $json->text[0]);
//     }

//     foreach ($resource_tvs as $tvKey => $tv_strings) {

//         $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $api_key . '&lang=' . $source . '-' . $ctx_key . '&format=html&text=' . urlencode($tv_strings), false, stream_context_create($arrContextOptions));
//         $json = json_decode($url);

//         $translated_tvs[$tvKey] = $json->text[0];
//     }


//     // Save returned content 
//     $resource->fromArray($transalted_content);
//     if ($resource->save() == false) {

//         $modx->error->checkValidation($settingObj);
//         $debug['error']['update_page_content'] = $this->failure($modx->lexicon($objectType . '_err_save'));
//     }

//     // Save returned TVs
//     if (!empty($translated_tvs)) {

//         foreach ($translated_tvs as $tv_key => $tv_value) {
//             $resource->setTVValue($tv_key, $tv_value);
//         }
//     }

// }



/// do this last
$modx->reloadConfig();

return "<pre>". print_r($debug, true) ."</pre>";