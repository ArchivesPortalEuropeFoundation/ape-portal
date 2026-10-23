<?php
// Compatibility between 2.x/3.x for extending the source getlist processor
if (file_exists(MODX_PROCESSORS_PATH . 'source/getlist.class.php')) {
    require_once MODX_PROCESSORS_PATH . 'source/getlist.class.php';
}
elseif (!class_exists('modMediaSourceGetListProcessor')) {
    class_alias(\MODX\Revolution\Processors\Source\GetList::class, \modMediaSourceGetListProcessor::class);
}

class RedactorMediaSourcesProcessor extends modMediaSourceGetListProcessor
{
    public function initialize() {
        $initialized = parent::initialize();
        $this->setProperty('limit', 0);
        return $initialized;
    }

    public function prepareRow(xPDOObject $object) {
        $objectArray = $object->get(array('id', 'name'));
        return $objectArray;
    }
}

return 'RedactorMediaSourcesProcessor';