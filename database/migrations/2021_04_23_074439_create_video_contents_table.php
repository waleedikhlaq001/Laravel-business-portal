<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_contents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->integer('job_id')->nullable();
            $table->integer('influencer_id');
            $table->timestamps();
        });
        Schema::table('video_contents', function (Blueprint $table) {
            // $table->foreignId('influencer_id')->constrained('influencers');
            // $table->foreignId('job_id')->nullable()->constrained('jobs');
                    $table->enum('kids_compliant', ['YES', 'NO'])->default('YES');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_contents');
        Schema::table('video_contents', function (Blueprint $table) {
            $table->dropColumn("kids_compliant");
        });
    }
}
