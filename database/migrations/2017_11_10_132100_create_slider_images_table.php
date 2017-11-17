<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('slider_id');
            $table->longtext('title')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('caption')->nullable();
            $table->longtext('image_name');
            $table->dateTime('start_date')->default(date("Y-m-d H:i:s"));
            $table->dateTime('end_date')->default(date("Y-m-d H:i:s"));
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_images');
    }
}
