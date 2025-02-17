<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoDescToVideoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_contents', function (Blueprint $table) {
            $table->string('video_desc')->nullable();
            $table->string('video_thumb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_contents', function (Blueprint $table) {
            $table->dropColumn('video_desc');
            $table->dropColumn('video_thumb');
        });
    }
}
