<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('online_link')->nullable();
            $table->string('venue')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('starttime');
            $table->datetime('endtime');
            $table->string('price')->nullable();
            $table->text('description');
            $table->string('image_name');
            $table->string('image_path');
            $table->string('document_name')->nullable();
            $table->string('document_path')->nullable();
            $table->string('entry_mode');
            $table->string('speaker')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_details');
    }
}
