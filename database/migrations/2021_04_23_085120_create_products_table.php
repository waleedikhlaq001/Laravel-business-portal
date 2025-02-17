<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->double('price', 8, 2);
            $table->integer('featured')->default(0);
            $table->string('image')->nullable();
            $table->string('colors')->nullable();
            $table->boolean('status')->default(1)->comment("Inactive = 0, Active = 1");
            $table->string('unique_id');
            $table->string('influencer_code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->foreignId('category_id')->constrained('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
