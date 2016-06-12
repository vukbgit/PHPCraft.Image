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
     * @param string $path from application-root
     * @return mixed adapted library instance 
     **/
    public function open($imageLibrary, $path);
    
}