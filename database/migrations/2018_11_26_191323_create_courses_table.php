<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('difficulty_id')->nullable();
            $table->integer('duration');
            $table->unsignedInteger('subject_id')->index(); 
            $table->unsignedInteger('type_id')->index(); // 1 Course 2 Track 3 Practice 4 Program
            $table->unsignedInteger('amount')->nullable();
            $table->text('description');
            $table->text('sypnosis');
            $table->text('plan_code')->nullable();
            $table->text('thumbnail_path')->nullable();
            $table->boolean('custom_course')->default(false);
            $table->integer('development_stage')->default(0); // 1 stage one, 2 stage two, 3 stage three
            $table->boolean('published')->default(false); // is the course visible to the users
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
        Schema::dropIfExists('courses');
    }
}
