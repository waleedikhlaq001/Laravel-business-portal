<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('banner')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->string('location')->nullable();
            $table->string('primary_color')->default('#000');
            $table->string('secondary_color')->default('#6f3c96');
            $table->string('button_color')->default('#6f3c96');
            $table->string('header')->nullable();
            $table->string('slogan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('banner');
            $table->dropColumn('phone_number');
            $table->dropColumn('location');
            $table->dropColumn('primary_color');
            $table->dropColumn('secondary_color');
            $table->dropColumn('button_color');
            $table->dropColumn('header');
            $table->dropColumn('slogan');
        });
    }
}
