<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->enum('slider_type', ['banner', 'slider']);
            $table->integer('slides_per_page');
            $table->boolean('auto_play')->default(0);
            $table->integer('slider_width')->nullable();
            $table->integer('slider_height')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('model_id')->unsigned()->nullable()->index()->comment('Model id');
            $table->string('model_type')->nullable()->index()->comment('Model Name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
