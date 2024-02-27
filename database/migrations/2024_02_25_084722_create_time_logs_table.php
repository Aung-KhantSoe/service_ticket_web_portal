<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')
                    ->references('id')->on('tasks')
                    ->onDelete('cascade');
            $table->string('order_at')->nullable();
            $table->string('pending_at')->nullable();
            $table->string('running_at')->nullable();
            $table->string('smooth_at')->nullable();
            $table->string('done_at')->nullable();
            $table->string('cancel_at')->nullable();
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
        Schema::dropIfExists('time_logs');
    }
}
