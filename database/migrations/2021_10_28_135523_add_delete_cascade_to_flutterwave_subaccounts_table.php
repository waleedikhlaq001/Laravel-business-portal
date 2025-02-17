<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteCascadeToFlutterwaveSubaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flutterwave_subaccounts', function (Blueprint $table) {
            $table->dropForeign('flutterwave_subaccounts_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flutterwave_subaccounts', function (Blueprint $table) {
            //
        });
    }
}
