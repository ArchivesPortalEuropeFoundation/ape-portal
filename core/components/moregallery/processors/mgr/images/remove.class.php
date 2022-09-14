<?php
/**
 * Class mgImageRemoveProcessor
 *
 * @package moreGallery
 * @affects mgImage
 */
class mgImageRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'mgImage';
    public $afterRemoveEvent = 'MoreGallery_OnImageRemove';
    public $permission = array('moregallery_view_gallery' => true, 'moregallery_image_delete' => true);
}
return 'mgImageRemoveProcessor';
