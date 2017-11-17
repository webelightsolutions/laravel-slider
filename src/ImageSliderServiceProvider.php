<?php

namespace Webelightdev\LaravelSlider;

use Illuminate\Support\ServiceProvider;
use Webelightdev\LaravelSlider\Classes\LaravelSliderClass;
use Illuminate\Support\Facades\View;
use Webelightdev\LaravelSlider\src\Classes\SliderClass;

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

        /*// resources
        $this->publishes([__DIR__ . '/Resources/assets' => resource_path('assets/vendor/laravel-slider'),], 'assets');*/
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

        $this->app->make('Webelightdev\LaravelSlider\src\Controller\SliderController');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'laravel-slider');
    }
}
