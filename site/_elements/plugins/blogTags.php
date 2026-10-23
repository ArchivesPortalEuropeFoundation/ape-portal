<?php
$blogAlias = 'blog';
$blogContainer = 13;

$modx->addPackage('tagger', MODX_CORE_PATH . 'components/tagger/model/','modx_');
$url = explode('/', $_SERVER['REQUEST_URI']);

if ($url[1] != $blogAlias) {return true;}
if ($url[1] == $blogAlias) {
    //Check here if the tag actually exists - if it does, go to the page, if not 404
    if ($modx->getCount('TaggerTag', array('alias' => strtolower($url[2])))) {
        $data = array(
            'tag'        => strtolower($url[2]),
            'tag_name'   => ucwords(str_replace('-', ' ', $url[2])),
        );

        $modx->setPlaceholders($data, 'tag.');
        $modx->sendForward($blogContainer, array('merge' => 1));
    }
}
