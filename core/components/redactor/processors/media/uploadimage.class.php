<?php
require_once 'upload.class.php';
/**
 * Uploads a Redactor Image.
 * This class was developed by JP DeVries over an undisclosed amount of time.
 *
 * @param string $file The absolute path of the file
 * @param string $name Will rename the file if different
 * @param string $content The new content of the file
 *
 * @package modx
 * @subpackage processors.browser.file
 */
class RedactorMediaImageUploadProcessor extends RedactorMediaUploadProcessor {
    /** @var modMediaSource|modFileMediaSource $source */
    public $hash_option = 'redactor.date_images';
    public $target_path = 'image_upload_path';
    public $target_path_default = 'assets/uploads/';
}
return 'RedactorMediaImageUploadProcessor';
