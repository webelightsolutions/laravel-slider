<?php

Route::get('slider/changeStatus/{id}', 'Webelightdev\LaravelSlider\Controller\SliderController@formActions');
Route::get('slider/preview', 'Webelightdev\LaravelSlider\Controller\SliderController@preview');

Route::resource('slider', 'Webelightdev\LaravelSlider\Controller\SliderController');
