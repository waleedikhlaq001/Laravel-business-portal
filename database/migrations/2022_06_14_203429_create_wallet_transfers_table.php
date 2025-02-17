<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('tx_id');
            $table->string('acc_num');
            $table->string('full_name');
            $table->integer('amount');
            $table->string('tx_created_at');
            $table->string('status');
            $table->string('currency');
            $table->string('tx_ref');
            $table->integer('wallet_id');
            $table->integer('milestone_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transfers');
    }
}