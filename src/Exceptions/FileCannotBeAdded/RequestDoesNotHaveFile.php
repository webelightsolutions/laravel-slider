<?php

namespace Webelightdev\LaravelSlider\src\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelSlider\src\Helpers\EloquentHelpers;
use Webelightdev\LaravelSlider\src\Exceptions\FileCannotBeAdded;

class RequestDoesNotHaveFile extends FileCannotBeAdded
{
    public static function create()
    {
        return new static("The current request does not have a file.");
    }
}
