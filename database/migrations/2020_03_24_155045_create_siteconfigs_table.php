<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteconfigs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('classroom_fee');
            $table->integer('handout_fee');
            $table->integer('certificate_fee');
            $table->integer('diploma_fee');
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
        Schema::dropIfExists('siteconfigs');
    }
}
