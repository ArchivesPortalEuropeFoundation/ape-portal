<?php

/**
 * @package moreGallery
 *
 * @property mgImage $object
 */
class mgImageUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'mgImage';
    public $permission = array('moregallery_view_gallery' => true, 'moregallery_image_edit' => true);

    /**
     * Unset bunch of properties we don't want touched.
     *
     * @return bool
     */
    public function beforeSet()
    {
        $this->unsetProperty('mgr_thumb');
        $this->unsetProperty('file_url');
        $this->unsetProperty('exif');

        $active = $this->getProperty('active');
        if (!is_bool($active)) {
            $active = ($active === 'true');
            $this->setProperty('active', $active);
        }
        if ($this->getProperty('active') != $this->object->get('active')) {
            if (!$this->modx->context->checkPolicy('moregallery_image_active')) {
                return $this->modx->lexicon('permission_denied');
            }
        }

        if ($this->modx->context->checkPolicy('moregallery_image_crop_edit')) {
            $crops = $this->getProperty('crops');
            $crops = $this->modx->fromJSON($crops);
            if (is_array($crops)) {
                $cropObjects = $this->object->getCrops();
                foreach ($crops as $name => $values) {
                    if (isset($cropObjects[$name])) {
                        $cropObjects[$name]->fromArray($values);
                        if (!empty($cropObjects[$name]->_dirty)) {
                            $cropObjects[$name]->save();
                        }
                    }
                }
                $this->setProperty('crops', $crops);
            }
        }

        $this->setProperty('editedon', time());
        $this->setProperty('editedby', $this->modx->user ? $this->modx->user->get('id') : 0);

        if ($this->getProperty('checked') === 'true') {
            $this->setProperty('checked', true);
        }
        else {
            $this->setProperty('checked', false);
        }

        return parent::beforeSet();
    }


    /**
     * Return the success message
     * @return array
     */
    public function cleanup()
    {
        $array = $this->object->toArray();
        unset($array['action'], $array['cid'],
            $array['exif'], $array['exif_dump'], $array['exif_json'],
            $array['iptc'], $array['iptc_dump'], $array['iptc_json']);
        $array['crops'] = $this->modx->toJSON($this->object->getCropsAsArray());
        return $this->modx->toJSON($array);
    }
}

return 'mgImageUpdateProcessor';
