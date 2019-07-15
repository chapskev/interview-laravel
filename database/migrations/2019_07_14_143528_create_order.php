<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->unsignedInteger('order_id');
            $table->dateTime('order_date');
            $table->unsignedInteger('headquarter_id');

            $table->index('order_id');

            $table->foreign('headquarter_id')
                ->references('headquarter_id')
                ->on('headquarters')
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
        Schema::dropIfExists('orders');
    }
}
