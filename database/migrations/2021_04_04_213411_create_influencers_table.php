<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('influencers')) {
            Schema::create('influencers', function (Blueprint $table) {
                $table->id();
                $table->integer('rating')->nullable();
                $table->string('code');
                $table->string('twitter_followers')->nullable();
                $table->string('instagram_followers')->nullable();
                $table->string('tiktok_views')->nullable();
                $table->string('skills')->nullable();
                // $table->string('location');
                // $table->longText('description');
                // $table->string('twitter')->nullable();
                // $table->string('instagram')->nullable();
                // $table->string('tiktok')->nullable();
                $table->timestamps();
            });
        }

        Schema::table('influencers', function (Blueprint $table) {
            $table->foreignId('influencer_type_id')->constrained('influencer_types', 'id');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('influencer_category_id')->nullable()->constrained('influencer_categories', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('influencers');
    }
}
