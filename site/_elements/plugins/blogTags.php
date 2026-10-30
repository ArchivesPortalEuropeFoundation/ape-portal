<?php
// /blog/<tag>/ shows the blog container with the posts of that tag (Tagger). Unknown tag: normal 404.
// Tagger 2.x (MODX 3): the model is namespaced and autoloaded by the Tagger bootstrap, no addPackage needed.
use Tagger\Model\TaggerTag;

$blogAlias = 'blog';
$blogContainer = 13;

$url = explode('/', $_SERVER['REQUEST_URI']);

if (($url[1] ?? '') != $blogAlias) {return true;}
if (($url[1] ?? '') == $blogAlias) {
    //Check here if the tag actually exists - if it does, go to the page, if not 404
    if ($modx->getCount(TaggerTag::class, array('alias' => strtolower($url[2] ?? '')))) {
        $data = array(
            'tag'        => strtolower($url[2]),
            'tag_name'   => ucwords(str_replace('-', ' ', $url[2])),
        );

        $modx->setPlaceholders($data, 'tag.');
        $modx->sendForward($blogContainer, array('merge' => 1));
    }
}
