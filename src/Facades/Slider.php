<?php

namespace Webelightdev\LaravelSlider\src\Facades;

use Illuminate\Support\Facades\Facade;

class Slider extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'slider';
    }
}
