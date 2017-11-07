<?php

namespace Webelightdev\LaravelSlider;

use Illuminate\Support\ServiceProvider;
use Webelightdev\LaravelSlider\Classes\LaravelSliderClass;

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

        include __DIR__.'/routes.php';
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

        $this->app->make('Webelightdev\LaravelSlider\Controller\SliderController');
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-slider');
    }
}
