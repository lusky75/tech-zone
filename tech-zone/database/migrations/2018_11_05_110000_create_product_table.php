<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->integer('quantity');
            $table->text('description');
            $table->string('picture', 255);
            $table->integer('price');
            $table->string('category');
            $table->timestamps();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category')->references('id')->on('category');
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
