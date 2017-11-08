<?php

namespace Webelightdev\LaravelSlider\src\Classes;

use Webelightdev\LaravelSlider\src\Slider;

class SliderClass
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    

    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->slider->where($attribute, $value)->first($columns);
    }
}
