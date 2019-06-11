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
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('amount')->nullable();
            $table->text('description');
            $table->text('sypnosis');
            $table->boolean('custom_course')->default(false);
            $table->string('')->nullable();
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
