<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('gender');
            $table->string('phone');
            $table->string('avatar_path')->nullable();
            $table->string('email')->unique();
            $table->boolean('confirmed')->default(false);
            $table->boolean('admin')->default(false);
            $table->string('confirmation_token', 25)->nullable()->unique();
            $table->string('password');
            $table->string('paystack_id')
                ->unique()
                ->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
