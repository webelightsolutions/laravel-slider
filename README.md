# laravel-slider
Image slider using Laravel


#### Demo
![dem1](https://user-images.githubusercontent.com/32864560/33022440-372188c8-ce2b-11e7-995a-b305e8aa0a1d.jpg)
![demo2](https://user-images.githubusercontent.com/32864560/33022741-2bcec46c-ce2c-11e7-87fd-8a6d89848456.jpg)


## Following are the step to configure Image Slider

### Step 1:Laravel slider plugin requires the following components to work correctly
    ```
    Intervention Image
    ```

#### Step 2:copy vendor using composer
    ```
    composer require webelightdev/laravel-slider dev-master
    ```
    
    Or, you may manually update require block and run `composer update`
    ```
    "require": {
       
        "webelightdev/laravel-slider": "dev-master"
    }
    ```
    'composer update' will be required.

#### step 3: Once Laravel Slider is installed, You need to register the Service Provider in `config/app.php` Add following in `providers` list

    ```
    'providers' => [
     // ...
        Webelightdev\LaravelSlider\ImageSliderServiceProvider::class,
     // ...

    ]
    ```

#### step 4: To publish the Config, Migration, Service Provider and Facades Run

    ```  
	php artisan vendor:publish
    ```


#### step 5: Finally, run migration to generate table Run

    ``` 
	php artisan migrate
    ```

	
#### step 6: This packager Required Auth login if you don't have Auth login Run

    ```
	php artisan make:auth
    php artisan migrate
    ```

#### you can view laravel slider by writing:
www.yourdomain.com/slider 
or 
localhost/yourapp/slider



