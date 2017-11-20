<?php

namespace Webelightdev\LaravelSlider;

use Illuminate\Support\ServiceProvider;
use Webelightdev\LaravelSlider\Classes\LaravelSliderClass;
use Illuminate\Support\Facades\View;
use Webelightdev\LaravelSlider\Classes\SliderClass;

class ImageSliderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config
        $this->publishes([__DIR__.'/../config/laravel-slider.php' => config_path('laravel-slider.php')]);
        // Migration
       
         $this->publishes([__DIR__.'/../database/migrations' => $this->app->databasePath().'/migrations'], 'migrations');

        include __DIR__.'/Routes/web.php';

        
      /*  $this->loadViewsFrom(__DIR__ . '/Resources/views', 'laravel-slider');
      
        $this->publishes([
        __DIR__.'/Resources/views' => resource_path('views/vendor/laravel-slider'),
        ]);*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-slider', function () {
            return new LaravelSliderClass();
        });

        $this->app->bind('laravel-slider', function () {
            return new SliderClass();
        });

        $this->app->make('Webelightdev\LaravelSlider\Controller\SliderController');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'laravel-slider');
    }
}
