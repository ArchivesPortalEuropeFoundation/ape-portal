<?php
/**
 * Class mgImage
 */
class mgImage extends xPDOSimpleObject
{
    const MODE_UPLOAD = 'upload';
    const MODE_IMPORT = 'import';
    const MODE_IMPORT_MEDIA_MANAGER = 'import_media_manager';
    const MODE_VIDEO = 'video';

    protected $checkedForThumb = false;
    protected $iptcHeaderArray = array ( // thank you, stranger http://php.net/manual/en/function.iptcparse.php#113148
        '2#005'=>'DocumentTitle',
        '2#010'=>'Urgency',
        '2#015'=>'Category',
        '2#020'=>'Subcategories',
        '2#025'=>'Keywords', //added
        '2#040'=>'SpecialInstructions',
        '2#055'=>'CreationDate',
        '2#080'=>'AuthorByline',
        '2#085'=>'AuthorTitle',
        '2#090'=>'City',
        '2#095'=>'State',
        '2#101'=>'Country',
        '2#103'=>'OTR',
        '2#105'=>'Headline',
        '2#110'=>'Source',
        '2#115'=>'PhotoSource',
        '2#116'=>'Copyright',
        '2#120'=>'Caption',
        '2#122'=>'CaptionWriter'
    );

    /**
     * mgImage constructor.
     * @param xPDO|modX $xpdo
     */
    public function __construct(xPDO & $xpdo) {
        parent::__construct($xpdo);

        if (!isset($xpdo->moregallery)) {
            $this->_loadMoreGalleryService();
        }
    }

    public function get($k, $format = null, $formatTemplate= null)
    {
        $value = parent::get($k, $format, $formatTemplate);

        switch ($k)
        {
            case 'width':
            case 'height':
                if ($value < 1) {
                    $contents = $this->getFileContents();
                    if ($contents !== false && isset($contents['content'])) {
                        $size = getimagesizefromstring($contents['content']);
                        if (is_array($size) && isset($size[0], $size[1])) {
                            $this->set('width', $size[0]);
                            $this->set('height', $size[1]);
                            if (!$this->isNew()) {
                                $this->save();
                            }
                        }
                        else {
                            $this->xpdo->log(modX::LOG_LEVEL_ERROR, '[moregallery] Could not get width and height for image record ' . $this->get('id') . ' ' . print_r($size, true));
                        }
                    }
                }
                break;

            case 'extension':
                if (empty($value)) {
                    $filePath = $this->getFilePath('file');
                    $value = pathinfo($filePath, PATHINFO_EXTENSION);
                    $this->set('extension', $value);
                    if (!$this->isNew()) {
                        $this->save();
                    }
                }
                break;
        }

        return $value;
    }

    public function getFilePath($type = 'file', $silent = false)
    {
        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            $relativeUrl = $resource->getSourceRelativeUrl();
            $fileName = $this->get($type);
            if (empty($fileName)) {
                if (!$silent) {
                    $this->xpdo->log(xPDO::LOG_LEVEL_ERROR,
                        '[moregallery] ' . $this->_class . ' record ' . $this->get('id') . ' on resource ' . $this->get('resource') . ' does not have a ' . $type . ' value. This may indicate a corrupt upload. Unable to get ' . $type . ' path.');
                }

                return false;
            }

            return $resource->source->getBasePath() . $relativeUrl . $fileName;
        }
        return false;
    }

    public function getFileUrl($type = 'file')
    {
        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            $relativeUrl = $resource->getSourceRelativeUrl();
            $fileName = $this->get($type);
            if (empty($fileName)) {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moregallery] ' . $this->_class . ' record ' . $this->get('id') . ' on resource ' . $this->get('resource') . ' does not have a ' . $type . ' value. This may indicate a corrupt upload. Unable to get ' . $type . ' path.');

                return false;
            }

            return $resource->source->getObjectUrl($relativeUrl . $fileName);
        }
        return false;
    }

    public function getCropsAsArray()
    {
        $array = array();
        $crops = $this->getCrops();

        /** @var mgImageCrop $crop */
        foreach ($crops as $key => $crop)
        {
            $array[$key] = $crop->toArray();
        }

        return $array;
    }

    /**
     * Grabs (and creates) crops for an image.
     *
     * @return mgImageCrop[]
     */
    public function getCrops()
    {
        /**
         * Grab source and relative url info for creating thumbs if necessary
         */
        $resource = $this->getResource();
        if (!($resource instanceof mgResource )) {
            $this->xpdo->log(modX::LOG_LEVEL_ERROR, '[mgImage.getCrops] The resource for mgImage #' . $this->get('id') . ' is not a mgResource instance; can\'t load crop information.');
            return [];
        }
        $source = $resource->_getSource();
        if (!$source) {
            $this->xpdo->log(modX::LOG_LEVEL_ERROR, '[mgImage.getCrops] The media source for resource #' . $resource->get('id') . ' for mgImage #' . $this->get('id') . ' could not be loaded; can\'t load crop information.');
            return [];
        }
        $relativeUrl = $resource->getSourceRelativeUrl();

        /**
         * Grab the crops definitions so we can prepare a $crops array with the crop objects
         */
        $cropDefinition = $this->xpdo->moregallery->getCrops($resource);
        $crops = array();
        foreach ($cropDefinition as $key => $options)
        {
            $crops[$key] = false;
        }

        /**
         * Grab all crops for this image from the database, and loop over them to add them to $crops
         * but also to get rid of any that isn't used (e.g. after changing the crops setting)
         *
         * @var array $existingCrops
         */
        $existingCrops = $this->xpdo->getCollection('mgImageCrop', array('image' => $this->get('id')));
        /** @var mgImageCrop $cropObject */
        foreach ($existingCrops as $cropObject)
        {
            $cropKey = $cropObject->get('crop');
            if (isset($crops[$cropKey]))
            {
                $url = $cropObject->getThumb($this, $source, $relativeUrl);
                $cropObject->set('thumbnail_url', $url);
                $path = $cropObject->getThumb($this, $source, $relativeUrl, true);
                $cropObject->set('thumbnail_path', $path);
                $crops[$cropKey] = $cropObject;
            }
            else
            {
                $cropObject->remove();
            }
        }

        /**
         * Loop over the collected crops to make sure all mgImageCrop objects have been loaded
         * and create the ones that don't exist yet.
         */
        foreach ($crops as $key => $crop)
        {
            if ($crop === false)
            {
                /** @var mgImageCrop $crop */
                $crop = $this->xpdo->newObject('mgImageCrop');
                $crop->fromArray(
                    array(
                        'image' => $this->get('id'),
                        'crop' => $key,
                    )
                );
                $url = $crop->getThumb($this, $source, $relativeUrl);
                $crop->set('thumbnail_url', $url);
                $path = $crop->getThumb($this, $source, $relativeUrl, true);
                $crop->set('thumbnail_path', $path);
                $crop->save();
                $crops[$key] = $crop;
            }
        }

        return $crops;
    }

    /**
     * @param string $keyPrefix
     * @param bool $rawValues
     * @param bool $excludeLazy
     * @param bool $includeRelated
     *
     * @return array
     */
    public function toArray($keyPrefix= '', $rawValues= false, $excludeLazy= false, $includeRelated= false) {
        $array = parent::toArray($keyPrefix, $rawValues, $excludeLazy, $includeRelated);

        $resource = $this->getResource();
        if (!$rawValues) {

            if ($resource && $resource->_getSource()) {
                // Check if we have a manager thumbnail, and regenerate it if necessary
                if (!$this->checkedForThumb) {
                    $this->checkedForThumb = true;
                    $this->checkManagerThumb();
                }

                $thumb = $this->get('mgr_thumb');
                $relativeUrl = $resource->getSourceRelativeUrl();
                $thumbPath = $resource->source->getBasePath() . $relativeUrl . $thumb;
                $array[$keyPrefix . 'mgr_thumb_path'] = $thumbPath;
                $array[$keyPrefix . 'mgr_thumb'] = $resource->source->getObjectUrl($relativeUrl . $thumb);
                $array[$keyPrefix . 'file_url'] = $array[$keyPrefix . 'edit_image_url'] = $this->getFileUrl('file');
                $array[$keyPrefix . 'file_path'] = $this->getFilePath('file');
                $array[$keyPrefix . '_source_is_local'] = ($resource->source->get('class_key') === 'sources.modFileMediaSource');

                // For PDFs we make sure that the thumbnail is used in the edit view, otherwise
                // we'll get an <img> tag loading a pdf, which wont work oddly enough.
                if ($this->get('extension') === 'pdf') {
                    $array[$keyPrefix . 'edit_image_url'] = $array[$keyPrefix . 'mgr_thumb'];
                }

                $array[$keyPrefix . 'view_url'] = $this->xpdo->makeUrl($resource->get('id'), '', array(
                    $this->xpdo->moregallery->getOption('moregallery.single_image_url_param', null, 'iid') => $this->get('id'),
                ), $this->xpdo->moregallery->getOption('link_tag_scheme', null, 'full'));
            }

            // As of MoreGallery 1.5, all uploaded files already have their EXIF and IPTC data cleansed. However it's
            // possible for older images to break the processor loading of images due to old data. The additional
            // cleaning here ensures that everything works as expected, even if it contains invalid characters.
            $cleanExif = $this->cleanInvalidData($array[$keyPrefix.'exif']);
            $array[$keyPrefix . 'exif'] = $cleanExif;
            $array[$keyPrefix . 'exif_dump'] = print_r($cleanExif, true);
            $array[$keyPrefix . 'exif_json'] = $this->xpdo->toJSON($cleanExif);
            $cleanIptc = $this->cleanInvalidData($array[$keyPrefix.'iptc']);
            $array[$keyPrefix . 'iptc'] = $cleanIptc;
            $array[$keyPrefix . 'iptc_dump'] = print_r($cleanIptc, true);
            $array[$keyPrefix . 'iptc_json'] = $this->xpdo->toJSON($cleanIptc);

            $array[$keyPrefix . 'full_view'] = $this->getManagerEmbed();
        }
        return $array;
    }

    /**
     * @return mgResource|null
     */
    public function getResource() {
        $id = $this->get('resource');
        return $this->xpdo->moregallery->getResource($id);
    }

    /**
     * Removes files along with the image record.
     * 
     * @param array $ancestors
     *
     * @return bool
     */
    public function remove (array $ancestors = array ()) {
        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            $relativeUrl = $resource->getSourceRelativeUrl();

            $mgrThumb = $this->get('mgr_thumb');
            if (!empty($mgrThumb)) {
                $resource->source->removeObject($relativeUrl . $mgrThumb);
            }
            $file = $this->get('file');
            if (!empty($file)) {
                $resource->source->removeObject($relativeUrl . $file);
            }

            $crops = $this->getCrops();
            /** @var mgImageCrop $crop */
            foreach ($crops as $crop) {
                $cropThumbnail = $crop->get('thumbnail');
                if (!empty($cropThumbnail)) {
                    $resource->source->removeObject($relativeUrl . $cropThumbnail);
                }
            }

            if ($resource->source->hasErrors()) {
                $errors = $resource->source->getErrors();
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error(s) while removing file(s) for mgImage ' . $this->toJSON() . ':' . implode("\n", $errors));
            }
        }


        $this->clearCache();
        
        return parent::remove($ancestors);
    }

    /**
     * @param null $cacheFlag
     *
     * @return bool
     */
    public function save($cacheFlag= null) {
        if ($this->isNew()) {
            $this->setIfEmpty('uploadedon', time());
            $this->setIfEmpty('uploadedby', $this->xpdo->user ? $this->xpdo->user->get('id') : 0);
        }
        $saved = parent::save($cacheFlag);
        $this->clearCache();
        return $saved;
    }

    /**
     * Used by {@see self::save()}, this function only calls $this->set if there is not yet a value for it.
     *
     * @param $key
     * @param $value
     */
    protected function setIfEmpty($key, $value) {
        $current = $this->get($key);
        if (empty($current)) {
            $this->set($key, $value);
        }
    }

    public function clearCache() {
        $cacheOptions = array(
            xPDO::OPT_CACHE_KEY => 'moregallery',
            'multiple_object_delete' => true,
        );
        $resource = $this->get('resource');

        $this->xpdo->cacheManager->delete('single-image/' . $resource . '/', $cacheOptions);
        $this->xpdo->cacheManager->delete('image-collection/' . $resource . '/', $cacheOptions);
        $this->xpdo->cacheManager->delete('mgimage/'.$resource.'/', $cacheOptions);
        $this->xpdo->cacheManager->delete('mgimages/'.$resource.'/', $cacheOptions);
    }

    /**
     * Gets the image before this one.
     *
     * @param string $sortBy
     *
     * @param bool $activeOnly
     * @return null|mgImage
     */
    public function getPrevious($sortBy = 'sortorder', $activeOnly = true) {
        $c = $this->xpdo->newQuery('mgImage');
        $c->where(array(
            'resource' => $this->get('resource'),
            'AND:'.$sortBy.':<' => $this->get($sortBy),
        ));
        if ($activeOnly)
        {
            $c->where(array('active' => true));
        }
        $c->sortby($sortBy, 'DESC');
        $c->limit(1);

        return $this->xpdo->getObject('mgImage', $c);
    }

    /**
     * Gets the image after this one.
     *
     * @param string $sortBy
     *
     * @param bool $activeOnly
     * @return null|mgImage
     */
    public function getNext($sortBy = 'sortorder', $activeOnly = true) {
        $c = $this->xpdo->newQuery('mgImage');
        $c->where(array(
            'resource' => $this->get('resource'),
            'AND:'.$sortBy.':>' => $this->get($sortBy),
        ));
        if ($activeOnly)
        {
            $c->where(array('active' => true));
        }
        $c->sortby($sortBy, 'ASC');
        $c->limit(1);

        return $this->xpdo->getObject('mgImage', $c);
    }

    /**
     * @return array|mixed
     */
    public function getTags() {
        $co = array(xPDO::OPT_CACHE_KEY => 'moregallery');
        $tags = $this->xpdo->cacheManager->get('tags/image/'.$this->get('id'), $co);
        if (is_array($tags)) return $tags;

        $tags = array();
        $c = $this->xpdo->newQuery('mgTag');
        $c->innerJoin('mgImageTag', 'Images');
        $c->where(array(
            'Images.image' => $this->get('id'),
        ));
        /** @var mgTag $tag */
        foreach ($this->xpdo->getIterator('mgTag', $c) as $tag) {
            $tags[] = $tag->toArray();
        }

        $this->xpdo->cacheManager->set('tags/image/' . $this->get('id'), $tags, 0, $co);
        return $tags;
    }

    /**
     * Resize the image to a smaller one for use as mgr_thumb
     *
     * @param $content
     * @param int $width
     * @param int $height
     * @return bool|string
     */
    public function createThumbnail($content, $extension = 'jpg', $width = 250, $height = 250) {
        /** @var \Imagine\Image\ImagineInterface $imagine */
        $imagine = $this->xpdo->moregallery->getImagine();
        if (!$imagine) {
            return false;
        }

        // If the image is a PDF file, it needs a bit more work to get it propery parsed.
        if ($extension === 'pdf') {
            $extension = 'png';
            $content = $this->xpdo->moregallery->writePdfAsImageAndReturnContent($content);
        }
        elseif (strtolower($extension) === 'svg') {
            $extension = 'png';
            // Make sure SVGs contain the <xml bit to prevent https://stackoverflow.com/questions/13125352/readimageblob-fatal-error-when-converting-svg-into-png
            if (strpos($content, '<?xml') !== 0) {
                $content = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>' . $content;
            }
        }

        try {
            $img = $imagine->load($content);
        } catch (Exception $e) {
            $this->xpdo->log(modX::LOG_LEVEL_ERROR, '[moreGallery] Unable to load image for record ' . $this->get('id') . 'to create thumbnail: ' . $e->getMessage());
            return $e->getMessage();
        }

        // Get the size to calculate the way we need to crop this image
        $size = $img->getSize();
        $actualWidth = $size->getWidth();
        $actualHeight = $size->getHeight();

        // Figure out the right size to make sure wide or tall images don't get super blurry
        // Basically this makes sure that the images are at least the defined size, rather than e.g. 250x50.
        if ($actualWidth > $actualHeight) {
            $width = ceil(($actualWidth / $actualHeight) * $width);
        }
        else {
            $height = ceil(($actualHeight / $actualWidth) * $height);
        }

        try {
            // Load the image with imagine and create a resized version
            $thumb = $img->resize(new \Imagine\Image\Box($width, $height));

            // Output the thumbnail as a string
            $options = array(
                'jpeg_quality' => (int)$this->xpdo->moregallery->getOption('moregallery.crop_jpeg_quality', null, '90'),
                'png_compression_level' => (int)$this->xpdo->moregallery->getOption('moregallery.crop_png_compression', null, '9'),
            );

            $thumbContents = $thumb->get($extension, $options);

            // Make the filename the ID, followed by a hash, and the extension (of course).
            $hash = md5(implode('-', $this->get(array('id', 'filename', 'file'))));
            $mgrThumb = $this->get('id') . '_' . $hash . '.' . $extension;

            // Grab the path and create the thumbnail
            $resource = $this->getResource();
            $resource->_getSource();
            $path = $resource->getSourceRelativeUrl();
            $resource->source->createContainer($path . '_thumbs/' , '/');
            $resource->source->errors = array();
            $resource->source->createObject($path . '_thumbs/', $mgrThumb, $thumbContents);
            $this->set('mgr_thumb', '_thumbs/' . $mgrThumb);
        } catch (Exception $e) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception ' . get_class($e) . ' while creating thumbnail: ' . $e->getMessage());
            return $e->getMessage();
        }
        return true;
    }
    
    public function loadExifData($file) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), array('jpeg', 'jpg', 'tiff'), true) && function_exists('exif_read_data')) {
            try {
                // Fetch EXIF data if we have it.
                $exif = @exif_read_data($file, NULL, false, false);
                if (is_array($exif)) {
                    foreach ($exif as $key => $value) {
                        $exif[$key] = $this->cleanInvalidData($value);
                    }
                    $this->set('exif', $exif);
                }
            } catch (Exception $e) {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception while trying to read exif data: ' . $e->getMessage());
            }
        } else {
            $this->xpdo->log(xPDO::LOG_LEVEL_WARN, '[moreGallery] This server does not have the exif_read_data function installed. MoreGallery cannot extract exif data now.');
        }
    }

    /**
     * Parses the IPTC data into something a bit more usable
     *
     * @param $data
     * @return array
     */
    public function loadIPTCData($data) {
        $iptc = iptcparse($data);

        $newIptc = array();
        if (is_array($iptc)) {
            foreach ($iptc as $key => $value) {
                if (array_key_exists($key, $this->iptcHeaderArray)) {
                    $key = $this->iptcHeaderArray[$key];
                }

                foreach ($value as &$v) {
                    $v = $this->cleanInvalidData($v);
                }
                unset ($v);

                if (count($value) === 1) {
                    $value = $value[0];
                }

                $newIptc[$key] = $value;
            }

            // Store the cleaned iptc data in the database
            $this->set('iptc', $newIptc);
        }

        return $newIptc;
    }

    /**
     * Prefills the name and tags from the provided IPTC data
     *
     * @param array $iptc
     */
    public function prefillFromIPTC(array $iptc = array())
    {
        $name = '';
        $iptcNameHeaders = array("Caption", "Headline", "DocumentTitle");
        foreach ($iptcNameHeaders as $key) {
            if (isset($iptc[$key]) && !empty($iptc[$key])) {
                $name = $iptc[$key];
            }
        }
        if (!empty($name)) {
            $this->set('name', $name);
        }

        $tags = array();
        $iptcTagHeaders = array('Category', 'Subcategories', 'Keywords');
        foreach ($iptcTagHeaders as $key) {
            if (isset($iptc[$key]) && !empty($iptc[$key])) {
                if (is_array($iptc[$key])) {
                    $tags = array_merge($tags, array_values($iptc[$key]));
                }
                else {
                    $tags[] = $iptc[$key];
                }
            }
        }
        $tags = array_unique($tags);
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                /** @var mgTag $tagObj */
                $tagObj = $this->xpdo->getObject('mgTag', array('display' => $tag));
                if (!$tagObj) {
                    $tagObj = $this->xpdo->newObject('mgTag');
                    $tagObj->fromArray(array(
                        'display' => $tag,
                    ));
                    $tagObj->save();
                }

                /** @var mgImageTag $link */
                $link = $this->xpdo->newObject('mgImageTag');
                $link->fromArray(array(
                    'resource' => $this->get('resource'),
                    'image' => $this->get('id'),
                    'tag' => $tagObj->get('id')
                ));
                $link->save();
            }
        }
    }

    /**
     * @param $content
     * @param $orientation
     * @param $format
     * @return bool|string
     */
    public function fixOrientation($content, $orientation, $format)
    {

        try {
            /** @var \Imagine\Image\ImagineInterface $imagine */
            $imagine = $this->xpdo->moregallery->getImagine();
            if (!$imagine) {
                return false;
            }

            // Load the image with imagine and create a resized version
            $thumb = $imagine->load($content);

            $degrees = 0;
            switch ($orientation) {
                case 3:
                    $degrees = 180;
                    break;
                case 6:
                    $degrees = 90;
                    break;
                case 8:
                    $degrees = 270;
                    break;
            }
            if ($degrees > 0) {
                $thumb->rotate($degrees);
                $options = array(
                    'jpeg_quality' => (int)$this->xpdo->moregallery->getOption('moregallery.crop_jpeg_quality', null, '90'),
                    'png_compression_level' => (int)$this->xpdo->moregallery->getOption('moregallery.crop_png_compression', null, '9'),
                );
                return $thumb->get($format, $options);
            }
        } catch (Exception $e) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception while creating mgr_thumb: ' . $e->getMessage());
        }
        return false;
    }

    public function copyTo(mgResource $resource, mgResource $oldResource)
    {
        // Get the raw contents of the current image
        $oldImageData = $this->toArray('', true);
        unset($oldImageData['id']);
        
        /** @var mgImage $newImage */
        // Create the new image record
        $newImage = $this->xpdo->newObject('mgImage');
        $newImage->fromArray($oldImageData, '', true);
        $newImage->set('resource', $resource->get('id'));
        $newImage->save();


        // Copy across tags for this image
        $tags = $this->xpdo->getIterator('mgImageTag', array('image' => $this->get('id')));
        foreach ($tags as $tag) {
            /** @var mgImageTag $newTag */
            $newTag = $this->xpdo->newObject('mgImageTag');
            $newTag->fromArray(array(
                'resource' => $resource->get('id'),
                'image' => $newImage->get('id'),
                'tag' => $tag->get('tag'),
            ), '', true);
            $newTag->save();
        }

        // Get the files that need to be copied
        $files = array();
        $files[] = $this->get('file');
        $files[] = $this->get('mgr_thumb');

        // Get the crops for this image and copy those, also add the cropped thumbnails to the $files array
        $crops = $this->getCrops();
        foreach ($crops as $crop) {
            /** @var mgImageCrop $newCrop */
            $newCrop = $this->xpdo->newObject('mgImageCrop');
            $newCrop->fromArray($crop->toArray());
            $newCrop->set('image', $newImage->get('id'));
            $newCrop->save();
            $files[] = $crop->get('thumbnail');
        }

        $this->xpdo->moregallery->setResource($oldResource);
        $relativeUrl = $oldResource->getSourceRelativeUrl();
        $oldBasePath = $oldResource->_getSource()->getBasePath() . $relativeUrl;

        $this->xpdo->moregallery->setResource($resource);
        $relativeUrl = $resource->getSourceRelativeUrl();
        $newBasePath = $resource->_getSource()->getBasePath() . $relativeUrl;

        if (!is_dir($newBasePath)) {
            $resource->source->createContainer($relativeUrl, '');
            $resource->source->createContainer($relativeUrl . '_thumbs/', '');
        }

        foreach ($files as $file) {
            if (!file_exists($oldBasePath . $file)) {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Error copying file ' . $file . ' from ' . $oldBasePath . ' to ' . $newBasePath . ' while trying to duplicate image ' . $this->get('id') . ' because the source image does not exist.');
            }
            elseif (!copy($oldBasePath . $file, $newBasePath . $file)) {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Error copying file ' . $file . ' from ' . $oldBasePath . ' to ' . $newBasePath . ' while trying to duplicate image ' . $this->get('id'));
            }
        }

        return $newImage;
    }

    private function _loadMoreGalleryService()
    {
        $corePath = $this->xpdo->getOption('moregallery.core_path', null, $this->xpdo->getOption('core_path') . 'components/moregallery/');
        $moreGallery = $this->xpdo->getService('moregallery', 'moreGallery', $corePath . 'model/moregallery/');
        if (!($moreGallery instanceof moreGallery)) {
            $this->xpdo->log(modX::LOG_LEVEL_ERROR, 'Error loading moreGallery class from ' . $corePath, '', __METHOD__, __FILE__, __LINE__);
        }
        return $moreGallery;
    }

    /**
     * @param $value
     * @return string
     */
    public function cleanInvalidData($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $subValue) {
                $value[$key] = $this->cleanInvalidData($subValue);
            }
            return $value;
        }

        return preg_replace('/[^\PC\s]/u', '', $value);
    }

    /**
     * Gets an extended property on the object. Use this instead of interacting with the `properties` value directly.
     *
     * @param $key
     * @param null $default
     * @return null
     */
    public function getProperty($key, $default = null)
    {
        $properties = $this->getProperties();
        if (isset($properties[$key])) {
            return $properties[$key];
        }
        return $default;
    }

    /**
     * Returns all saved properties
     *
     * @return array
     */
    public function getProperties()
    {
        $properties = $this->get('properties');
        if (!is_array($properties)) {
            $properties = array();
        }
        return $properties;
    }

    /**
     * Sets an extended property on the object. Use this instead of interacting with the `properties` value directly.
     *
     * @param string $key
     * @param null $value
     */
    public function setProperty($key, $value = null)
    {
        $properties = $this->getProperties();
        if (!is_array($properties)) {
            $properties = array();
        }
        $properties[$key] = $value;
        $this->setProperties($properties);
    }

    /**
     * Sets an array of properties on the object. If $merge is true, it will do an array_merge with the current data first
     * and otherwise it will overwrite it completely.
     *
     * @param $properties
     * @param bool $merge
     */
    public function setProperties($properties, $merge = true)
    {
        if ($merge) {
            $properties = array_merge($this->getProperties(), $properties);
        }
        $this->set('properties', $properties);
    }

    /**
     * Unsets the property specified by $key, and returns its value (if any).
     *
     * @param $key
     * @return mixed
     */
    public function unsetProperty($key)
    {
        $properties = $this->getProperties();
        if (isset($properties[$key])) {
            $value = $properties[$key];
            unset($properties[$key]);
            $this->setProperties($properties, false);
            return $value;
        }
        return null;
    }

    /**
     * Unsets all properties defined in $keys. Returns an array of $key => $oldValue values.
     *
     * @param array $keys
     * @return array
     */
    public function unsetProperties(array $keys = array())
    {
        $values = array();
        foreach ($keys as $key) {
            $values[$key] = $this->unsetProperty($key);
        }
        return $values;
    }

    /**
     * Returns a HTML embed code for the video.
     *
     * @return string
     */
    public function getManagerEmbed() {
        $fileUrl = $this->getFileUrl('file');
        
        $extension = pathinfo($fileUrl, PATHINFO_EXTENSION);
        if (strtolower($extension) === 'pdf') {
            return <<<HTML
            <object width="100%" height="500" type="application/pdf" data="$fileUrl">
            <p>Unable to preview PDF file.</p>
</object>
HTML;
        }

        return '<img src="' . $fileUrl . '">';
    }

    /**
     * Checks if the manager thumb is available, and creates it if not.
     *
     * @return bool
     */
    public function checkManagerThumb()
    {
        $thumb = $this->get('mgr_thumb');
        $thumbPath = $this->getFilePath('mgr_thumb', true);
        $resource = $this->getResource();
        $source = $resource instanceof mgResource ? $resource->_getSource() : false;
        if (empty($thumb) || ($source instanceof modFileMediaSource && !file_exists($thumbPath))) {
            $content = $this->getFileContents();
            if ($content) {
                $extension = pathinfo($this->get('file'), PATHINFO_EXTENSION);
                if ($this->createThumbnail($content['content'], $extension)) {
                    return $this->save();
                }
            }
        }
        return false;
    }

    public function getFileContents()
    {
        $file = $this->get('file');
        if (empty($file)) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moregallery] Image record ' . $this->get('id') . ' on resource ' . $this->get('resource') . ' does not have a file value. This may indicate a corrupt upload. Unable to create manager thumbnail.');
            return false;
        }
        $resource = $this->getResource();
        if (!$resource || !$resource->_getSource()) {
            return false;
        }
        $relativeUrl = $resource->getSourceRelativeUrl();
        $content = $resource->source->getObjectContents($relativeUrl . $file);
        if (!$resource->source->hasErrors()) {
            return $content;
        }

        $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error(s) loading file ' . $relativeUrl . $this->get('file') . ' for image ' . $this->get('id') . ' in gallery ' . $this->get('resource') . ' from media source ' . $resource->source->get('id') . ' : ' . print_r($resource->source->getErrors(), true));
        return false;
    }
}