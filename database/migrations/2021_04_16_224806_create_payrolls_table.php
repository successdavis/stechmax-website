<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('status');// 1 => Not paid 2 => paid => unresolved;
            $table->decimal('gross_salary');
            $table->decimal('net_salary');
            $table->unsignedInteger('emp_id');
            $table->bigInteger('bank_details_id')->unsigned();
            $table->string('month'); // The for which this salary is for ;
            $table->string('year');
            $table->timestamps();


            // $table->foreignId('bank_details_id')
            //   ->constrained()
            //   ->onDelete('set null');

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
        Schema::dropIfExists('payrolls');
    }
}
