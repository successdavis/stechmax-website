<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('purpose');
            $table->string('type');
            $table->string('title');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('newsletterdispatchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('newsletter_id')->constrained();
            $table->unsignedInteger('dispatcher_id');
            $table->string('dispatcher_type');
            $table->datetime('sent_at')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('newsletters');
    }
}
