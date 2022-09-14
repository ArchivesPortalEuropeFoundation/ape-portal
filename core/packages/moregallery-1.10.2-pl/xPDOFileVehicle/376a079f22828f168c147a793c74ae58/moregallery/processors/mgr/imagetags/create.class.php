<?php
/**
 * Creates a mgImageTag object.
 */
class mgImageTagCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'mgImageTag';
    public $languageTopics = array('reviews:default');
    public $permission = array('moregallery_view_gallery' => true, 'moregallery_image_tags' => true);

    /**
     * Before setting, check the value for "tag".
     * @return bool
     */
    public function beforeSet() {
        $tag = (string)$this->getProperty('tag', '');
        $tag = trim($tag);
        if ($tag === '') {
            return $this->modx->lexicon('moregallery.tags.cant_be_empty');
        }
        if (!is_numeric($tag)) {
            $tagObj = $this->modx->getObject('mgTag', array(
                'display' => $tag
            ));
            if ($tagObj) {
                $this->setProperty('tag', $tagObj->get('id'));
            }
            else {
                if (!$this->modx->context->checkPolicy('moregallery_image_tags_new')) {
                    return $this->modx->lexicon('permission_denied');
                }

                $tagObj = $this->modx->newObject('mgTag');
                $tagObj->fromArray(array(
                    'display' => $tag,
                    'createdon' => time(),
                    'createdby' => ($this->modx->user) ? $this->modx->user->get('id') : 0,
                ));
                if ($tagObj->save()) {
                    $this->setProperty('tag', $tagObj->get('id'));

                    $this->modx->invokeEvent('MoreGallery_OnTagCreate',
                        array(
                            'id' => $this->object->get('id'),
                            'tag' => $tag,
                            'object' => &$this->object,
                        )
                    );
                }
                else {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error saving new mgTag object: ' . $tagObj->toJSON());
                    return false;
                }
            }
        }

        return parent::beforeSet();
    }

    /**
     * Return the success message
     * @return array
     */
    public function cleanup() {
        $obj = $this->object->toArray();
        $tag = $this->object->getOne('Tag');
        if ($tag) {
            $obj = array_merge($obj, $tag->toArray('tag_'));

            $this->modx->invokeEvent('MoreGallery_OnImageTagCreate',
                array(
                    'id' => $this->object->get('id'),
                    'tag' => $tag,
                    'object' => &$this->object,
                )
            );
        }
        return $this->modx->toJSON($obj);
    }

}
return 'mgImageTagCreateProcessor';
