<?php
/**
 * Gets a list of mgImage objects.
 */
class mgImageGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'mgImage';
    public $defaultSortField = 'sortorder';
    public $defaultSortDirection = 'ASC';

    /**
     * @return bool
     */
    public function beforeQuery() {
        $this->setProperty('limit', 0);
        return true;
    }

    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $resource = (int)$this->getProperty('resource');
        if (!empty($resource)) {
            $c->where(array(
                'resource' => $resource
            ));
        }
        return $c;
    }

    /**
     * @param mgImage|xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $array = $object->toArray('', false, true);

        if ($object instanceof mgVideo) {
            $array['full_view'] = $object->getManagerEmbed();
        }
        else {
            /**
             * To provide something to the user as fast as possible, the first
             * 20 thumbs are included as a base64 encoded data uri. This prevents additional
             * requests for the images.
             */
            $prefetchAmount = (int)$this->modx->getOption('moregallery.prefetch_image_as_base64', null, 20);
            if ($this->currentIndex < $prefetchAmount && $array['_source_is_local']) {
                // Get the mime type
                $imageType = null;
                if (function_exists('exif_imagetype')) {
                    $imageType = @exif_imagetype($array['mgr_thumb_path']);
                }
                if ($imageType === null) {
                    $imageType = @getimagesize($array['mgr_thumb_path']);
                    $imageType = $imageType[2];
                }
                if ($imageType !== null && file_exists($array['mgr_thumb_path'])) {
                    $mime = image_type_to_mime_type($imageType);
                    $array['mgr_thumb'] = "data:$mime;base64," . base64_encode(file_get_contents($array['mgr_thumb_path']));
                }
            }
        }

        // Prevent possible issue with binary data in the exif data, plus we don't use it in the front end
        unset ($array['exif'], $array['iptc']);

        $array['crops'] = $this->modx->toJSON($object->getCropsAsArray());
        $array['type_label'] = '';
        if ($object instanceof mgYouTubeVideo) {
            $array['type_label'] = 'type_youtube';
        }
        elseif ($object instanceof mgVimeoVideo) {
            $array['type_label'] = 'type_vimeo';
        }
        elseif ($object->get('extension') === 'pdf') {
            $array['type_label'] = 'type_pdf';
        }

        return $array;
    }

    /**
     * @param array $array
     * @param bool $count
     *
     * @return string
     */
    public function outputArray(array $array,$count = false) {
        return $this->modx->toJSON($array);
    }
}
return 'mgImageGetListProcessor';
