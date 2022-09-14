<?php

require_once dirname(dirname(dirname(__FILE__))).'/processors/mgr/create.class.php';
require_once dirname(dirname(dirname(__FILE__))).'/processors/mgr/update.class.php';
/**
 * Class mgResource
 */
class mgResource extends modResource {
    public $showInContextMenu = true;

    /** @var modMediaSource|modFileMediaSource|modS3MediaSource $source */
    public $source;

    /** @var moreGallery */
    public $moregallery;

    /**
     * Loads up the moreGallery class and enforces a class_key of moreGallery.
     * @param xPDO|modX $xpdo
     */
    public function __construct(xPDO &$xpdo) {
        parent :: __construct($xpdo);
        $this->set('class_key','mgResource');

        $corePath = $xpdo->getOption('moregallery.core_path', null, $xpdo->getOption('core_path') . 'components/moregallery/');
        $this->config = array(
            'templates_path' => $corePath . 'templates/',
        );
        $this->moregallery = $this->xpdo->getService('moregallery', 'moreGallery', $corePath . 'model/moregallery/');
        if (!($this->moregallery instanceof moreGallery)) {
            $this->xpdo->log(modX::LOG_LEVEL_ERROR, 'Error loading moreGallery class from ' . $corePath, '', __METHOD__, __FILE__, __LINE__);
        }
    }

    public function duplicate(array $options = array())
    {
        $duplicated = parent::duplicate($options);
        if ($duplicated instanceof mgResource) {

            $images = $this->getMany('Images');

            foreach ($images as $image) {
                /** @var mgImage $image */
                $image->copyTo($duplicated, $this);
            }

        }
        return $duplicated;
    }


    /**
     * Returns the path to moregallery/controllers.
     *
     * @param xPDO $modx
     * @return string
     */
    public static function getControllerPath(xPDO &$modx) {
        return $modx->getOption('moregallery.core_path', null, $modx->getOption('core_path').'components/moregallery/').'controllers/';
    }

    /**
     * Returns the text to add to the context menu.
     *
     * @return array
     */
    public function getContextMenuText() {
        $this->xpdo->lexicon->load('moregallery:default');
        return array(
            'text_create' => $this->xpdo->lexicon('moregallery.name'),
            'text_create_here' => $this->xpdo->lexicon('moregallery.name_here'),
        );
    }

    /**
     * Returns the "friendly class name".
     *
     * @return null|string
     */
    public function getResourceTypeName() {
        $this->xpdo->lexicon->load('moregallery:default');
        return $this->xpdo->lexicon('moregallery.name');
    }

    /**
     * @return string
     */
    public function getSourceRelativeUrl() {
        if (!$this->moregallery->resource) {
            $this->moregallery->setResource($this);
        }

        $url = $this->getProperty('relative_url', 'moregallery', 'inherit');
        if ($url === 'inherit') {
            $url = $this->moregallery->getOption('moregallery.source_relative_url', null, 'assets/galleries/');
        }

        $includeGalleryID = (bool)$this->moregallery->getOption('moregallery.resource_id_in_path', null, '1');
        if ($includeGalleryID) {
            $url = rtrim($url, '/') . '/' . $this->get('id');
        }
        $url = rtrim($url, '/') . '/';
        $url = $this->moregallery->parsePathVariables($url);
        return $url;
    }

    /**
     * @return modMediaSource|null
     */
    public function _getSource() {
        if ($this->source) return $this->source;

        $id = $this->getProperty('source', 'moregallery', 'inherit');
        if ($id == 'inherit') {
            $id = $this->xpdo->moregallery->getOption('moregallery.source', null, 1, true);
        }

        $this->xpdo->loadClass('sources.modMediaSource');
        $this->source = modMediaSource::getDefaultSource($this->xpdo, $id);
        if ($this->source) {
            $this->source->getWorkingContext();
            $this->source->initialize();
            return $this->source;
        }
        return null;
    }
}
