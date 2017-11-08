<?php

Route::get('slider/changeStatus/{id}', 'Webelightdev\LaravelSlider\src\Controller\SliderController@changeSliderStatus');
Route::post('slides/preview', 'Webelightdev\LaravelSlider\src\Controller\SliderController@preview');

Route::resource('slider', 'Webelightdev\LaravelSlider\src\Controller\SliderController');
