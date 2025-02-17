<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsCountToVideoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_contents', function (Blueprint $table) {
            $table->integer('view_count')->default('0');
            $table->integer('comment_count')->default('0');
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
            $table->dropColumn('view_count');
            $table->dropColumn('comment_count');
        });
    }
}
