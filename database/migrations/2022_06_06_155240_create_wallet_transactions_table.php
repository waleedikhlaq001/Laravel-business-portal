<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('status');
            $table->string('currency');
            $table->string('amount');
            $table->string('percent');
            $table->string('wallet_uid');
            $table->timestamps();
        });

        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('vendor_id')->constrained('vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}