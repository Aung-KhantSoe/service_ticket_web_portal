<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->foreignId('faq_id')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('status_id');
            $table->foreignId('dev_id')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('progress')->nullable();
            $table->integer('cost')->nullable();
            $table->string('estimated_complete_time')->nullable();
            $table->text('canceled_cmt')->nullable();
            $table->text('service_warranty_start_date')->nullable();
            $table->text('service_warranty_end_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
