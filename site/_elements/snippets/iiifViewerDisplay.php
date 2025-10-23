<?php
/**
 * @package getpage
 */

$value = $modx->getPlaceholder('archiveiiif.0');

//error_log("Oracle database not available2!" . print_r($modx->placeholders, true), 0);

if (!is_null($value)) {
    $output .= '<iframe src="' . $value . '" allow="fullscreen *;" style="width:100%; height:75vh; margin:0 auto; display:block"></iframe>';
}

return $output;