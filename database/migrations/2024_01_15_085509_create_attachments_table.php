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
            $table->foreignId('task_id')
                    ->references('id')->on('tasks')
                    ->onDelete('cascade');
            $table->text('receipt')->nullable();
            $table->text('photo_1')->nullable();
            $table->text('photo_2')->nullable();
            $table->text('photo_3')->nullable();
            $table->text('photo_4')->nullable();
            $table->text('photo_5')->nullable();
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
        Schema::dropIfExists('attachments');
    }
}
