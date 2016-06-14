<?php

namespace PHPCraft\Image;

/**
 * Image manipulation
 *
 * @author vuk <info@vuk.bg.it>
 */
interface ImageInterface
{
    
    /**
     * Opens image
     *
     * @param string $imageLibrary GD, Imagick,...
     * @param string $sourcePath from application-root
     * @return mixed adapted library instance 
     **/
    public function open($imageLibrary, $sourcePath);
    
    /**
     * Resizes image keeping ratio
     *
     * @param int $width
     * @param int $height
     * @param string $path from application-root to save to
     * @param bool $keepRatio
     **/
    public function resize($width, $height, $path = null, $keepRatio = true);
}