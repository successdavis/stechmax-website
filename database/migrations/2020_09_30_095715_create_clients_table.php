<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('fullname');
            $table->string('phone')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('image_path')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('gender');
            $table->string('note')->nullable();
            $table->string('testimonial_token', 25)->nullable()->unique();
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
        Schema::dropIfExists('clients');
    }
}
