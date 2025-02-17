<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('shipping_name');
            $table->string('shipping_address');
            $table->string('shipping_address_2')->nullable();
            $table->string('quantity');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
            $table->string('phone');
            $table->string('tax')->nullable();
            $table->string('email');
            //$table->timestamps('date')->nullable();
            $table->tinyInteger('shipped');
            $table->string('tracking_number');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
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
        Schema::dropIfExists('orders');
    }
}


