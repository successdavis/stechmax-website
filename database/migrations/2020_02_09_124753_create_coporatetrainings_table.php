<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoporatetrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coporatetrainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('begin_at');
            $table->text('endgoal');
            $table->string('venue');
            $table->unsignedInteger('user_id');
            $table->boolean('personal_pc')->default(false);
            $table->integer('fee')->nullable();
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
        Schema::dropIfExists('coporatetrainings');
    }
}
