<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoDataToLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->string('duration')->nullable();
            $table->string('type')->nullable();
            $table->string('original_video_name');
            $table->string('disk')->nullable();
            $table->string('video_path')->nullable();
            $table->string('stream_path')->nullable();
            $table->boolean('processed')->default(false);
            $table->string('duration_in_seconds')->nullable();
            $table->datetime('converted_for_streaming_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures', function (Blueprint $table) {
            //
        });
    }
}
