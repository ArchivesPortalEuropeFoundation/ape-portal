<?php
require_once $modx->getOption('core_path') . 'components/emogrifier/emogrifier.php';

$html = $modx->getChunk('site_email', array(
    'content' => $content
));

$css = file_get_contents($modx->getOption('base_path') . $modx->getOption('email_css'));

$emogrifier = new Emogrifier($html, $css);

return $emogrifier->emogrify();