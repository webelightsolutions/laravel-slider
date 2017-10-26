<?php

namespace Webelightdev\LaravelSlider\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = ['name', 'slider_type', 'is_active', 'auto_paly', 'slides_per_page'];


    public function slides() {
    	return $this->hasMany('\Webelightdev\LaravelSlider\Model\SliderImage');
    }
}
