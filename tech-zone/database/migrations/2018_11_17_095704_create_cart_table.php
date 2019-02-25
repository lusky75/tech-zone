<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('numberofproducts');
            $table->integer('id_product');
            $table->timestamps();
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreign('id_product')->references('id')->on('category');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
