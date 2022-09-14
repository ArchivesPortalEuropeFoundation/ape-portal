<?php
/**
 * Gets a list of mgTag objects.
 */
class mgTagGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'mgTag';
    public $defaultSortField = 'display';
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
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'display:LIKE' => "%{$query}%"
            ));
        }
        return $c;
    }

    /**
     * @param mgTag|xPDOObject $object
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
return 'mgTagGetListProcessor';
