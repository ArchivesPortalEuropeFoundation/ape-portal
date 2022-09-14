<?php
require_once __DIR__ . '/mgvideo.class.php';

/**
 * Class mgYouTubeVideo
 */
class mgYouTubeVideo extends mgVideo {
    public $service = 'youtube';
    protected $info = array();

    /**
     * Returns the Video ID from the properties.
     *
     * @return string
     */
    public function getVideoID()
    {
        return $this->getProperty('video_id', '');
    }

    /**
     * Returns a standard URL for YouTube thumbnails.
     *
     * @param string $size
     * @return string
     */
    public function getYouTubeThumbnailUrl($size = 'hqdefault')
    {
        $videoId = $this->getVideoID();
        return "https://i1.ytimg.com/vi/{$videoId}/{$size}.jpg";
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
<iframe class="moregallery-embed moregallery-embed-youtube" width="640" height="390"
  src="https://www.youtube.com/embed/{$videoId}" frameborder="0"></iframe>
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

            if ($this->xpdo->moregallery->getOption('moregallery.youtube_prefill_description', null, false)) {
                $this->set('description', $info['description']);
            }

            $this->set('width', 0);
            $this->set('height', 0);

            return $this->save();
        }
        return false;
    }

    /**
     * Downloads the thumbnail from YouTube and caches it locally.
     *
     * @param string $name The proper name to use for the file (no extension) based on the video or something
     * @return bool|string
     */
    public function loadFile($name)
    {
        $imageIdPlacement = $this->xpdo->moregallery->getOption('moregallery.image_id_in_name', null, 'prefix', true);
        $id = $this->get('id');
        $name = $this->xpdo->moregallery->sanitizeFileName($name);

        $url = $this->getYouTubeThumbnailUrl();

        $ext = '.' . pathinfo($url, PATHINFO_EXTENSION);
        if ($imageIdPlacement === 'prefix') {
            $name = $id . '_' . $name . $ext;
        }
        elseif ($imageIdPlacement === 'suffix') {
            $name = pathinfo($name, PATHINFO_FILENAME);
            $name = $name . '_' . $id . $ext;
        }

        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            // grab the thumbnail from youtube
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
     * Loads the video meta data from the local cache (in properties) if available, otherwise
     * from the YouTube API using a standard API Key.
     *
     * @return array|null
     */
    public function getVideoInfo()
    {
        if (empty($this->info)) {
            $info = $this->getProperty('_youtube_info');
            if (is_array($info)) {
                $this->info = $info;
            }
        }

        if (empty($this->info)) {
            $id = $this->getVideoID();
            $key = $this->xpdo->getOption('googleapis_public_key', null, 'AIzaSyB0dw388ateBJGR-wIGxPTWtJUmDx55gKw', true);
            $data = $this->_getUrl("https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$id}&key={$key}");
            $json = json_decode($data, true);
            if (is_array($json) && $json['pageInfo']['resultsPerPage'] > 0) {
                $this->info = $this->cleanInvalidData($json['items'][0]['snippet']);
                $this->setProperty('_youtube_info', $this->info);
            }
            else {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error loading video info from YouTube for video ' . $id . ' : ' . $data);
            }
        }

        return $this->info;
    }

}