<?php
// when user logs in or out, front end and manager are logged in / out together

function addLogout($modx, $context) {

    $modx->log(\modX::LOG_LEVEL_ERROR, "logging out - adding context [".$context."]");
    $c = array(
        'login_context' => $context,
        'add_contexts' => $context
    );
    $result = $modx->runProcessor('security/logout',$c);
    //$modx->log(\modX::LOG_LEVEL_ERROR, "Result: ".print_r($result, 1));
}

function addLogin($modx, $context) {

    $modx->log(\modX::LOG_LEVEL_ERROR, "logging in - adding context [".$context."]");
    $c = array(
        'login_context' => $context,
        'add_contexts' => $context
    );
    $result = $modx->runProcessor('security/login', $c);
    //$modx->log(\modX::LOG_LEVEL_ERROR, "Result: ".print_r($result, 1));
}

switch ($modx->event->name) {

    case "OnWebLogin":
        // addLogin($modx, "mgr");
        // this is handled in the login formit lump
        break;

    case "OnManagerLogin":
        addLogin($modx, "web");
        break;

    case "OnWebLogout":
        addLogout($modx, "mgr");
        break;

    case "OnManagerLogout":
        addLogout($modx, "web");
        break;

    default:
        // do nothing if it doesn't match
}