<?php

Route::get('slider/changeStatus/{id}', 'Webelightdev\LaravelSlider\Controller\SliderController@formActions');

Route::resource('slider', 'Webelightdev\LaravelSlider\Controller\SliderController');
