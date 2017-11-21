# laravel-slider
Image slider using Laravel


#### Demo
![dem1](https://user-images.githubusercontent.com/32864560/33022440-372188c8-ce2b-11e7-995a-b305e8aa0a1d.jpg)
![demo2](https://user-images.githubusercontent.com/32864560/33022741-2bcec46c-ce2c-11e7-87fd-8a6d89848456.jpg)

## Following are the step to configure Image Slider


#### Step 1:copy vendor using composer

    composer require webelightdev/laravel-slider dev-master
    
    or
    
    "require": {
       
        "webelightdev/laravel-slider": "dev-master"
    }
    composer update

#### step 2: Copy providers to config/app.php

    'providers' => [
     // ...
        Webelightdev\LaravelSlider\ImageSliderServiceProvider::class,
     // ...

    ]

#### step 3: Run  
	php artisan vendor:publish


#### step 4: Run  
	php artisan migrate

	
#### step 5: create public/uploads folder  and set permission 0777

This packager Required Auth login
if you don't have Auth login 

	php artisan make:auth
    php artisan migrate

#### you can view laravel slider with following link:
www.yourdomain.com/slider 
or 
localhost/yourapp/slider



