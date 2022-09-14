<?php
/**
 * Class mgTag
 */
class mgTag extends xPDOSimpleObject {
    /**
     * Override to set the createdon and createdby fields for new mgTag objects.
     * Also clears Tags cache.
     *
     * @param null $cacheFlag
     * @return bool
     */
    public function save($cacheFlag= null) {
        if ($this->isNew()) {
            $this->set('createdon', time());
            if ($this->xpdo->user && $this->xpdo->user->get('id') > 0) {
                $this->set('createdby', $this->xpdo->user->get('id'));
            }
        }
        $saved = parent::save($cacheFlag);
        $this->clearCache();
        return $saved;
    }
    /**
     * Clear cache when removing a tag.
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
     * Clear the necessary caches when changing an mgTag record.
     */
    public function clearCache() {
        $cacheOptions = array(
            xPDO::OPT_CACHE_KEY => 'moregallery',
            'multiple_object_delete' => true,
        );
        $this->xpdo->cacheManager->delete('tags/', $cacheOptions);
    }
}
