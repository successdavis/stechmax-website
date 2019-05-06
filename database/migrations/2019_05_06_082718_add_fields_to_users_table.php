<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('r_address')->nullable();
            $table->date('dob')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->string('m_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('r_address')->nullable();
            $table->date('dob')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->string('m_name')->nullable();
        });
    }
}
