<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowVicommaWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('how_vicomma_works', function (Blueprint $table) {
            $table->id();
            $table->string('header');
            $table->longText('description');
            $table->string('step1_header');
            $table->longText('step1_description');
            $table->string('step2_header');
            $table->longText('step2_description');
            $table->string('step3_header');
            $table->longText('step3_description');
            $table->string('step4_header');
            $table->longText('step4_description');
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
        Schema::dropIfExists('how_vicomma_works');
    }
}
