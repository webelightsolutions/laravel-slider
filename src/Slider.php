<?php

namespace Webelightdev\LaravelSlider\src;

use Illuminate\Database\Eloquent\Model;
use Webelightdev\LaravelSlider\src\SliderImage;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = ['name', 'slider_type','auto_paly', 'slides_per_page', 'slider_height', 'slider_width' ,'is_active'];


    public function slides()
    {
        return $this->hasMany(SliderImage::class);
    }
}
