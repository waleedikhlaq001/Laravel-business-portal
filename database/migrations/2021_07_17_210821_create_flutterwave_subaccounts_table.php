<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlutterwaveSubaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flutterwave_subaccounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->string('account_bank');
            $table->string('full_name');
            $table->string('split_type');
            $table->string('split_value');
            $table->string('subaccount_id');
            $table->string('bank_name');
            $table->string('flutterwave_id');
            $table->timestamps();
        });

        Schema::table('flutterwave_subaccounts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flutterwave_subaccounts');
    }
}
