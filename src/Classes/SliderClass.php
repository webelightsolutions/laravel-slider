<?php

namespace Webelightdev\LaravelSlider\Classes;

use Webelightdev\LaravelSlider\Slider;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Facades\View;

class SliderClass
{
    use Macroable;
    
    protected $slider;

    public function __construct()
    {
    }

    public static function findBy($attribute, $value)
    {
        $slider = Slider::where('id', 1)->where('is_active', 1)->with('slides')->first();
        $sliderJsonObj = response()->json($slider);
        return $sliderJsonObj;
    }
    
    public function sliderItems()
    {
        // $slider = new SliderClass;
        // $slider->macro('main', function () {
        //     return $this->$slider->findBy($attribute, $value)
        //     ->setActiveFromRequest();
        // });
        // $slider->main();
    }
}
