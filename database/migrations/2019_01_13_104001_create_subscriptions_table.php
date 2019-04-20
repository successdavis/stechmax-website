<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->integer('subscriber_id');
            $table->string('subscriber_type');
            $table->integer('duration');
            $table->boolean('class')->default(false);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('invoice_id')->nullable();
            $table->string('subscription_end_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'subscriber_id', 'subscriber_type', 'active'], 'only_one_active_course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
