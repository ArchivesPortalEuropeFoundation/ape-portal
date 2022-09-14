<?php
require_once dirname(__DIR__) . '/images/upload.class.php';
/**
 * @package moreGallery
 */
class moreGalleryMgrVideosSelectProcessor extends moreGalleryMgrImagesUploadProcessor {
    public $classKey = 'mgVideo';
    public $permission = array('moregallery_view_gallery' => true, 'moregallery_video' => true);
    /** @var mgVideo */
    public $object;

    public function initialize()
    {
        $key = $this->getProperty('class_key');
        if (in_array($key, array('mgYouTubeVideo','mgVimeoVideo'), true)) {
            $this->classKey = $key;
        }
        return parent::initialize();
    }

    /**
     * @return bool|string
     */
    public function beforeSet() {
        $prepped = $this->getResourceAndSource();
        if ($prepped !== true) {
            return $prepped;
        }
        
        $this->object->setProperty('video_id', $this->getProperty('video_id'));
        $this->setProperty('sortorder', $this->modx->getCount('mgImage', array('resource' => $this->resource->get('id'))) + 1);
        return !$this->hasErrors();
    }

    /**
     * @return bool
     */
    public function afterSave() {
        if (!$this->object->loadMetaInformation()) {
            $this->object->remove();
            $this->imageErrors[] = $this->modx->lexicon('moregallery.video_load_error');
            return false;
        }
        $this->object->checkManagerThumb();
        /**
         * Invoke the MoreGallery_OnImageCreate event so people can hook into this for doing stuff on upload.
         */
        $this->modx->invokeEvent('MoreGallery_OnImageCreate',
            array(
                'id' => $this->object->get('id'),
                'object' => &$this->object,
                'mode' => mgImage::MODE_VIDEO,
                'resource' => &$this->resource,
            )
        );
        return true;
    }
    public function cleanup()
    {
        if (!empty($this->imageErrors)) {
            return $this->failure(implode("\n", $this->imageErrors), array());
        }

        $reloaded = $this->modx->getObject($this->classKey, $this->object->get('id'));
        $array = $reloaded->toArray();

        // Ignore EXIF/IPTC data, this can potentially break the response if it contains invalid characters.
        unset ($array['exif'], $array['exif_dump'], $array['exif_json'],
            $array['iptc'], $array['iptc_dump'], $array['iptc_json']);

        // Triggering getCrops will create the crop records which will generate the cropped images
        // We also need to pass the crops back so they can be edited.
        $array['crops'] = $this->modx->toJSON($reloaded->getCropsAsArray());
        $array['type_label'] = '';
        if ($this->object instanceof mgYouTubeVideo) {
            $array['type_label'] = 'type_youtube';
        }
        elseif ($this->object instanceof mgVimeoVideo) {
            $array['type_label'] = 'type_vimeo';
        }
        return $this->success('', $array);
    }
}

return 'moreGalleryMgrVideosSelectProcessor';
