<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->longText('description');
            $table->integer('payment_id');
            $table->boolean('isApproved')->default(0)->comment("Not approved = 0, Approved = 1");
            $table->boolean('isAwarded')->default(0)->comment('Not awarded = 0, Awarded = 1');
            $table->integer('unique_id');
            $table->integer('influencer_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreignId('attachment_id')->nullable()->contrained('attachments');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->foreignId('budget_id')->nullable()->constrained('budgets');
            $table->foreignId('video_id')->nullable()->constrained('video_contents', 'id');
            $table->foreignId('vendor_id')->constrained('vendors');
            // $table->foreignId('influencer_id')->nullable()->constrained('influencers');
            // $table->dropSoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
