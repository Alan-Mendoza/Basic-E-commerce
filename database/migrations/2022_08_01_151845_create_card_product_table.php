<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_product', function (Blueprint $table) {
            $table->bigInteger('card_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity')->unsigned();

            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_product');
    }
}
