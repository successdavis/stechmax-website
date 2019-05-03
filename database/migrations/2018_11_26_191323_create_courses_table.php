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
            $table->Integer('duration');
            $table->unsignedInteger('subject_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('amount');
            $table->text('description');
            $table->text('sypnosis');
            $table->boolean('custom_course')->default(false);
            $table->string('thumbnail_path')->nullable();
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
