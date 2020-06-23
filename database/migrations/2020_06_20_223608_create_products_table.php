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
            $table->bigIncrements("id");
            $table->foreignId("unit_id")->constrained();
            $table->foreignId("product_status_id")->constrained();
            $table->string("sku", 100)->unique();
            $table->string("name", 100);
            $table->text("description")->nullable();
            $table->float("regular_price");
            $table->float("discount_price")->nullable();
            $table->boolean("taxable");
            $table->softDeletes();
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(["unit_id"]);
            $table->dropForeign(["product_status_id"]);
        });
        Schema::dropIfExists('products');
    }
}
