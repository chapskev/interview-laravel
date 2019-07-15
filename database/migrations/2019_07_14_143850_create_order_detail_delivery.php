<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_deliveries', function (Blueprint $table) {

            $table->unsignedInteger('order_detail_id');
            $table->unsignedInteger('delivery_id');
            $table->unsignedInteger('order_id');


            $table->foreign('delivery_id')
                ->references('delivery_id')
                ->on('deliveries')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('order_detail_id')
                ->references('order_detail_id')
                ->on('order_details')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail_delivery');
    }
}
