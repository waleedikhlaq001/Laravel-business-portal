<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStageToDisputeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disputes', function (Blueprint $table) {
            if (!Schema::hasColumn('disputes', 'stage')) {
                $table->string('stage')->default('one');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disputes', function (Blueprint $table) {
            $table->dropColumn('stage');
        });
    }
}