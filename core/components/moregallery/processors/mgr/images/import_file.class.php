<?php
/**
 * @package moreGallery
 */
class moreGalleryMgrImagesImportProcessor extends modObjectCreateProcessor {
    public $classKey = 'mgImage';
    public $permission = array('moregallery_view_gallery' => true, 'moregallery_import' => true);
    /** @var mgImage */
    public $object;

    public $path = '';
    public $_uploaded = false;

    /** @var mgResource */
    public $resource;

    public $imageErrors = array();

    /** @var moreGallery */
    public $moregallery;

    public function initialize()
    {
        $corePath = $this->modx->getOption('moregallery.core_path', null, $this->modx->getOption('core_path').'components/moregallery/');
        $this->moregallery =& $this->modx->getService('moregallery', 'moreGallery' , $corePath . 'model/moregallery/');
        return parent::initialize();
    }

    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array('file', 'moregallery:default');
    }

    /**
     * @return bool|string
     */
    public function beforeSet() {
        $resource = (int)$this->getProperty('resource', 0);
        $this->resource = $this->modx->getObject('modResource', $resource);
        if (!$this->resource || ($this->resource->get('class_key') != 'mgResource')) {
            return $this->modx->lexicon('moregallery.error_invalid_resource', array('resource' => $resource));
        }
        if (!$this->resource->_getSource()) {
            return $this->modx->lexicon('moregallery.error_loading_source');
        }

        $this->path = $this->resource->getSourceRelativeUrl();

        /**
         * Make sure the upload path exists. We unset errors to prevent issues if it already exists.
         */
        $this->resource->source->createContainer($this->path,'/');
        $this->resource->source->errors = array();

        /**
         * Check if the file exists
         */
        $file = $this->getProperty('file');
        // Handle remote images
        if (strpos($file, 'http') === 0) {
            $ch = curl_init($file);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            $result = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($result === false || $statusCode !== 200) {
                return $this->modx->lexicon('moregallery.file_doesnt_exist', array('file' => $file));
            }
            $file = str_ireplace(' ','%20',$file);
        }
        else {
            // Prepend the base path if the file is not provided as link or absolute path
            if (0 !== strpos($file, '/')) {
                $file = $this->modx->getOption('base_path') . $file;
            }

            // Check if the file can be read
            if (!file_exists($file) || !is_readable($file)) {
                return $this->modx->lexicon('moregallery.file_doesnt_exist', array('file' => $file));
            }
        }

        $this->setProperty('file', $file);

        /**
         * Handle getting data for the mgImage.
         */
        $fileName = $this->getProperty('filename');
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = substr($fileName, 0, strlen($fileName) - strlen($fileExtension) - 1);

        /**
         * Try to load the image name from IPTC data on the image fiel
         */
        try {
            getimagesize($file, $info);
            if (isset($info["APP13"])) {
                $this->object->loadIPTCData($info["APP13"]);
            }
        }
        catch (Exception $e) {}

        $this->setProperty('name', $fileName);
        $this->setProperty('filename', $fileName . '.' . $fileExtension);
        $this->setProperty('sortorder', $this->modx->getCount('mgImage', array('resource' => $resource)) + 1);
        return parent::beforeSet();
    }

    /**
     * @return bool
     */
    public function afterSave() {
        // Quick fix for some older 2.2 versions where afterSave() would get called more than once.
        if ($this->_uploaded) return true;
        $this->_uploaded = true;

        $imageIdPlacement = $this->modx->moregallery->getOption('moregallery.image_id_in_name', null, 'prefix', true);
        $id = $this->object->get('id');
        $fileName = $this->modx->moregallery->sanitizeFileName($this->object->get('filename'));
        $separator = $this->moregallery->getOption('moregallery.image_id_separator', null, '_');

        if ($imageIdPlacement === 'prefix') {
            $fileName = $id . $separator . $fileName;
        }
        elseif ($imageIdPlacement === 'suffix') {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = pathinfo($fileName, PATHINFO_FILENAME);
            $fileName = $fileName . $separator . $id . '.' . $ext;
        }

        $file = $this->getProperty('file');
        if (stripos($file, 'http') === 0) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $file);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $content = curl_exec($ch);
            curl_close($ch);
        }
        else {
            $content = file_get_contents($file);
        }

        /**
         * Do the import
         */
        $this->moregallery->renames = array();
        $uploaded = $this->resource->source->createObject($this->path, $fileName, $content);
        if (!$uploaded) {
            $errors = $this->resource->source->getErrors();
            $errors = implode('<br />', $errors);
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[moreGallery] Error importing file: ' . $errors);
            $this->imageErrors[] = $errors;
            $this->object->remove();
            return $this->failure($errors);
        }
        /**
         * Check if the file has been renamed by a plugin like FileSluggy
         */
        $newFileName = reset($this->moregallery->renames);
        if (!empty($newFileName)) {
            $baseMediaPath = $this->resource->source->getBasePath() . $this->path;
            $newFileName = substr($newFileName, strlen($baseMediaPath));
            $fileName = $newFileName;
        }

        /**
         * Add more data to the mgImage object
         */
        $this->object->set('file', $fileName);

        $file = $this->resource->source->getObjectContents($this->path . $fileName);


        /**
         * Based on the IPTC data, try to pre-fill certain fields
         */
        $iptc = $this->object->get('iptc');
        if ($this->moregallery->getOption('moregallery.prefill_from_iptc', null, true) && is_array($iptc)) {
            $this->object->prefillFromIPTC($iptc);
        }

        /**
         * Attempt to increase the memory limit as we're about to do some heavy image stuff
         */
        $this->moregallery->setMemoryLimit();

        /**
         * Register a shutdown function that will attempt to clean up stuff should the request fail with a fatal
         * error, for example due to image resizing and memory limits.
         */
        register_shutdown_function(array('moreGalleryMgrImagesImportProcessor', 'onShutdown'), $this);
        $this->object->loadExifData($file['path']);
        $exif = $this->object->get('exif');
        if (is_array($exif) && isset($exif['Orientation'])) {
            $format = pathinfo($fileName, PATHINFO_EXTENSION);
            $orientation = $exif['Orientation'];
            $fixedOrientation = $this->object->fixOrientation($file['content'], $orientation, $format);
            if ($fixedOrientation !== false)
            {
                $file['content'] = $fixedOrientation;
                $this->resource->source->updateObject($this->path . $fileName, $fixedOrientation);
            }
        }
        $this->object->createThumbnail($file['content']);

        // Save again; we added some more details.
        $this->object->save();

        /**
         * Invoke the MoreGallery_OnImageAdd event so people can hook into this for doing stuff on upload.
         */
        $this->modx->invokeEvent('MoreGallery_OnImageCreate',
            array(
                'id' => $this->object->get('id'),
                'object' => &$this->object,
                'mode' => mgImage::MODE_IMPORT,
                'resource' => &$this->resource,
            )
        );
        return parent::afterSave();
    }

    /**
     * Return the success message
     * @return array
     */
    public function cleanup() {
        if (empty($this->imageErrors)) {
            // Set the mgr_thumb as a base64 string to prevent the client from needing to
            // download the thumb after returning the successful upload
            $array = $this->object->toArray();
            $imageType = null;

            if (file_exists($array['mgr_thumb_path'])) {
                // Get the mime type
                if (function_exists('exif_imagetype')) {
                    $imageType = @exif_imagetype($array['mgr_thumb_path']);
                }
                if ($imageType === null) {
                    $imageType = @getimagesize($array['mgr_thumb_path']);
                    $imageType = $imageType[2];
                }
                if ($imageType !== null) {
                    $mime = image_type_to_mime_type($imageType);
                    $array['mgr_thumb'] = "data:$mime;base64," . base64_encode(file_get_contents($array['mgr_thumb_path']));
                }
            }

            // Ignore EXIF/IPTC data, this can potentially break the response if it contains invalid characters.
            unset ($array['exif'], $array['exif_dump'], $array['exif_json'],
                $array['iptc'], $array['iptc_dump'], $array['iptc_json']);

            // Triggering getCrops will create the crop records which will generate the cropped images
            // We also need to pass the crops back so they can be edited.
            $array['crops'] = $this->modx->toJSON($this->object->getCropsAsArray());

            return $this->success('', $array);
        }
        return $this->failure(implode("\n", $this->imageErrors), $this->object->toArray());
    }

    /**
     * When shutting down the PHP process, we check if there were any E_ERROR errors.
     *
     * This shutdown handler is defined right before trying to resize the image, so we
     * can assume the fatal error occurred during the resize.
     * 99% of the cases, this will mean an issue with memory_limit / file size.
     *
     * While we *could* leave the mgImage as-is, the fact that we were unable of resizing
     * likely means the image is too large to be resized in the front-end as well, so we
     * might as well remove it as it's only going to be trouble.
     *
     * @param moreGalleryMgrImagesImportProcessor $processor
     */
    public static function onShutdown(moreGalleryMgrImagesImportProcessor $processor)
    {
        $error = error_get_last();
        if (is_array($error) && $error['type'] == E_ERROR) {
            $processor->object->remove();
        }
    }
}

return 'moreGalleryMgrImagesImportProcessor';
