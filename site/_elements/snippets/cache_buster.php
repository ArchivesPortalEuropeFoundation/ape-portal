<?php
$value = $modx->getOption('cache_buster');
if(!is_numeric($value) || $modx->getOption('cache_disabled') == 1) {
    $value = sha1(date('U')."Bello");
}

return "cache=".$value;