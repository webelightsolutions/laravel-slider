<?php

namespace Webelightdev\LaravelSlider\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = ['name', 'slider_type','auto_paly', 'slides_per_page', 'slider_height', 'slider_width'];


    public function slides() {
    	return $this->hasMany('\Webelightdev\LaravelSlider\Model\SliderImage');
    }
}
