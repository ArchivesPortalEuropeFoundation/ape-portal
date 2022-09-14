<?php

/**
 * @package moregallery
 * @extends ResourceUpdateManagerController
 */
class mgResourceUpdateManagerController extends ResourceUpdateManagerController {
    /** @var mgResource $resource */
    public $resource;
    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array('resource','moregallery:default');
    }

     /**
     * Register custom CSS/JS for the page
     * @return void
     */
    public function loadCustomCssJs() {
        // Core-provided stuff.
        $mgrUrl = $this->context->getOption('manager_url', MODX_MANAGER_URL, $this->modx->_userConfig);
        $this->addJavascript($mgrUrl.'assets/modext/util/datetime.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/element/modx.panel.tv.renders.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/resource/modx.grid.resource.security.local.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/resource/modx.panel.resource.tv.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/resource/modx.panel.resource.js');
        $this->addJavascript($mgrUrl.'assets/modext/sections/resource/update.js');
        $this->addHtml('
        <script type="text/javascript">
        // <![CDATA[
        MODx.config.publish_document = "'.$this->canPublish.'";
        MODx.onDocFormRender = "'.$this->onDocFormRender.'";
        MODx.ctx = "'.$this->resource->get('context_key').'";
        Ext.onReady(function() {
            MODx.load({
                xtype: "modx-page-resource-update"
                ,resource: "'.$this->resource->get('id').'"
                ,record: '.$this->modx->toJSON($this->resourceArray).'
                ,publish_document: "'.$this->canPublish.'"
                ,preview_url: "'.$this->previewUrl.'"
                ,locked: '.($this->locked ? 1 : 0).'
                ,lockedText: "'.$this->lockedText.'"
                ,canSave: '.($this->canSave ? 1 : 0).'
                ,canEdit: '.($this->canEdit ? 1 : 0).'
                ,canCreate: '.($this->canCreate ? 1 : 0).'
                ,canDuplicate: '.($this->canDuplicate ? 1 : 0).'
                ,canDelete: '.($this->canDelete ? 1 : 0).'
                ,show_tvs: '.(!empty($this->tvCounts) ? 1 : 0).'
                ,mode: "update"
            });
        });
        // ]]>
        </script>');
        $this->loadRichTextEditor();

        $assetsUrl = $this->modx->getOption('moregallery.assets_url', null, $this->modx->getOption('assets_url').'components/moregallery/');
        $corePath = $this->modx->getOption('moregallery.core_path', null, $this->modx->getOption('core_path').'components/moregallery/');
        /** @var moreGallery $moreGallery */
        $moreGallery = $this->modx->getService('moregallery', 'moreGallery', $corePath.'model/moregallery/');
        if (!($moreGallery instanceof moreGallery) || !($moreGallery instanceof \modmore\Alpacka\Alpacka)) {
            // If the class can't be loaded, we let it fail in a way that doesn't completely wreck everything
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error loading moreGallery class from ' . $corePath);
            return;
        }

        $version = '?mgv=' . $moreGallery->version;

        // Instantiate the gallery
        $moreGallery->setResource($this->resource);
        $crops = $moreGallery->getCrops($this->resource);
        $customFields = $moreGallery->getCustomFields($this->resource);
        $customFields = !empty($customFields) ? $this->modx->toJSON($customFields) : 'false';

        $this->addHtml('<script type="text/javascript">
            moreGallery.config = '.$this->modx->toJSON($moreGallery->config).';
            moreGallery.crops = ' . $this->modx->toJSON($crops) . ';
            moreGallery.customFields = ' . $customFields . ';
        </script>');
        $this->addJavascript($assetsUrl.'mgr/js/moregallery.class.js' . $version);
        $this->addJavascript($assetsUrl.'mgr/js/widgets/mgresource.panel.resource.js' . $version);

        $moreGallery->mg();
        $tpl = $moreGallery->getChunk('mgr/update', $moreGallery->config);
        $this->addHtml($tpl);
    }
}
