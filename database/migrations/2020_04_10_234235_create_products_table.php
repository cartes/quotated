<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreignId('category_id');
            $table->foreignId('buyer_id')->nullable();
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->integer('price');
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('products');
    }
}
