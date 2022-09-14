<?php
require_once __DIR__ . '/mgvideo.class.php';

/**
 * Class mgVimeoVideo
 */
class mgVimeoVideo extends mgVideo {
    public $service = 'vimeo';
    protected $info = array();

    public function getVideoID()
    {
        return $this->getProperty('video_id', '');
    }

    public function getVimeoThumbnailUrl()
    {
        $info = $this->getVideoInfo();
        return $info['thumbnail_url'];
    }

    /**
     * Generates the embed code for in the manager from the Video ID.
     *
     * @return string
     */
    public function getManagerEmbed()
    {
        $videoId = $this->getVideoID();

        $embed = <<<HTML
    <iframe class="moregallery-embed moregallery-embed-vimeo" src="//player.vimeo.com/video/{$videoId}" width="640" height="390" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
HTML;

        return $embed;
    }

    /**
     * Loads meta data for the video and inserts it into the object.
     */
    public function loadMetaInformation()
    {
        $info = $this->getVideoInfo();
        if (!empty($info)) {
            $title = $info['title'];
            $file = $this->loadFile($title);
            $this->set('file', $file);
            $this->set('filename', $this->service . ':' . $this->getVideoID());
            $this->set('name', $title);

            if ($this->xpdo->moregallery->getOption('moregallery.vimeo_prefill_description', null, false)) {
                $this->set('description', $info['description']);
            }

            $this->set('width', 0);
            $this->set('height', 0);
            return true;
        }
        return false;
    }

    /**
     * Downloads the thumbnail from Vimeo and caches it locally.
     *
     * @param string $name The proper name to use for the file (no extension) based on the video or something
     * @return bool|string
     */
    public function loadFile($name)
    {
        $imageIdPlacement = $this->xpdo->moregallery->getOption('moregallery.image_id_in_name', null, 'prefix', true);
        $id = $this->get('id');
        $name = $this->xpdo->moregallery->sanitizeFileName($name);

        $url = $this->getVimeoThumbnailUrl();

        $ext = '.' . pathinfo($url, PATHINFO_EXTENSION);
        if ($imageIdPlacement === 'prefix') {
            $name = $id . '_' . $name . $ext;
        }
        elseif ($imageIdPlacement === 'suffix') {
            $name = pathinfo($name, PATHINFO_FILENAME);
            $name .= $ext . $id . '_';
        }

        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            // grab the thumbnail from Vimeo
            $contents = $this->_getUrl($url);

            // save it to the local system
            $relativeUrl = $resource->getSourceRelativeUrl();
            $resource->source->errors = array();
            $resource->source->createObject($relativeUrl, $name, $contents);
            if ($resource->source->hasErrors()) {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error creating file for video '. $id . ': ' . print_r($resource->source->getErrors(), true));
            }

            return $name;
        }

        return false;
    }

    /**
     * Fetches information about the video from Vimeo or from a local cache. This uses the oembed API.
     *
     * @return array
     */
    public function getVideoInfo()
    {
        if (empty($this->info)) {
            $info = $this->getProperty('_vimeo_info');
            if (is_array($info)) {
                $this->info = $info;
            }
        }

        if (empty($this->info)) {
            $id = $this->getVideoID();
            if ($this->xpdo->getOption('moregallery.vimeo_provide_referer', null, true)) {
                $data = $this->_getOembedWithReferer("https://vimeo.com/api/oembed.json?url=https://vimeo.com/{$id}");
            }
            else {
                $data = $this->_getUrl("https://vimeo.com/api/oembed.json?url=https://vimeo.com/{$id}");
            }
            $json = json_decode($data, true);
            if (is_array($json)) {
                $this->info = $json;
                $this->setProperty('_vimeo_info', $this->info);
            }
            else {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error loading video info from Vimeo for video ' . $id . ' : ' . $data);
            }
        }

        return $this->info;
    }

    protected function _getOembedWithReferer($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $this->xpdo->getOption('site_url'));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}