<?php

namespace Webelightdev\LaravelSlider\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelSlider\Helpers\EloquentHelpers;
use Webelightdev\LaravelSlider\Exceptions\FileCannotBeAdded;

class RequestDoesNotHaveFile extends FileCannotBeAdded
{
    public static function create()
    {
        return new static("The current request does not have a file.");
    }
}
