<?php
class mgMediaManagerImage extends mgImage {
    /** @var MediaManager */
    protected $mediaManager;
    /** @var MediamanagerFiles */
    protected $_file = false;
    /** @var modMediaSource */
    protected $_source = false;

    public function __construct($xpdo)
    {
        parent::__construct($xpdo);
        $this->set('class_key', 'mgMediaManagerImage');

        $this->mediaManager = $xpdo->getService('mediamanager', 'MediaManager', $xpdo->getOption('mediamanager.core_path', null, $xpdo->getOption('core_path').'components/mediamanager/').'model/mediamanager/');

    }

    /**
     * @param string $keyPrefix
     * @param bool $rawValues
     * @param bool $excludeLazy
     * @param bool $includeRelated
     *
     * @return array
     */
    public function toArray($keyPrefix= '', $rawValues= false, $excludeLazy= false, $includeRelated= false)
    {
        $array = parent::toArray($keyPrefix, $rawValues, $excludeLazy, $includeRelated);
        if (!$rawValues) {
            $array[$keyPrefix . 'media_manager_id'] = $this->getProperty('media_manager_id');
            if ($file = $this->getFileObject()) {
                $array[$keyPrefix . 'media'] = $file->toArray('');
                $iterator = $this->xpdo->getIterator('MediamanagerFilesMeta', array(
                    'mediamanager_files_id' => $file->get('id')
                ));
                foreach ($iterator as $meta) {
                    $array[$keyPrefix . 'media'][$meta->get('meta_key')] = htmlentities($meta->get('meta_value'), ENT_QUOTES, 'UTF-8');
                }
            }
        }

        return $array;
    }

    /**
     * @return bool|MediamanagerFiles
     */
    public function getFileObject()
    {
        if ($this->_file) {
            return $this->_file;
        }
        $id = (int)$this->getProperty('media_manager_id', 0);
        /** @var MediamanagerFiles $file */
        if ($file = $this->xpdo->getObject('MediamanagerFiles', $id)) {
            $this->_file = $file;
            return $file;
        }
        return false;
    }

    public function getFileSource()
    {
        if ($this->_source) {
            return $this->_source;
        }
        if ($file = $this->getFileObject()) {
            $sourceId = $file->get('media_sources_id');
            $this->xpdo->loadClass('sources.modMediaSource');
            $source = modMediaSource::getDefaultSource($this->xpdo, $sourceId);
            if ($source) {
                $source->getWorkingContext();
                $source->initialize();

                $this->_source = $source;

                return $source;
            }
        }
        return false;
    }

    /**
     * Loads meta data for the video and inserts it into the object.
     */
    public function loadMetaInformation()
    {
        $this->set('filename', 'n/a');
        $this->set('name', 'n/a');
        $this->set('width', 0);
        $this->set('height', 0);

        if ($file = $this->getFileObject()) {
            $this->set('filename', 'media:' . (int)$this->getProperty('media_manager_id', 0));
            $this->set('name', $file->get('name'));

            $size = $file->get('file_dimensions');
            $size = explode('x', $size);
            $this->set('width', $size[0]);
            $this->set('height', $size[1]);
            return true;
        }
        return false;
    }

    public function getFilePath($type = 'file', $silent = false)
    {
        if ($type !== 'file') {
            return parent::getFilePath($type, $silent);
        }

        /** @var MediamanagerFiles $file */
        if ($file = $this->getFileObject()) {
            if ($source = $this->getFileSource()) {
                $path = $file->get('path');
                return $source->getBasePath() . $path;
            }
        }

        if (empty($fileName) && !$silent) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moregallery] Image record ' . $this->get('id') . ' on resource ' . $this->get('resource') . ' can\'t find the associated Media Manager record to get the path.');
        }

        return false;
    }

    public function getFileUrl($type = 'file')
    {
        if ($type !== 'file') {
            return parent::getFileUrl($type);
        }

        /** @var MediamanagerFiles $file */
        if ($file = $this->getFileObject()) {
            if ($source = $this->getFileSource()) {
                $path = $file->get('path');
                return $source->getObjectUrl($path);
            }
        }

        if (empty($fileName)) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moregallery] ' . $this->_class . ' record ' . $this->get('id') . ' on resource ' . $this->get('resource') . ' can\'t find the associated Media Manager record to get the path.');
            return false;
        }

        return false;
    }

    public function getFileContents()
    {
        /** @var MediamanagerFiles $file */
        if ($file = $this->getFileObject()) {
            if ($source = $this->getFileSource()) {
                $path = $file->get('path');
                return $source->getObjectContents($path);
            }
        }

        $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moregallery] ' . $this->_class . ' record ' . $this->get('id') . ' on resource ' . $this->get('resource') . ' does not have a file value or the media source cant be loaded. ');
        return false;
    }
}