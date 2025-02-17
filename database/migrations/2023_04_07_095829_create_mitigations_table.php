<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitigations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('dispute_id');
            $table->string('payment_ref');
            $table->string('mitigation_amount')->nullable();
            $table->text('decision')->nullable();
            $table->text('reason')->nullable();
            $table->string('settlement_amount')->nullable();
            $table->string('to_pay')->nullable();
            $table->integer('payee_id')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('mitigations');
    }
}
