<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('participant')->nullable();
            $table->string('email')->nullable();
        
            $table->string('verified_attendance')->nullable();
            $table->string('attendance_mode')->nullable();
            $table->string('payment_amount')->nullable();

            $table->string('ticket_number')->nullable();
            $table->string('event_id')->nullable();
            $table->string('event_title')->nullable();
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
        Schema::dropIfExists('eventreports');
    }
}
