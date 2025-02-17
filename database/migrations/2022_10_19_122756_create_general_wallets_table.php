<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('balance');
            $table->string('uid');
            $table->timestamps();
        });

        Schema::table('general_wallets', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('currency_id')->constrained('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_wallets');
    }
}
