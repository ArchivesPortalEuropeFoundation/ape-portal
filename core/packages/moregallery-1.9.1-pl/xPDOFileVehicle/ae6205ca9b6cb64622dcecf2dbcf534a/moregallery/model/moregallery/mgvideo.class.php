<?php
require_once __DIR__ . '/mgimage.class.php';

/**
 * Class mgVideo
 *
 * Extends the mgImage class with video specific info.
 */
class mgVideo extends mgImage {
    public $service = 'video';

    /**
     * @param string $keyPrefix
     * @param bool $rawValues
     * @param bool $excludeLazy
     * @param bool $includeRelated
     *
     * @return array
     */
    public function toArray($keyPrefix= '', $rawValues= false, $excludeLazy= false, $includeRelated= false)
    {
        $array = parent::toArray($keyPrefix, $rawValues, $excludeLazy, $includeRelated);
        if (!$rawValues) {
            $array[$keyPrefix . 'video_id'] = $this->getProperty('video_id');
            $array[$keyPrefix . 'service'] = $this->service;
        }

        return $array;
    }

    /**
     * Loads meta data for the video and inserts it into the object.
     */
    public function loadMetaInformation()
    {
        $this->set('filename', 'n/a');
        $this->set('name', 'n/a');
        $this->set('width', 0);
        $this->set('height', 0);
    }

    protected function _getUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}