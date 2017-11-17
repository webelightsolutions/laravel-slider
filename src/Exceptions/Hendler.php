<?php

namespace Webelightdev\LaravelSlider\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof CustomException) {
                return response()->view('', [], 500);
        }

        //check if exception is an instance of ModelNotFoundException.
        if ($exception instanceof ModelNotFoundException) {
            // ajax 404 json feedback
            if ($request->ajax()) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            // normal 404 view page feedback
            return response()->view('', [], 404);
        }
                
        return parent::render($request, $exception);
    }
}
