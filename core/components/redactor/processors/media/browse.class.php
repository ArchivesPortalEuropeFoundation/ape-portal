<?php
require_once dirname(__FILE__).'/browsefiles.class.php';
/**
 * Choose Redactor Images.
 *
 * @param string $file The absolute path of the file
 * @param string $name Will rename the file if different
 * @param string $content The new content of the file
 *
 * @package modx
 * @subpackage processors.browser.file
 */
class RedactorMediaBrowserProcessor extends RedactorFileBrowserProcessor {
    public $dynamicThumbs = true;
    public $displayImageNames = false;
    public $browsePath = 'image_browse_path';
    public $uploadPath = 'image_upload_path';
    public $browseWarn = 'redactor.browse_warning';
    
    public function initialize() {
        $this->dynamicThumbs     = (bool)$this->modx->getOption('redactor.dynamicThumbs', null, true);
        $this->displayImageNames = (bool)$this->modx->getOption('redactor.displayImageNames', null, false);
	    return parent::initialize();
    }
    
    
    protected function handleFile($image,&$files = array()) {
        $modAuth = $this->modx->user->getUserToken('mgr');
        $imageUrlAbsolute = isset($image['urlAbsolute']) ? $image['urlAbsolute'] : $image['url']; // #janky fix for s3
        if ($this->patch_11291) $imageUrlAbsolute = $this->removeDuplicatePaths($image,$imageUrlAbsolute);
        $thumbQuery = http_build_query(array(
            'src' => $imageUrlAbsolute,
            'w' => 360,
            'h' => 270,
            'HTTP_MODAUTH' => $modAuth,
            //'f' => $thumbnailType,
            'q' => 80,
            'wctx' => 'mgr',
            'zc' => 1
            //'source' => $this->get('id'),
        ));
        
        if($this->browseRecursive && $image['type'] == 'dir') { /* back to the end of the line buddy */
            $files = $this->addFiles($image['pathRelative'],$files);  
        }
        elseif($image['type'] == 'file') {
            $thumb = $this->modx->getOption('connectors_url') . 'system/phpthumb.php?'.urldecode($thumbQuery);
            $json = array(
                'thumb' => ($this->dynamicThumbs) ? $thumb : $imageUrlAbsolute,
                'image' => $imageUrlAbsolute,
                'title' => $image['id'],
                'extension' => pathinfo($imageUrlAbsolute, PATHINFO_EXTENSION),
                'figcaption' => ($this->displayImageNames) ? true : null,
                'filename' => pathinfo($imageUrlAbsolute, PATHINFO_FILENAME) . '.' . pathinfo($imageUrlAbsolute, PATHINFO_EXTENSION)
            );
            if ($this->browseRecursive) $json['folder'] = dirname($image['pathRelative']);
            $files[] = $json;
        }
    }
    

}
return 'RedactorMediaBrowserProcessor';
