<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_orders', function (Blueprint $table) {
            $table->decimal('price', 10, 2);
            $table->string('size');
            $table->bigInteger('days_rented');
            $table->bigInteger('quantity');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->foreign('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('set null')
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
        Schema::table('item_orders', function (Blueprint $table) {
            //
        });
    }
}
