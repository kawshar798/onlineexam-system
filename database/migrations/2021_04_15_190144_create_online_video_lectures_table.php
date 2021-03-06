<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineVideoLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_video_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->string('thumbnail')->nullable();
            $table->enum('status',['Active','Inactive']);
            $table->string('ip');
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
        Schema::dropIfExists('online_video_lectures');
    }
}
