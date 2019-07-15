<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {

            $table->unsignedInteger('delivery_id');
            $table->dateTime('delivery_date');
            $table->unsignedInteger('supplier_id');

            $table->index('delivery_id');

            $table->foreign('supplier_id')
                ->references('supplier_id')
                ->on('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
