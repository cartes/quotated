<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductBuyer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_product', function (Blueprint $table) {
            $table->foreignId('buyer_id');
            $table->foreignId('product_id');
            $table->foreign('buyer_id')->references('id')->on('buyers')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyer_product');
    }
}
