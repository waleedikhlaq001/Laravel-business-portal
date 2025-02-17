<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('image')->nullable();
                $table->integer('two_fa')->default(0);
                $table->string('token')->nullable();
                $table->string('street_address')->nullable();
                $table->integer('postal_code')->nullable();
                $table->string('city')->nullable();
                $table->string('role')->default('influencer');
                $table->string('phone_number')->nullable();
                $table->boolean('status')->default(1)->comment("Inactive = 0, Active = 1");
                $table->string('facebook')->nullable();
                $table->string('instagram')->nullable();
                $table->bigInteger('user_instagram_id')->nullable();
                $table->string('tiktok')->nullable();
                $table->string('snapchat')->nullable();
                $table->string('telegram')->nullable();
                $table->string('twitter')->nullable();
                $table->string('ref')->nullable();
                $table->integer('ref_code')->nullable();
                $table->integer('ref_earned')->default(0);
                $table->string('signup_from')->default('staging');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table) {
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
        Schema::dropIfExists('users');
    }
}
