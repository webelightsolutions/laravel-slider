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
            $table->dateTime('start_date')->default(date("Y-m-d H:i:s"));
            $table->dateTime('end_date')->default(date("Y-m-d H:i:s"));
            $table->integer('slides_per_page');
            $table->boolean('is_active')->default(0);
            $table->boolean('auto_play')->default(0);



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
