<?php
/**
 * Class mgImageTagRemoveProcessor
 *
 * @package moreGallery
 * @affects mgImageTag
 */
class mgImageTagRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'mgImageTag';
    public $afterRemoveEvent = 'MoreGallery_OnImageTagRemove';
    public $permission = array('moregallery_view_gallery' => true, 'moregallery_image_tags' => true);
}
return 'mgImageTagRemoveProcessor';
