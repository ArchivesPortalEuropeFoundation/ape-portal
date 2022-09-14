<?php

require_once MODX_CORE_PATH . 'model/modx/modprocessor.class.php';
require_once MODX_CORE_PATH . 'model/modx/processors/resource/update.class.php';

/**
 * @package moreGallery
 */
class mgResourceUpdateProcessor extends modResourceUpdateProcessor {
    public function handleResourceProperties() {
        parent::handleResourceProperties();

        $properties = $this->getProperties();
        $props = array();
        foreach ($properties as $key => $value) {
            if (substr($key, 0, strlen('properties_')) == 'properties_') {
                $props[substr($key, strlen('properties_'))] = $value;
            }
        }
        $this->object->setProperties($props, 'moregallery', true);
    }
}

return 'mgResourceUpdateProcessor';
