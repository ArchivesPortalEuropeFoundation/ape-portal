<?php
/**
 * Gets a list of mgImageTag objects.
 */
class mgImageTagGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'mgImageTag';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';

    /**
     * @return bool
     */
    public function beforeQuery() {
        $this->setProperty('limit', 0);
        return true;
    }

    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c->innerJoin('mgTag', 'Tag');
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
        $c->select($this->modx->getSelectColumns('mgTag', 'Tag', 'tag_'));

        $resource = $this->getProperty('resource');
        if (!empty($resource)) {
            $c->where(array(
                'resource' => $resource
            ));
        }
        $image = $this->getProperty('image');
        if (!empty($image)) {
            $c->where(array(
                'image' => $image
            ));
        }

        return $c;
    }

    /**
     * @param mgImageTag|xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $array = $object->toArray('', false, true);
        return $array;
    }

    /**
     * @param array $array
     * @param bool $count
     *
     * @return string
     */
    public function outputArray(array $array,$count = false) {
        return $this->modx->toJSON($array);
    }
}
return 'mgImageTagGetListProcessor';
