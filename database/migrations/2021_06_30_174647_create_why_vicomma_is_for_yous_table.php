<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhyVicommaIsForYousTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('why_vicomma_is_for_yous', function (Blueprint $table) {
            $table->id();
            $table->string('hire_creative');
            $table->longText('hire_creative_description');
            $table->string('earm_money');
            $table->longText('earm_money_description');
            $table->string('watch_buy');
            $table->longText('watch_buy_description');
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
        Schema::dropIfExists('why_vicomma_is_for_yous');
    }
}
