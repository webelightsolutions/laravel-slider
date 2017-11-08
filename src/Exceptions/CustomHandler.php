<?php

namespace Webelightdev\LaravelSlider\src\Exceptions;

use Exception;
use App\Exceptions\Handler as ExceptionHandler;
use Illuminate\Contracts\Container\Container;
use Webelightdev\LaravelSlider\src\Slider;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Support\Facades\View;

class CustomHandler extends ExceptionHandler
{
    protected $slider;

    public function __construct(Container $container, Slider $slider)
    {
        parent::__construct($container);

        $this->slider = $slider;
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $exception = Handler::prepareException($exception);

        if ($exception instanceof CustomException) {
            return $this->showCustomErrorPage();
        }

        return parent::render($request, $exception);
    }

    public function showCustomErrorPage()
    {
        $recentlyAdded = $this->slider->fetchLatestVehicles(0, 12);
    }
}
