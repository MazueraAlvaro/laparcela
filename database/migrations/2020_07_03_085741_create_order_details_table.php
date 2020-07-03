<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("order_id")->constrained();
            $table->string("first_name", 100);
            $table->string("last_name", 100);
            $table->string("city", 100);
            $table->string("address", 100);
            $table->string("address_additional", 100)->nullable();
            $table->string("phone", 100);
            $table->string("email", 100);
            $table->text("notes")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(["order_id"]);
        });
        Schema::dropIfExists('order_details');
    }
}
