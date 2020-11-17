<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('item_id')->from(100000);
            $table->bigInteger('category_id');
            $table->bigInteger('subcategory_id');
            $table->string('item_name');
            $table->string('item_image')->nullable();
            $table->double('actual_price');
            $table->double('sale_price');
            $table->integer('stock_amount');
            $table->integer('instock')->default(1);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('items');
    }
}
