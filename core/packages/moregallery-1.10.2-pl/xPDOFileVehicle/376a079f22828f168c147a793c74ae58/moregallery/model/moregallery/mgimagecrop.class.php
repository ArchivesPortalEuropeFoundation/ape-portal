<?php
/**
 * Class mgImageCrop
 */
class mgImageCrop extends xPDOSimpleObject
{
    /**
     * Returns the URL (or path when $path is true) to the thumbnail for this crop.
     *
     * @param modMediaSource $source
     * @param string $relativeUrl
     * @param bool $returnPath
     * @return bool|string
     */
    public function getThumb(mgImage $image, modMediaSource $source, $relativeUrl = '', $returnPath = false)
    {
        $thumbnail = $this->get('thumbnail');
        $lastHash = $this->get('thumbnail_hash');
        $currentHash = $this->getThumbHash();

        $changed = ($lastHash != $currentHash);
        if (empty($thumbnail) || $changed) {
            $source->createContainer($relativeUrl . '_thumbs/' , '/');
            $source->errors = array();

            if (!empty($thumbnail)) {
                $source->removeObject($relativeUrl . $thumbnail);
            }

            $file = $image->getFileContents();
            $content = $file['content'];
            $extension = strtolower(pathinfo($image->get('file'), PATHINFO_EXTENSION));
            // If the image is a PDF file, it needs a bit more work to get it propery parsed.
            if (strtolower($extension) === 'pdf') {
                if ($extension === 'pdf') {
                    $extension = 'png';
                    $content = $this->xpdo->moregallery->writePdfAsImageAndReturnContent($content);
                }
            }
            elseif (strtolower($extension) === 'svg') {
                $extension = 'png';
            }

            $cropInfo = $this->xpdo->moregallery->getCropInfo($this->get('crop'), $image->get('resource'));
            $newImage = $this->createThumbnail($content, $cropInfo, $extension);
            $thumbFilename = strtolower($this->get('crop')) . '_' . pathinfo($image->get('file'), PATHINFO_FILENAME) . '.' . $extension;

            $source->createObject($relativeUrl . '_thumbs/', $thumbFilename, $newImage);
            $this->set('thumbnail', '_thumbs/' . $thumbFilename);
            $this->set('thumbnail_hash', $this->getThumbHash());
            $this->save();

            if ($source->hasErrors())
            {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error(s) while creating image crops: ' . $this->xpdo->toJSON($source->getErrors()), '', __METHOD__, __FILE__, __LINE__);
            }
        }

        if ($returnPath)
        {
            return $this->getPath($source, $relativeUrl, $this->get('thumbnail'));
        }
        return $this->getUrl($source, $relativeUrl, $this->get('thumbnail'));
    }

    /**
     * Creates a simple hash for the thumbnail so we can update it when it's no longer valid
     *
     * @return string
     */
    public function getThumbHash()
    {
        $x = $this->get('x');
        $y = $this->get('y');
        $x2 = $this->get('x2');
        $y2 = $this->get('y2');
        $width = $this->get('width');
        $height = $this->get('height');

        $data = $x . 'x' . $y . '-' . $x2 . 'x' . $y2 . '-' . $width . 'x' . $height;
        $hash = md5(md5($data)); // We're not really trying to be cryptographically secure or anything
        return $hash;
    }

    /**
     * @param $image
     * @param array $cropInfo
     * @param string $extension
     * @return string
     */
    public function createThumbnail($image, array $cropInfo = array(), $extension = 'png')
    {
        // Try to extend the time we have to execute in case of long running processing
        $timeSpent = (microtime(true) - $this->xpdo->startTime);
        if ($timeSpent > 25) {
            set_time_limit(15);
        }
        // Increase the memory limit too
        $this->xpdo->moregallery->setMemoryLimit();

        $width = $this->get('width');
        $height = $this->get('height');

        try {
            /** @var \Imagine\Image\ImagineInterface $imagine */
            $imagine = $this->xpdo->moregallery->getImagine();

            // Load the image with imagine and create a resized version
            $img = $imagine->load($image);
        } catch (Exception $e) {
            $this->xpdo->log(modX::LOG_LEVEL_ERROR, 'Exception ' . get_class($e) . ' while loading image for crop ' . $this->get('id') . ': ' . $e->getMessage());
            return false;
        }

        $size = $img->getSize();
        $originalWidth = $size->getWidth();
        $originalHeight = $size->getHeight();

        /**
         * If there is no width or height, we need to calculate that ourselves.
         *
         * The strategy here is that we probably have an aspect defined on the crop, and we can use that to crop
         * the image to that particular aspect ratio.
         *
         * Later, we also apply resizing to the resulting image if necessary and defined on the crop.
         */
        $aspect = false;
        if (isset($cropInfo['default_aspect'])) {
            $aspect = (float)$cropInfo['default_aspect'];
        }
        elseif (isset($cropInfo['aspect'])) {
            $aspect = $cropInfo['aspect'];
        }

        if ($width < 1 || $height < 1) {

            // If we have an aspect ratio, we use that to calculate the proper size
            if ($aspect !== false) {
                // Calculate the height based on the width, and the width based on the height, using the crop defined aspect ratio
                $heightBasedWidth = floor($originalHeight * $aspect);
                $widthBasedHeight = floor($originalWidth / $aspect);

                // If the height, derived from the width * aspect, is within the image height we assume the width
                // stays the same, and we only crop from the height.
                if ($widthBasedHeight <= $originalHeight) {
                    $width = $originalWidth;
                    $height = $widthBasedHeight;
                    // As the height changes, we take the difference in height, divide it by 2, and set y to that
                    $y = floor(($originalHeight - $widthBasedHeight) / 2);
                    $this->set('y', $y);
                    $this->set('y2', $originalHeight - $y);
                    $this->set('x2', $originalWidth);
                }
                // Otherwise, we assume the height stays the same and we crop from the width instead.
                else {
                    $height = $originalHeight;
                    $width = $heightBasedWidth;
                    // As we're changing the width, we take the difference divided by 2 to set x
                    $x = floor(($originalWidth - $heightBasedWidth) / 2);
                    $this->set('x', $x);
                    $this->set('x2', $originalWidth - $x);
                    $this->set('y2', $originalHeight);
                }
                $this->set('width', $width);
                $this->set('height', $height);
            }
            // If we don't have an aspect ratio, we just set the x2, y2, width and height values to the full image
            // in the next step of processing, that will be resized to a defined width or height if necessary.
            else
            {
                $this->set('x2', $originalWidth);
                $this->set('y2', $originalHeight);
                $this->set('width', $originalWidth);
                $this->set('height', $originalHeight);
            }

        }

        try {
            // Crop the image from the $x and $y defined, for a size of $width and $height.
            $x = $this->get('x');
            $x2 = $this->get('x2');
            $y = $this->get('y');
            $y2 = $this->get('y2');
            if ($x === 0 && $x2 === $originalWidth && $y === 0 && $y2 === $originalHeight) {
                // We don't need to crop to the full image - it's already full!
            }
            else {
                $img->crop(new Imagine\Image\Point($x, $y), new \Imagine\Image\Box($x2 - $x, $y2 - $y));
            }

            /**
             * Grab the crop properties on the crop and see if it includes a width or a height.
             * If it does, we'll want to resize the image to that particular width or height (or both)
             */
            $resizeHeight = 0;
            $resizeWidth = 0;
            foreach ($cropInfo as $key => $val) {
                if ($key === 'width') {
                    $resizeWidth = (int)$val;
                }
                if ($key === 'height') {
                    $resizeHeight = (int)$val;
                }
            }

            // If we only have a height or a width, calculate the other based on the actual aspect ratio
            $baseWidth = $this->get('width');
            $baseHeight = $this->get('height');
            if ($resizeHeight > 0 && $resizeWidth == 0) {
                $resizeWidth = (int)round(($resizeHeight / $baseHeight) * $baseWidth);
            }
            elseif ($resizeWidth > 0 && $resizeHeight == 0) {
                $resizeHeight = (int)round(($resizeWidth / $baseWidth) * $baseHeight);
            }

            // Do the resizing. This is done after the cropping so we're working with the cropped version and not the original.
            if ($resizeWidth > 0 || $resizeHeight > 0) {
                $img->resize(new \Imagine\Image\Box($resizeWidth, $resizeHeight));
                $dimensions = $img->getSize();
                $this->set('width', $dimensions->getWidth());
                $this->set('height', $dimensions->getHeight());
            }

            // Output the thumbnail as a string
            $options = array(
                'jpeg_quality' => (int)$this->xpdo->moregallery->getOption('moregallery.crop_jpeg_quality', null, '90'),
                'png_compression_level' => (int)$this->xpdo->moregallery->getOption('moregallery.crop_png_compression', null, '9'),
            );
            return $img->get($extension, $options);
        } catch (Exception $e) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception ' . get_class($e) . ' while creating thumbnail: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * Grabs the URL for the file
     *
     * @param modMediaSource $source
     * @param $relativeUrl
     * @param $file
     * @return string
     */
    public function getUrl(modMediaSource $source, $relativeUrl, $file)
    {
        return $source->getObjectUrl($relativeUrl . $file);
    }

    /**
     * Grabs the Path for the file
     *
     * @param modMediaSource $source
     * @param $relativeUrl
     * @param $file
     * @return string
     */
    public function getPath(modMediaSource $source, $relativeUrl, $file)
    {
        return $source->getBasePath() . $relativeUrl . $file;
    }
}
