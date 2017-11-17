<?php

namespace Webelightdev\LaravelSlider\Exceptions;

use Exception;
use Webelightdev\LaravelSlider\Slider;

class SliderCannotBeDeleted extends Exception
{
   
    public function doesNotBelongToModel($id)
    {
        return new static("Slider with id '{$id}' does not Exists.");
    }
}
