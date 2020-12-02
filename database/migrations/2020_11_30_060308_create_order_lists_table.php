<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lists', function (Blueprint $table) {
            $table->bigIncrements('order_id')->from(11111111);
            $table->bigInteger('customer_id');
            $table->longText('order_data');
            $table->text('note')->nullable();
            $table->double('deli_price')->default(0);
            $table->double('total_discount')->default(0);
            $table->integer('status')->default(0);
            $table->integer('customer_status')->default(0);
            $table->double('created_on');
            $table->double('completed_on')->nullable();
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
        Schema::dropIfExists('order_lists');
    }
}
