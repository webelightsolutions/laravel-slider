<?php

namespace Webelightdev\LaravelSlider\src\Exceptions;

use Exception;
use Webelightdev\LaravelSlider\src\Slider;

class SliderCannotBeDeleted extends Exception
{
   
    public function doesNotBelongToModel($id)
    {
        return new static("Slider with id '{$id}' does not Exists.");
    }
}
