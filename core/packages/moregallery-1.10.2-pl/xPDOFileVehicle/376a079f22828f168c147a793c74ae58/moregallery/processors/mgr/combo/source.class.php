<?php
/**
 * Gets a list of mgImage objects.
 */
class ComboSourceGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modMediaSource';
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';

    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array('file','moregallery:default');
    }

    /**
     * @param modMediaSource|xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $array = array(
            'value' => $object->get('id'),
            'display' => $object->get('name'),
            'description' => $object->get('description')
        );
        return $array;
    }

    /**
     * @param array $array
     * @param bool $count
     *
     * @return string
     */
    public function outputArray(array $array,$count = false) {
        array_unshift($array, array(
            'value' => 'inherit',
            'display' => $this->modx->lexicon('moregallery.inherit'),
            'description' => $this->modx->lexicon('moregallery.inherit.desc'),
        ));
        return parent::outputArray($array, $count);
    }
}
return 'ComboSourceGetListProcessor';
