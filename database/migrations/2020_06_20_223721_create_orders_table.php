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
            $table->foreignId("user_id")->nullable()->constrained();
            $table->foreignId("payment_id")->nullable()->constrained();
            $table->integer("number")->unsigned();
            $table->date("date")->nullable();
            $table->float("total");
            $table->boolean("closed")->default(false);
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
