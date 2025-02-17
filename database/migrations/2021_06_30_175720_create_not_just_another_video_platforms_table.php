<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotJustAnotherVideoPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('not_just_another_video_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('not_just_another_platform');
            $table->longText('not_just_another_platform_description');
            $table->string('vcomm_icon');
            $table->longText('vcomm_icon_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('not_just_another_video_platforms');
    }
}
