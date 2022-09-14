<?php

class moreGalleryMgrImagesBulkTagsProcessor extends modProcessor {

    public function process()
    {
        $resource = (int)$this->getProperty('resource', 0);
        $ids = (string)$this->getProperty('ids', '');
        $ids = array_map('trim', explode(',', $ids));
        $tag = (string)$this->getProperty('tag');
        $action = $this->getProperty('tag_action') === 'delete' ? 'delete' : 'add';

        if ($tag === '') {
            return $this->failure($this->modx->lexicon('moregallery.tags.cant_be_empty'));
        }


        $tagObj = $this->modx->getObject('mgTag', array(
            'display' => $tag
        ));
        if (!($tagObj instanceof mgTag)) {
            if (!$this->modx->context->checkPolicy('moregallery_image_tags_new')) {
                return $this->modx->lexicon('permission_denied');
            }

            $tagObj = $this->modx->newObject('mgTag');
            $tagObj->fromArray([
                'display' => $tag,
                'createdon' => time(),
                'createdby' => ($this->modx->user) ? $this->modx->user->get('id') : 0,
            ]);
            $tagObj->save();

            $this->modx->invokeEvent('MoreGallery_OnTagCreate',
                array(
                    'id' => $tagObj->get('id'),
                    'tag' => $tag,
                    'object' => &$tagObj,
                )
            );
        }
        foreach ($ids as $id) {
            $tagged = $this->modx->getObject('mgImageTag', [
                'resource' => $resource,
                'image' => $id,
                'tag' => $tagObj->get('id'),
            ]);

            if ($action === 'add' && !$tagged) {
                $tagged = $this->modx->newObject('mgImageTag');
                $tagged->fromArray([
                    'resource' => $resource,
                    'image' => $id,
                    'tag' => $tagObj->get('id'),
                ]);
                $tagged->save();
            }
            elseif ($action === 'delete' && $tagged instanceof mgImageTag) {
                $tagged->remove();
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

return 'moreGalleryMgrImagesBulkTagsProcessor';
