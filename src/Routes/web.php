<?php

Route::post('slides/preview', 'Webelightdev\LaravelSlider\src\Controller\SliderController@preview');
Route::get('slider/changeStatus/{id}', 'Webelightdev\LaravelSlider\src\Controller\SliderController@changeSliderStatus');
Route::resource('slider', 'Webelightdev\LaravelSlider\src\Controller\SliderController');
