<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::dropIfExists('attachments');
            Schema::create('attachments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('task_id')->unsigned();
                $table->foreign('task_id')->references('id')->on('task')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('attachments');
    }
}
