<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopping_cart', function (Blueprint $table) {
            $table->foreignId("product_id")->constrained();
            $table->foreignId("shopping_cart_id")->constrained();
            $table->float("quantity");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_shopping_cart', function (Blueprint $table) {
            $table->dropForeign("product_id");
            $table->dropForeign("shopping_cart_id");
        });
        Schema::dropIfExists('product_shopping_cart');
    }
}
