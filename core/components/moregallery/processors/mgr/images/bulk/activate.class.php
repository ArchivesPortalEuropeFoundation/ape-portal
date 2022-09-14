<?php

class moreGalleryMgrImagesBulkActivateProcessor extends modProcessor {

    public function process()
    {
        $resource = (int)$this->getProperty('resource', 0);
        $ids = $this->getProperty('ids', '');
        $ids = array_map('trim', explode(',', $ids));

        foreach ($ids as $id) {
            $image = $this->modx->getObject('mgImage', array(
                'id' => $id,
                'resource' => $resource
            ));
            if ($image) {
                $image->set('active', true);
                $image->save();
            }
        }

        return $this->success();
    }

    public function checkPermissions()
    {
        if (!$this->modx->context->checkPolicy(array(
            'moregallery_view_gallery' => true,
            'moregallery_image_edit' => true,
            'moregallery_image_active' => true)
        )) {
            return false;
        }
        return true;
    }
}

return 'moreGalleryMgrImagesBulkActivateProcessor';
