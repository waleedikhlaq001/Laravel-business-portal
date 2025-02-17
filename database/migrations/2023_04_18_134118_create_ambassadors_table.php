<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbassadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambassadors', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('street_address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('status')->default(1)->comment("Inactive = 0, Active = 1");
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->bigInteger('user_instagram_id')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('telegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('nin')->nullable();
            $table->string('bvn')->nullable();
            $table->string('center')->nullable();
            $table->timestamps();
        });

        Schema::table('ambassadors', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->constrained('countries');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambassadors');
    }
}
