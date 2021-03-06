<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paygrades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bonus')->nullable();
            $table->string('short_name');
            $table->decimal('basic', 8,2);
            $table->string('dearness_bonus')->nullable();
            $table->string('holiday_allowance')->nullable();
            $table->timestamps();

            $table->foreignId('role_id')
              ->constrained()
              ->onDelete('cascade');
        });

        Schema::create('paygrade_histories', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->foreignId('paygrade_id')
              ->constrained()
              ->onDelete('cascade');

            $table->foreignId('employee_id')
              ->constrained()
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
        Schema::dropIfExists('pay_grades');
    }
}
