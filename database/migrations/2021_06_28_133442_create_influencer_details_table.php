<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer_details', function (Blueprint $table) {
            $table->id();
            $table->string('influencer_years_experience');
            $table->longText('influencer_description')->nullable();
            $table->string('inflencer_services_provided');
            $table->string('influencer_followers');
            $table->string('influencer_previous_job');
            $table->string('influencer_turnaround_time');
            $table->string('influencer_charges');
            $table->string('influencer_clients');
            $table->string('influencer_skills')->nullable();
            $table->timestamps();
        });
        Schema::table('influencer_details', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('currency_id')->constrained('currencies', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('influencer_details');
    }
}
