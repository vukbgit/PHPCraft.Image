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
     **/
    public function resize($width, $height, $path = null, $keepRatio = true)
    {
        if(!$path) $path = $this->sourcePath;
        // keep ratio
        if($keepRatio) {
            $transformation = new Imagine\Filter\Transformation();
            //$transformation->thumbnail(new Imagine\Image\Box($width, $height))->save($path);
            $transformation->thumbnail(new Imagine\Image\Box($width, $height));
            $transformation->apply($this->image);
        } else {
        //deforming resize
            $this->image->resize(new \Imagine\Image\Box($width, $height))->save($path);
        }
    }
    
    /**
     * crops a square
     * @param int $x of upper left corner
     * @param int $y of upper left corner
     **/
    public function cropSquare($x = 0, $y = 0)
    {
        $imageBox = $this->image->getSize();
        $width = $imageBox->getWidth();
        $height = $imageBox->getHeight();
        $side = $width <= $height ? $width : $height;
        $this->crop($x, $y, $side, $side);
    }
    
    /**
     * crops a rectangle
     * @param int $x of upper left corner
     * @param int $y of upper left corner
     * @param int $width
     * @param int $height
     **/
    public function crop($x, $y, $width, $height)
    {
        //$this->image->crop(new \Imagine\Image\Point($x, $y),new \Imagine\Image\Box($width, $height))->save($this->sourcePath);
        $this->image->crop(new \Imagine\Image\Point($x, $y),new \Imagine\Image\Box($width, $height));
    }
    
    /**
     * crops a rectangle
     * @param int $x of upper left corner
     * @param int $y of upper left corner
     * @param int $width
     * @param int $height
     **/
    public function save()
    {
        $this->image->save($this->sourcePath);
    }
}