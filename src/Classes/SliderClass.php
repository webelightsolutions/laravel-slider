<?php

namespace Webelightdev\LaravelSlider\src\Classes;

use Webelightdev\LaravelSlider\src\Slider;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Facades\View;

class SliderClass
{
    use Macroable;
    
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    

    public function findBy($attribute, $value)
    {
        $slider = $this->slider->where($attribute, $value)->where('is_active', 1)->get();
        return view('laravel-slider::show', compact('slider'));
    }

    
    public function sliderItems()
    {
        $slider = new SliderClass;
        $slider->macro('main', function () {
            return $this->$slider->findBy($attribute, $value)
            ->setActiveFromRequest();
        });
        $slider->main();
    }
}
