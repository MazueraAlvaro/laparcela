<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("session_id")->constrained();
            $table->foreignId("user_id")->constrained()->nullable();
            $table->foreignId("payment_id")->constrained()->nullable();
            $table->date("date");
            $table->integer("total");
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(["session_id"]);
            $table->dropForeign(["user_id"]);
            $table->dropForeign(["payment_id"]);
        });
        Schema::dropIfExists('orders');
    }
}
