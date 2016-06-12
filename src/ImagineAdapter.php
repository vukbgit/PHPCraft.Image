<?php

namespace PHPCraft\Image;

use Imagine;

/**
 * Manipulates images using imagine/imagine  (https://github.com/avalanche123/Imagine)
 *
 * @author vuk <info@vuk.bg.it>
 */
class ImagineAdapter implements ImageInterface
{
    /**
     * Opens image
     *
     * @param string $imageLibrary GD, Imagick,...
     * @param string $path from application-root
     * @return mixed adapted library instance 
     **/
    public function open($imageLibrary, $path)
    {
    }
}