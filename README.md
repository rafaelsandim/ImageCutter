ImageCutter
===========

Fistly, clone or make download of ImageCutter on your Plugin folder, normally: app\Plugin 


On app\Config\bootstrap.php add the follow line:

```php
  CakePlugin::load('ImageCutter');
```

Every View that you'll need to use ImageCutter you should put on view Controller the follow line:

```php
  public $helpers = array('ImageCutter.ImageCutter');
```

### How to use ###


On view (app/View/\*/*.ctp), you can use ImageCutter Helper according next lines: 

```php

// PATH = file location (ex: './photos/car.png');
// width = width value (ex: 100);
// height = height value (ex: 200;
<img src="<?=$this->ImageCutter->url('PATH', width, height)?>">

// If you want to same dimension to several photos you can use setDimensions() to define a width and height
<? $this->ImageCutter->setDimensions(300, 300); ?>
<img src="<?=$this->ImageCutter->url('PATH_1')?>">
<img src="<?=$this->ImageCutter->url('PATH_2')?>">
<img src="<?=$this->ImageCutter->url('PATH_3')?>">

// The default crop type is outside, however you can change it.
// if you have setted dimensions with setDimensions(), just use:
<img src="<?=$this->ImageCutter->url('PATH_1', 'outside')?>"> // is not necessary because outside is default.
<img src="<?=$this->ImageCutter->url('PATH_2', 'inside')?>">
<img src="<?=$this->ImageCutter->url('PATH_3', 'fill')?>">

// If you don't have setDimensions() setted or want another dimension for a specific img tag
// Is not necessary because outside is default.
<img src="<?=$this->ImageCutter->url('PATH_1', 100, 400, 'outside')?>">
// So
<img src="<?=$this->ImageCutter->url('PATH_1', 100, 400)?>">
<img src="<?=$this->ImageCutter->url('PATH_2', 155, 233, 'inside')?>">
<img src="<?=$this->ImageCutter->url('PATH_3', 112, 333, 'fill')?>">

// Now lorem is supported
<img src="<?=$this->ImageCutter->lorem(100, 400)?>">

// Test if image path exists, return true if image exists, else return false.
<img src="<?=$this->ImageCutter->hasImage('PATH_1')?>">

```
