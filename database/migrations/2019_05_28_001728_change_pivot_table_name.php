<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePivotTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_size', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['size_id']);
         });

         Schema::rename('product_size', 'product_sizes');

         Schema::table('product_sizes', function (Blueprint $table) {
            $table->foreign('size_id')
            ->references('id')
            ->on('sizes')
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
        //
    }
}
