<?php
// snippet for including the blog subscribe form for side bar sections

// text comes from TV on resource 13
$page = $modx->getObject('modResource', 13);
$blog_subscribe_text = $page->getTVValue('blogSubscribe');

$html = $modx->getChunk("blog_subscribe", array(
    "blog_subscribe_text" => $blog_subscribe_text
));

return $html;