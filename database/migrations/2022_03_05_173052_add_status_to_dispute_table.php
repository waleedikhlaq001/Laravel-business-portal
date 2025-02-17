<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDisputeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disputes', function (Blueprint $table) {
            if (!Schema::hasColumn('disputes', 'status')) {
                $table->string('status')->nullable();
            }

            if (!Schema::hasColumn('disputes', 'isCompleted')) {
                $table->integer('isCompleted')->default(0);
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
            if (Schema::hasColumn('disputes', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('disputes', 'isCompleted')) {
                $table->dropColumn('isCompleted');
            }
        });
    }
}
