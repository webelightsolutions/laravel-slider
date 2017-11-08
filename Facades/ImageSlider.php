<?php

namespace Webelightdev\LaravelSlider\Facades;

use Illuminate\Support\Facades\Facade;

class ImageSlider extends Facade
{
    
    protected static function getFacadeAccessot()
    {
        return 'image-slider';
    }
}
