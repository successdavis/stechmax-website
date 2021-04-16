<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobtitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobtitles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();

            $table->foreignId('department_id')
              ->constrained()
              ->onDelete('cascade');
        });

        Schema::create('job_title_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('emp_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreignId('jobtitle_id')
              ->constrained()
              ->onDelete('cascade');

            $table->foreign('emp_id')->references('id')->on('users')
              ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobtitles');
    }
}
