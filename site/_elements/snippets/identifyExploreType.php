<?php
$temp = $_SERVER[REQUEST_URI];

$URI = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(strpos($temp, "/topics/") !== false){
    // Set placeholders to page
    $modx->setPlaceholder('result_type_explore', 'Topic');
}
else {
    // Set placeholders to page
    $modx->setPlaceholder('result_type_explore', 'Highlight');
}
$modx->setPlaceholder('URI', $URI);
$modx->setPlaceholder('explore_exists', 'true');

return;