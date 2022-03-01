<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->timestamps();
            $table->unsignedBigInteger('event_user_id');
            $table->foreign('event_user_id')->references('id')->on('event_user')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('organizer_id')->nullable();
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
