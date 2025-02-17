<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id');
            $table->string('user_id');
            $table->string('job_id');
            $table->integer('easy_to_work_with');
            $table->integer('communication');
            $table->integer('fair');
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
        Schema::dropIfExists('vendor_ratings');
    }
}
