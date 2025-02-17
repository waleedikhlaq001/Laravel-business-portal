<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreativeRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creative_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id');
            $table->integer('vendor_id');
            $table->foreignId('user_id');
            $table->integer('skilled');
            $table->integer('communication');
            $table->integer('otd');
            $table->integer('affordable');
            $table->integer('reuse');
            $table->string('comment');
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
        Schema::dropIfExists('creative_ratings');
    }
}
