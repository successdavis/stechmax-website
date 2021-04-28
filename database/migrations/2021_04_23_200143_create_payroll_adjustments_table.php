<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('amount', 8,2);
            $table->timestamps();

            $table->foreignId('employee_id')
              ->constrained()
              ->onDelete('cascade');

            $table->foreignId('payroll_id')
              ->constrained()
              ->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_adjustments');
    }
}
