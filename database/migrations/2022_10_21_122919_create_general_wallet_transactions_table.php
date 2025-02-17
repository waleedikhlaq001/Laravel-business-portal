<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('tx_ref');
            $table->string('name');
            $table->string('desc');
            $table->integer('amount');
            $table->string('time');
            $table->string('date');
            $table->string('status');
            $table->string('type');
            $table->timestamps();
        });

        Schema::table('general_wallet_transactions', function (Blueprint $table) {
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
        Schema::dropIfExists('general_wallet_transactions');
    }
}
