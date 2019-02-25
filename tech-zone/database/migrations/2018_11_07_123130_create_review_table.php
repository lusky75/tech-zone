<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->date('date_review');
            $table->integer('stars');
            $table->integer('id_product');
            $table->integer('id_user');
            $table->timestamps();
        });

        Schema::table('review', function (Blueprint $table) {
            $table->foreign('id_product')->references('id')->on('product');
        });

        Schema::table('review', function (Blueprint $table) {
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
        Schema::dropIfExists('review');
    }
}
