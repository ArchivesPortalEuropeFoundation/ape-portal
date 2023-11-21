<?php
$eventName = $modx->event->name;
switch($eventName) {
    case 'OnMidHandleRequest':
        
        $url = $_SERVER['REQUEST_URI'];
        if (substr( $url, 0, 9 ) === "/archive/") {
            $modx->resourceIdentifier = 60;
            $modx->resourceMethod = 'id';
        }
        else if (substr( $url, 0, 6 ) === "/name/") {
            $modx->resourceIdentifier = 61;
            $modx->resourceMethod = 'id';
        }
        else if (substr( $url, 0, 13 ) === "/institution/") {
            $modx->resourceIdentifier = 62;
            $modx->resourceMethod = 'id';
        }
        
        break;
}

return "";