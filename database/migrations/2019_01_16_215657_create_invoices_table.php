<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->unsignedInteger('user_id');
            $table->integer('billable_id');
            $table->string('billable_type'); // get the Model this invoice is created for e.g. Course, Certificates, etc.
            $table->boolean('paid')->default(false); // if paid then invoice has recieved full payments and should not be payable
            $table->boolean('installmental')->default(false); // if true then invoice can accept installmental payments
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
        Schema::dropIfExists('invoices');
    }
}
