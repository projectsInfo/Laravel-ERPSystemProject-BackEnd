<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->integer('warehouse_id')->unsigned()->nullable();
			$table->integer('totle_of_order')->nullable();
			$table->integer('shipping_fees')->nullable();
			$table->integer('discount_id')->unsigned()->nullable();
			$table->integer('state')->nullable();
			$table->integer('type')->nullable();
			$table->date('date_to_delivery')->nullable();
			$table->text('note')->nullable();
			$table->integer('delivary_id')->unsigned()->nullable();
			// $table->integer('invioce_number')->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}