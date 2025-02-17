<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('duration');
            $table->longText('proposal');
            $table->integer('influencer_id');
            $table->boolean('chat_initiated')->default(0)->comment("False = 0, True = 1");
            $table->boolean('milestone');
            $table->text('milestone_data');
            $table->timestamps();
        });

        Schema::table('bids', function (Blueprint $table) {
            // $table->foreignId('influencer_id')->constrained('influencers', 'user_id');
            $table->foreignId('job_id')->constrained('jobs', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}
