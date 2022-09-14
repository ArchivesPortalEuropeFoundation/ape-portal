<?php
use modmore\Alpacka\Snippet;
use modmore\Alpacka\Properties\SimpleProperty;
use modmore\Alpacka\Properties\BooleanProperty;
use modmore\Alpacka\Properties\EnumProperty;

/**
 * Class GetImagesSnippet
 *
 * Gets a collection of images and videos.
 *
 * @property moreGallery $service
 */
class GetImages extends Snippet {
    protected $resourceFields = array(
        'id', 'alias', 'uri', 'uri_override',
        'pagetitle', 'longtitle', 'menutitle',
        'description', 'introtext', 'link_attributes',
        'parent', 'context_key', 'template', 'class_key', 'content_type',
        'published', 'pub_date', 'unpub_date', 'publishedon', 'publishedby',
        'isfolder', 'richtext', 'searchable', 'cacheable', 'deleted', 'hide_children_in_tree', 'show_in_tree',
        'createdby', 'createdon', 'editedby', 'editedon', 'deletedby', 'deletedon',
    );
    protected $cacheOptions = array(
        xPDO::OPT_CACHE_KEY => 'moregallery'
    );

    /** @var modResource[] */
    protected $_resources = array();
    /** @var array[] */
    protected $_resourceData = array();
    protected $chunkHash = '';
    protected $_idx = 0;
    protected $singleImageParam = '';

    /**
     * The available properties for this snippet.
     *
     * @return array
     */
    public function getPropertiesDefinition()
    {
        return array(
            'cache' => new BooleanProperty(true),
            'resource' => new SimpleProperty(0),
            'activeOnly' => new BooleanProperty(true),
            'sortBy' => new SimpleProperty('sortorder'),
            'sortDir' => new EnumProperty('ASC', array('ASC', 'DESC')),
            'where' => new SimpleProperty(),

            'tags' => new SimpleProperty(),
            'tagsFromUrl' => new SimpleProperty(),
            'tagSeparator' => new SimpleProperty("\n"),

            'getTags' => new BooleanProperty(true),
            'getResourceContent' => new BooleanProperty(false),
            'getResourceProperties' => new BooleanProperty(false),
            'getResourceFields' => new BooleanProperty(false),
            'getResourceTVs' => new SimpleProperty(),

            'tagTpl' => new SimpleProperty('mgtag'),
            'imageTpl' => new SimpleProperty('mgimage'),
            'mediaTpl' => new SimpleProperty(''),
            'youtubeTpl' => new SimpleProperty('mgYoutube'),
            'vimeoTpl' => new SimpleProperty('mgVimeo'),
            'pdfTpl' => new SimpleProperty(''),
            'imageSeparator' => new SimpleProperty("\n"),
            'singleImageTpl' => new SimpleProperty('mgimagesingle'),
            'singleMediaTpl' => new SimpleProperty(''),
            'singleYoutubeTpl' => new SimpleProperty('mgYoutubeSingle'),
            'singleVimeoTpl' => new SimpleProperty('mgVimeoSingle'),
            'singlePdfTpl' => new SimpleProperty('mgPdfSingle'),
            'singleImageEnabled' => new BooleanProperty(true),
            'singleImageParam' => new SimpleProperty(),
            'singleImageResource' => new SimpleProperty(0),
            'wrapperTpl' => new SimpleProperty(),
            'wrapperIfEmpty' => new BooleanProperty(true),
            'toPlaceholder' => new SimpleProperty(),

            'limit' => new SimpleProperty(0),
            'offset' => new SimpleProperty(0),
            'totalVar' => new SimpleProperty('total'),

            'scheme' => new SimpleProperty($this->service->getOption('link_tag_scheme')),

            'debug' => new BooleanProperty(false),
            'timing' => new BooleanProperty(false),

            'showCollectedData' => new BooleanProperty(false),
        );
    }

    public function initialize()
    {
        $resourceId = $this->getProperty('resource');
        if ($resourceId < 1 && $this->modx->resource) {
            $resourceId = $this->modx->resource->get('id');
            $this->setProperty('resource', $resourceId);
        }

        // Get the singleImageParam property and default it to the setting if empty
        $singleImageParam = $this->getProperty('singleImageParam');
        if (empty($singleImageParam)) {
            $singleImageParam = $this->service->getOption('moregallery.single_image_url_param');
        }
        $this->singleImageParam = $singleImageParam;

        $context = 'web';
        if ($resourceId > 0) {
            if ($this->modx->resource && $this->modx->resource->get('id') == $resourceId) {
                $context = $this->modx->resource->get('context_key');
            }
            else {
                $resource = $this->modx->getObject('modResource', (int)$resourceId);
                if ($resource instanceof modResource) {
                    $context = $resource->get('context_key');
                }
            }
        }
        $this->debug('Setting working context to ' . $context);
        $this->service->setWorkingContext($context);
    }

    /**
     * @return string
     */
    public function process()
    {
        if ($this->getProperty('showCollectedData')) {
            $consent = (int)$this->service->getOption('moregallery.data_consent');
            $data = $this->service->_getShareData($consent);
            $data = json_encode(json_decode($data, true), JSON_PRETTY_PRINT);
            return '<pre>' . $data . '</pre>';
        }

        $this->initialize();

        if (array_key_exists($this->singleImageParam, $_REQUEST)) {
            $this->debug('URL parameter "' . $this->singleImageParam . '" exists on $_REQUEST, so showing single image.');
            return $this->getSingleImage((int)$_REQUEST[$this->singleImageParam]);
        }
        $this->debug('No URL parameter ' . $this->singleImageParam . ' exists on $_REQUEST, so showing image collection.');
        return $this->getImageCollection();
    }

    /**
     * Returns image $imageId, from cache if possible.
     *
     * @param $imageId
     * @return string
     * @throws \modmore\Alpacka\Exceptions\InvalidPropertyException
     */
    public function getSingleImage($imageId)
    {
        // Try to load from cache first
        $cacheKey = 'single-image/' . $this->getProperty('resource') . '/' . $imageId . '_' . $this->getPropertyHash() . '_' . $this->getChunkHash();
        if ($this->getProperty('cache')) {
            $cached = $this->modx->cacheManager->get($cacheKey, $this->cacheOptions);
            if (is_array($cached)) {
                $this->debug('Loaded single image ' . $imageId . ' from cache using cacheKey ' . $cacheKey);
                return $this->finish($cached['formatted']);
            }
        }

        // No cache available, so fetch it from the database.
        $filter = array(
            'id' => $imageId,
            'resource' => $this->getProperty('resource'),
        );
        if ($this->getProperty('activeOnly')) {
            $filter['active'] = true;
        }
        /** @var mgImage $image */
        $image = $this->modx->getObject('mgImage', $filter);

        // If the image can't be found, we send the user to the error page.
        // @todo Consider redirecting the user to the "parent" page (i.e. current page without &iid url param) instead?
        if (!$image) {
            $this->debug('Image not found with filter' . print_r($filter, true));
            $this->modx->sendErrorPage();
        }

        $this->debug('Image loaded, now loading all placeholders.');
        // Turn the image into placeholders, including previous and next images.
        $phs = $this->getImagePlaceholders($image, true);

        // Format it
        $tpl = $this->determineSingleTpl($phs);
        $this->debug('Formatting image with chunk ' . $tpl);
        $formatted = $this->service->getChunk($tpl, $phs);

        // If cache is enabled, write the data to the proper cache file.
        if ($this->getProperty('cache')) {
            $cached = array(
                'placeholders' => $phs,
                'formatted' => $formatted,
            );
            $this->debug('Caching image information and formatted output to cacheKey ' . $cacheKey);
            $this->modx->cacheManager->set($cacheKey, $cached, 0, $this->cacheOptions);
        }

        return $this->finish($formatted);
    }

    /**
     *
     *
     * @return string
     * @throws \modmore\Alpacka\Exceptions\InvalidPropertyException
     */
    public function getImageCollection()
    {
        // Set the tags propery to include tags from the URL, so that the cacheKey is updated when tags change
        $this->setProperty('tags', $this->getTags());
        $random = in_array(strtolower($this->getProperty('sortBy')), array('random', 'rand', 'rand()'), true);
        $limit = $this->getProperty('limit');


        // Try to load from cache
        $cacheKey = 'image-collection/' . $this->getProperty('resource') . '/' . $this->getPropertyHash() . '_' . $this->getChunkHash();
        if ($this->getProperty('cache')) {
            $cached = $this->modx->cacheManager->get($cacheKey, $this->cacheOptions);
            if (is_array($cached)) {
                $this->debug('Loaded image collection from cache using cacheKey ' . $cacheKey);

                $formatted = $cached['formatted'];

                if ($random && array_key_exists('result_set', $cached)) {
                    $this->debug('Randomising and parsing result set from cache.');
                    shuffle($cached['result_set']);

                    if ($limit > 0) {
                        $this->debug('Limiting result set to ' . $limit);
                        $cached['result_set'] = array_slice($cached['result_set'], 0, $limit);
                    }

                    $formatted = $this->parseCollection($cached['result_set'], $cached['total']);
                }

                $this->modx->setPlaceholder($this->getProperty('totalVar'), $cached['total']);

                return $this->finish($formatted);
            }
        }

        $this->debug('Preparing SQL query to retrieve images and related data.');

        $c = $this->modx->newQuery('mgImage');
        $c->distinct(true);

        $resource = $this->getProperty('resource');
        if (strpos($resource, ',') !== false) {
            $c->where(array(
                'resource:IN' => explode(',', $resource),
            ));
        }
        else {
            $c->where(array(
                'resource' => $resource,
            ));
        }

        if ($this->getProperty('activeOnly')) {
            $c->where(array(
                'active' => true,
            ));
        }

        $customCondition = $this->getProperty('where');
        if (!empty($customCondition)) {
            $customConditionArray = json_decode($customCondition, true);
            if (is_array($customConditionArray)) {
                $c->where($customConditionArray);
            }
            else {
                $this->debug('WARNING: Custom condition ' . $customCondition . ' is not valid JSON.');
            }
        }

        $this->addTagsCondition($c);

        // Get the total and make it available for getPage support
        $this->debug('Fetching total count for query');
        $total = $this->modx->getCount('mgImage', $c);
        $this->debug('Total results: ' . $total);
        $this->modx->setPlaceholder($this->getProperty('totalVar'), $total);

        // Apply the limit if we're not using a random sort
        if (!$random && $limit > 0) {
            $c->limit($limit, $this->getProperty('offset'));
        }

        // Apply sorting if this isn't a random sort
        if (!$random) {
            $c->sortby($this->getProperty('sortBy'), $this->getProperty('sortDir'));
        }
        else {
            $c->sortby('RAND()');
        }

        if ($this->getProperty('debug')) {
            $c->prepare();
            $this->debug('Executing query: ' . $c->toSQL());
        }

        // Loop over the images and put them into $data
        $data = array();
        $i = 0;
        $this->debug('Iterating over images');
        /** @var mgImage[] $iterator */
        $iterator = $this->modx->getIterator('mgImage', $c);
        foreach ($iterator as $image) {
            $phs = $this->getImagePlaceholders($image);
            $data[$i] = $phs;

            // Add prev and next options
            if (isset($data[$i - 1])) {
                $data[$i]['prev'] = $data[$i - 1];
                $data[$i - 1]['next'] = $phs;
                // Prevent some sort of recursive array
                unset($data[$i]['prev']['prev']);
            }
            $i++;
        }

        // If we're dealing with random images, the limit wasn't applied to the SQL query.
        // So we splice it here.
        $fullResultSet = $data;
        if ($random && $limit > 0) {
            $this->debug('Splicing result set for random sort');
            $data = array_splice($data, 0, $limit);
        }

        $this->debug('Parsing image collection');
        // Loop over the items and parse them through the imageTpl
        $formatted = $this->parseCollection($data, $total);

        // If cache is enabled, write the data to the proper cache file.
        if ($this->getProperty('cache')) {
            $this->debug('Caching formatted and raw results to ' . $cacheKey);
            $cached = array(
                'total' => $total,
                'formatted' => $formatted,
                'result_set' => $fullResultSet,
            );
            $this->modx->cacheManager->set($cacheKey, $cached, 0, $this->cacheOptions);
        }

        return $this->finish($formatted);
    }


    /**
     * Turns an image object into placeholders, including loading related data (crops, tags, url, resource stuff).
     *
     * @param mgImage $image
     * @param bool $previousAndNext
     * @return array
     */
    public function getImagePlaceholders(mgImage $image, $previousAndNext = false)
    {
        // Start collecting all placeholders with just the standard image info.
        $phs = $image->toArray();

        $phs['idx'] = $this->_idx;
        $this->_idx++;
        $phs['idx1'] = $this->_idx;

        // Get the crops for the image
        $phs['crops'] = $image->getCropsAsArray();

        // Process the url placeholder into a link tag
        if (is_numeric($phs['url']) && $phs['url'] > 0) {
            $phs['url'] = '[[~' . $phs['url'] . ']]';
        }

        // Generate a view_url placeholder for a detail page
        $singleImageResource = $this->getProperty('singleImageResource');
        if ($singleImageResource < 1) {
            $singleImageResource = $phs['resource'];
        }
        $phs['view_url'] = $this->modx->makeUrl($singleImageResource, '', array(
            $this->singleImageParam => $image->get('id'),
        ), $this->getProperty('scheme'));

        // If requested, load all the resource fields
        if ($this->getProperty('getResourceFields')) {
            $phs = array_merge($phs,  $this->getResourceFields($image->get('resource')));
        }

        if ($previousAndNext) {
            $previous = $image->getPrevious($this->getProperty('sortBy'), $this->getProperty('activeOnly'));
            if ($previous instanceof mgImage) {
                $phs['prev'] = $previous->toArray();
                if (is_numeric($phs['prev']['url']) && $phs['prev']['url'] > 0) {
                    $phs['prev']['url'] = '[[~' . $phs['prev']['url'] . ']]';
                }
                $phs['prev']['view_url'] = $this->modx->makeUrl($singleImageResource, '', array(
                    $this->singleImageParam => $previous->get('id'),
                ), $this->getProperty('scheme'));
                $phs['prev']['crops'] = $previous->getCropsAsArray();
            }

            $next = $image->getNext($this->getProperty('sortBy'), $this->getProperty('activeOnly'));
            if ($next instanceof mgImage) {
                $phs['next'] = $next->toArray();
                if (is_numeric($phs['next']['url']) && $phs['next']['url'] > 0) {
                    $phs['next']['url'] = '[[~' . $phs['next']['url'] . ']]';
                }
                $phs['next']['view_url'] = $this->modx->makeUrl($singleImageResource, '', array(
                    $this->singleImageParam => $next->get('id'),
                ), $this->getProperty('scheme'));
                $phs['next']['crops'] = $next->getCropsAsArray();
            }

            // If the sortorder is descending, we need to swap out prev and next placeholders to keep things in order
            if ($this->getProperty('sortDir') === 'DESC') {
                $prev = isset($phs['prev']) ? $phs['prev'] : null;
                $phs['prev'] = isset($phs['next']) ? $phs['next'] : null;
                $phs['next'] = $prev;
            }
        }

        if ($this->getProperty('getTags')) {
            $phs['tags_raw'] = $image->getTags();
            $phs['tags'] = array();
            foreach ($phs['tags_raw'] as $tag) {
                $phs['tags'][] = $this->service->getChunk($this->getProperty('tagTpl'), $tag);
            }
            $phs['tags'] = implode($this->getProperty('tagSeparator'), $phs['tags']);
        }

        // Return it
        return $phs;
    }

    /**
     * Returns an array of resource fields (if the resource can be loaded, otherwise an empty array)
     *
     * @param $resourceId
     * @return array
     */
    public function getResourceFields($resourceId)
    {
        // See if we already have the resource data available as an array, if so return it.
        if (array_key_exists($resourceId, $this->_resourceData)) {
            return $this->_resourceData[$resourceId];
        }

        // See if we already have the resource, if not load it.
        if (!array_key_exists($resourceId, $this->_resources)) {
            $this->_resources[$resourceId] = $this->modx->getObject('modResource', (int)$resourceId);
        }

        // Local alias just to make it easier
        $resource = $this->_resources[$resourceId];

        // Make sure it's a modResource and then grab the data
        if ($resource instanceof modResource) {
            $data = $resource->get($this->resourceFields);

            // Only get the content if specifically requested
            if ($this->getProperty('getResourceContent')) {
                $data['content'] = $resource->get('content');
            }

            // Only get the properties field if specifically requested
            if ($this->getProperty('getResourceProperties')) {
                $data['properties'] = $resource->get('properties');
            }

            // Load the TVs that the user requested
            $tvs = $this->getProperty('getResourceTVs');
            if (!empty($tvs)) {
                $tvs = explode(',', $tvs);

                foreach ($tvs as $tv) {
                    $data[$tv] = $resource->getTVValue($tv);
                }
            }

            // Prefix 'resource.' to the values so we don't have to conflict with mgImage.resource
            $data = $this->prefix($data, 'resource.');

            // Store a local copy of it so we don't have to do this over and over
            $this->_resourceData[$resourceId] = $data;

            // Return it
            return $data;
        }
        return array();
    }

    /**
     * Prefixes the data with the specified prefix.
     *
     * @param $data
     * @return array
     */
    public function prefix($data, $prefix)
    {
        $prefixed = array();
        foreach ($data as $key => $value) {
            $prefixed[$prefix . $key] = $value;
        }
        return $prefixed;
    }

    /**
     * Finishes the snippet by either returning the snippet output or by setting a requested placeholder.
     *
     * @param $formatted
     * @return string
     */
    public function finish($formatted)
    {
        $this->debug('Finished processing, outputting results.');

        if ($this->getProperty('debug')) {
            $formatted .= '<h3>Debug Information</h3><pre>' . print_r($this->_debug, true) . '</pre>';
        }

        if ($this->getProperty('timing')) {
            $time = microtime(true);
            $spent = ($time - $this->_startTime) * 1000;
            $formatted .= '<p>Finished in ' . number_format($spent, 2) . 'ms</p>';
        }

        if ($placeholder = $this->getProperty('toPlaceholder')) {
            $this->modx->setPlaceholder($placeholder, $formatted);
            return '';
        }
        return $formatted;
    }

    /**
     * Gets a comma separated list of tags. This is either the defined tags in the snippet call,
     * or provided by a $_REQUEST parameter if &tagsFromUrl is specified and filled.
     *
     * @return string
     */
    public function getTags()
    {
        $rawTags = $this->getProperty('tags');
        $param = $this->getProperty('tagsFromUrl');
        if (!empty($param) && isset($_REQUEST[$param])) {
            $rawTags = $_REQUEST[$param];
        }
        $rawTags = explode(',', $rawTags);

        // Sanitise tags
        $tags = array();
        foreach ($rawTags as $tag) {
            $tags[] = $this->modx->sanitizeString($tag);
        }

        return implode(',', $tags);
    }

    /**
     * This method adds the conditionals for tags to the collection query.
     *
     * @param xPDOQuery $c
     */
    public function addTagsCondition(xPDOQuery $c)
    {
        $allTagIds = $this->service->getTagIds();
        $tagIds = array();
        $excludedTagIds = array();

        // Loop over the requested tags to find their respective IDs
        $tags = $this->getProperty('tags');
        $tags = array_map('trim', explode(',', $tags));
        if (count($tags) > 0) {
            $this->debug('Adding conditions for tags: ' . implode(', ', $tags));
            foreach ($tags as $tag) {
                if ($tag === '') {
                    continue;
                }
                $exclude = strpos($tag, '-') === 0;
                $tag = ($exclude) ? substr($tag, 1) : $tag;
                if (is_numeric($tag)) {
                    if (!$exclude) {
                        $tagIds[] = (int)$tag;
                    } else {
                        $excludedTagIds[] = (int)$tag;
                    }
                } else {
                    $search = array_search($tag, $allTagIds, true);
                    if (is_numeric($search) && $search > 0) {
                        if (!$exclude) {
                            $tagIds[] = $search;
                        } else {
                            $excludedTagIds[] = $search;
                        }
                    }
                }
            }


            // If we have tags to include, add 'm to the query
            if (!empty($tagIds)) {
                $this->debug('Including tag IDs: ' . implode(', ', $tagIds));
                $c->leftJoin('mgImageTag', 'Tags');
                $c->where(array(
                    'Tags.tag:IN' => $tagIds,
                ));
            }

            // If we have tags to exclude, get rid of 'm
            if (!empty($excludedTagIds)) {
                $this->debug('Excluding tag IDs: ' . implode(', ', $excludedTagIds));
                $excludedTagIds = implode(',', $excludedTagIds);
                $c->where(array(
                    "NOT EXISTS (SELECT 1 FROM {$this->modx->getTableName('mgImageTag')} Tags WHERE `mgImage`.`id` = `Tags`.`image` AND `Tags`.`tag` IN ({$excludedTagIds}))"
                ));
            }
        }
    }

    /**
     * Parses collection data into markup.
     *
     * @param $data
     * @param $total
     * @return string
     */
    public function parseCollection($data, $total)
    {
        $formattedArr = array();
        foreach ($data as $phs) {
            $tpl = $this->determineTpl($phs);
            $formattedArr[] = $this->service->getChunk($tpl, $phs);
        }
        $formatted = implode($this->getProperty('imageSeparator'), $formattedArr);

        // Apply the wrapper template
        $wrapperTpl = $this->getProperty('wrapperTpl');
        if (!empty($wrapperTpl)) {
            $wrapperIfEmpty = $this->getProperty('wrapperIfEmpty');
            if (!empty($formatted) || $wrapperIfEmpty) {
                $phs = array_merge(array(
                    'output' => $formatted,
                    'image_count' => $total,
                ), $this->getResourceFields($this->getProperty('resource')));

                $formatted = $this->service->getChunk($wrapperTpl, $phs);
            }
        }

        return $formatted;
    }

    /**
     * Returns the template (chunk name) to use for this item.
     *
     * @param $data
     * @return string
     */
    public function determineTpl($data)
    {
        switch ($data['class_key']) {
            case 'mgYouTubeVideo':
            case 'mgVideo':
                return $this->getProperty('youtubeTpl');

            case 'mgVimeoVideo':
                return $this->getProperty('vimeoTpl');

            case 'mgMediaManagerImage':
                $tpl = $this->getProperty('mediaTpl');
                if ($tpl === '') {
                    $tpl = $this->getProperty('imageTpl');
                }
                return $tpl;

            case 'mgImage':
            default:
                if ($data['extension'] === 'pdf') {
                    $tpl = $this->getProperty('pdfTpl');
                    if ($tpl !== '') {
                        return $tpl;
                    }
                }
                return $this->getProperty('imageTpl');
        }
    }

    /**
     * Returns the template (chunk name) to use for a single item being displayed.
     *
     * @param $data
     * @return string
     */
    public function determineSingleTpl($data)
    {
        switch ($data['class_key']) {
            case 'mgYouTubeVideo':
            case 'mgVideo':
                return $this->getProperty('singleYoutubeTpl');

            case 'mgVimeoVideo':
                return $this->getProperty('singleVimeoTpl');

            case 'mgMediaManagerImage':
                $tpl = $this->getProperty('singleMediaTpl');
                if ($tpl === '') {
                    $tpl = $this->getProperty('singleImageTpl');
                }
                return $tpl;

            case 'mgImage':
            default:
                if ($data['extension'] === 'pdf') {
                    $tpl = $this->getProperty('singlePdfTpl');
                    if ($tpl !== '') {
                        return $tpl;
                    }
                }
                return $this->getProperty('singleImageTpl');
        }
    }

    /**
     * Generates a sha1 hash for the (unparsed) content of all chunks used by this snippet call. This is used for
     * automatically busting the relevant caches when a chunk is changed.
     *
     * @return string
     */
    public function getChunkHash()
    {
        if (empty($this->chunkHash)) {
            $props = array(
                'tagTpl',
                'imageTpl',
                'youtubeTpl',
                'vimeoTpl',
                'singleImageTpl',
                'singleYoutubeTpl',
                'singleVimeoTpl'
            );
            $chunks = array();
            foreach ($props as $tplProp) {
                $chunks[] = $this->getProperty($tplProp);
            }

            $chunks = array_unique($chunks);

            $this->debug('Calculating chunkHash (for automatic cache-busting) for chunks: ' . implode(',', $chunks));

            $c = $this->modx->newQuery('modChunk');
            $c->where(array('name:IN' => $chunks));
            $c->select($this->modx->getSelectColumns('modChunk', 'modChunk', '', array('id', 'name', 'snippet')));

            $c->prepare();
            $sql = $c->toSQL();

            $chunkContents = array();
            $result = $this->modx->query($sql);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $chunkContents[] = $row['snippet'];
            }

            $chunkContents = implode(',', $chunkContents);
            $this->chunkHash = sha1(sha1($chunkContents));

            $chunkContents = str_replace(array('[', ']'), array('&#91;', '&#93;'), htmlentities($chunkContents, ENT_QUOTES, 'utf-8'));
            $this->debug('chunkHash calculated as ' . $this->chunkHash . ' based on raw content ' . $chunkContents);
        }

        return $this->chunkHash;
    }

}