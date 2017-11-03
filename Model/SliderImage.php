<?php

namespace Webelightdev\LaravelSlider\Model;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
   protected $table = 'slider_images';

   protected $fillable = ['slider_id', 'title', 'is_active', 'caption', 'description', 'image_name', 'start_date', 'end_date'];

   public function slider() {
   	return $this->belongsTo('\Webelightdev\LaravelSlider\Model\Slider', 'slider_id');
   }
}
