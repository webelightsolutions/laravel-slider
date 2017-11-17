<?php

Route::post('slides/preview', 'Webelightdev\LaravelSlider\Controller\SliderController@preview');
Route::get('slider/changeStatus/{id}', 'Webelightdev\LaravelSlider\Controller\SliderController@changeSliderStatus');
Route::resource('slider', 'Webelightdev\LaravelSlider\Controller\SliderController');
