<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('session_details', function (Blueprint $table) {
            $table->string('image_cloud')->nullable();
            $table->string('document_cloud')->nullable();

        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('session_details', function (Blueprint $table) {
            $table->dropColumn(['image_cloud']);
            $table->dropColumn(['document_cloud']);

        });
    }
}
