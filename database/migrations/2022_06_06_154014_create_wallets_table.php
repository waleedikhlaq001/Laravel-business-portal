<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('budget');
            $table->integer('balance');
            $table->enum('twenty_five', [0,1]);
            $table->enum('fifty', [0,1]);
            $table->enum('seventy_five', [0,1]);
            $table->enum('hundred', [0,1]);
            $table->timestamps();
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained('jobs');
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
        Schema::dropIfExists('wallets');
    }
}