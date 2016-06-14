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
    protected $image;
    protected $sourcePath;
    
    /**
     * Opens image
     * @param string $imageLibrary GD, Imagick,...
     * @param string $sourcePath from application-root
     **/
    public function open($imageLibrary, $sourcePath)
    {
        $this->sourcePath = $sourcePath;
        $qualifiedClassName = '\Imagine\\' . $imageLibrary . '\Imagine';
        $image = new $qualifiedClassName();
        $this->image = $image->open($this->sourcePath);
    }
    
    /**
     * Resizes image keeping ratio
     * @param int $width
     * @param int $height
     * @param string $path from application-root to save to
     * @param bool $keepRatio
     * @return mixed adapted library instance 
     **/
    public function resize($width, $height, $path = null, $keepRatio = true)
    {
        if(!$path) $path = $this->sourcePath;
        // keep ratio
        if($keepRatio) {
            $transformation = new Imagine\Filter\Transformation();
            $transformation->thumbnail(new Imagine\Image\Box($width, $height))
                ->save($path);
            $transformation->apply($this->image);
        } else {
        //deforming resize
            $this->image->resize(new \Imagine\Image\Box($width, $height))->save($path);
        }
    }
}