<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToProductsItemsOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('price')->nullable();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->integer('price')->nullable();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('price')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_items_orders', function (Blueprint $table) {
            //
        });
    }
}
