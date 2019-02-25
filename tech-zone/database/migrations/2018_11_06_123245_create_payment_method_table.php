<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paypal_id');
            $table->integer('credit_card_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('payment_method', function (Blueprint $table) {
            $table->foreign('paypal_id')->references('id')->on('credit_card');
        });

        Schema::table('payment_method', function (Blueprint $table) {
            $table->foreign('credit_card_id')->references('id')->on('paypal');
        });

        Schema::table('payment_method', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}
