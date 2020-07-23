<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("order_id")->constrained();
            $table->string("sku", 100);
            $table->string("name", 100);
            $table->text("description")->nullable();
            $table->float("price");
            $table->integer("quantity");
            $table->string("unit", 100);
            $table->float("subtotal");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign(["order_id"]);
        });
        Schema::dropIfExists('order_products');
    }
}
