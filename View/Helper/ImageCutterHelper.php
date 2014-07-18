<?php

App::uses('AppHelper', 'View/Helper');
App::import('Vendor', 'ImageCutter.WideImage/WideImage');

class ImageCutterHelper extends AppHelper {

    private $lorem = 'http://lorempixel.com/';
    private $width = 100;
    private $height = 100;
    private $crop = 'outside';

    private function __param($parameter) {

        $numberOfParameters = count($parameter);
        $url = null;
        $width = $this->width;
        $height = $this->height;
        $crop = $this->crop;

        if ($numberOfParameters == 2) {
            $crop = $parameter[1];
        } else if ($numberOfParameters >= 3) {
            $width = $parameter[1];
            $height = $parameter[2];
            if ($numberOfParameters == 4) {
                $crop = $parameter[3];
            }
        }
        $url = $parameter[0];

        return array($url, $width, $height, $crop);
    }

    // When you want to use the same crop to a lot of images, 
    //you can use setCrop and define a default crop, if you not 
    //use and don't pass any parameter the default crop will be 'outside'.
    public function setCrop($crop) {
        $this->crop = $crop;
    }

    // When you want to use the same dimensions to a lot of images, 
    //you can use setDimensions and define a default width and height.
    public function setDimensions($width=150, $height=150) {
        $this->width = $width;
        $this->height = $height;
    }

    //returns thumbs path if it exists, else generate a new thumb according parameters.
    //nothing is returned when the path doesn't exists
    public function url($url = NULL, $full = false) {

        list($url, $width, $height, $crop) = $this->__param(func_get_args());

       if ( file_exists($url) ) {

    	    $file = pathinfo($url);
        	$extension = $file['extension'];
        	$dir = $file['dirname'];
        	$name = $file['filename'];

        	$outputFilePath = $dir.'/'.$name.'_'.$width.'x'.$height.'_'.$crop.'.'.$extension;

        	if (!file_exists($outputFilePath)) {
        		$image = WideImage::load($url);
        		$image = $image->resize($width, $height, $crop, 'any')->crop('center', 'center', $width, $height);
        		$quality = strcmp($extension, 'png') ? 100 : 9;
        		$image->saveToFile($outputFilePath, $quality);
        	}

        	return $outputFilePath;
        }
    }

    // try if image exists
    public function hasImage($path) {
        return file_exists($path);
    }

    //generate lorem
    public function lorem($width = 100, $height = 100) {
        return $this->lorem.$width.'/'.$height;
    }
}
