<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_order', function (Blueprint $table) {
            $table->foreignId("coupon_id")->constrained();
            $table->foreignId("order_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupon_order', function (Blueprint $table) {
            $table->dropForeign(["coupon_id"]);
            $table->dropForeign(["order_id"]);
        });
        Schema::dropIfExists('coupon_order');
    }
}
