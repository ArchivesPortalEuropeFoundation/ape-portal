<?php
/**
 * Class mgImageTag
 */
class mgImageTag extends xPDOSimpleObject {
    /**
     * Clear cache when removing a relation.
     *
     * @param array $ancestors
     *
     * @return bool
     */
    public function remove (array $ancestors = array ()) {
        $removed = parent::remove($ancestors);
        $this->clearCache();
        return $removed;
    }

    /**
     * @param null $cacheFlag
     *
     * @return bool
     */
    public function save($cacheFlag= null) {
        $saved = parent::save($cacheFlag);
        $this->clearCache();
        return $saved;
    }

    /**
     * Clear the necessary caches when changing an mgImageTag record.
     */
    public function clearCache() {
        $cacheOptions = array(
            xPDO::OPT_CACHE_KEY => 'moregallery',
            'multiple_object_delete' => true,
        );
        $resource = $this->get('resource');

        $this->xpdo->cacheManager->delete('single-image/'.$resource.'/', $cacheOptions);
        $this->xpdo->cacheManager->delete('image-collection/'.$resource.'/', $cacheOptions);
        $this->xpdo->cacheManager->delete('mgimage/'.$resource.'/', $cacheOptions);
        $this->xpdo->cacheManager->delete('mgimages/'.$resource.'/', $cacheOptions);
        $this->xpdo->cacheManager->delete('tags/image/'.$this->get('image'), $cacheOptions);
    }
}
