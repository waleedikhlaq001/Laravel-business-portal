<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencerCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->integer('min');
            $table->integer('max');
            $table->longText('provided_for'); // This is describing what the influencer will provide for the vendor...
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
        Schema::dropIfExists('influencer_categories');
    }
}
