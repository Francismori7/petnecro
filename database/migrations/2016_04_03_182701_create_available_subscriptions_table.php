<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier');
            $table->integer('amount');
            $table->string('interval');
            $table->integer('interval_count');
            $table->string('name');
            $table->string('statement_descriptor');
            $table->dateTime('created');
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
        Schema::drop('available_subscriptions');
    }
}
