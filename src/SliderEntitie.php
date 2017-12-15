<?php

namespace Webelightdev\LaravelSlider;

use Illuminate\Database\Eloquent\Model;
use Webelightdev\LaravelSlider\Slider;

class SliderEntitie extends Model
{
    protected $table = 'slider_entities';
    protected $fillable = ['entity_id', 'entity_type', 'slider_id'];

    public function slider()
    {
        return $this->belongsTo(Slider::class, 'entity_id');
    }
}
