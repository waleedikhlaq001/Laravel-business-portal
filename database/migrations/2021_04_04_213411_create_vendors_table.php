<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vendors')) {
            Schema::create('vendors', function (Blueprint $table) {
                $table->id();
                $table->string('vendor_station');
                $table->integer('rating')->nullable();
                $table->boolean('status')->default(1)->comment("Inactive = 0, Active = 1");
                // $table->string('slug');
                // $table->string('facebook')->nullable();
                // $table->string('instagram')->nullable();
                // $table->string('tiktok')->nullable();
                // $table->string('twitter')->nullable();
                $table->timestamps();
            });
        }

        Schema::table('vendors', function (Blueprint $table) {
            $table->foreignId('vendor_type_id')->constrained('vendor_types', 'id');
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
        Schema::dropIfExists('vendors');
    }
}
