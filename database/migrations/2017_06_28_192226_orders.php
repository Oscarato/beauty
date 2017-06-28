<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document');
            $table->integer('service');
            $table->string('name');
            $table->string('email');
            $table->string('phone_mobile');
            $table->string('phone');
            $table->string('address');
            $table->string('address_service');
            $table->string('date_service');
            $table->time('hour_service');
            $table->integer('status');
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
        //
    }
}
