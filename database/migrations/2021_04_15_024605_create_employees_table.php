<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->bigInteger('department_id');
            $table->unsignedInteger('paygrade_id')->nullable();
            $table->date('employment_date');
            $table->integer('status'); //1 => active, 2 => relieve, 3 => suspended, 4 => retired
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('employees');
    }
}

// An employee can have morethan one job at the same time