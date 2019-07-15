<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadquarter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headquarters', function (Blueprint $table) {

            $table->unsignedInteger('headquarter_id');
            $table->unsignedInteger('branch_id');

            $table->index('headquarter_id');

            $table->foreign('branch_id')
                ->references('branch_id')
                ->on('branches')
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
        Schema::dropIfExists('headquarters');
    }
}
