<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->string('format');
            $table->integer('job_id');
            $table->timestamps();
        });

        Schema::table('attachments', function (Blueprint $table) {
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->foreignId(('uploaded_by'))->constrained('users', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
