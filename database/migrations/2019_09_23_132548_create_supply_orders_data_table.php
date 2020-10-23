<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplyOrdersDataTable extends Migration {

	public function up()
	{
		Schema::create('supply_orders_data', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('SupplyOrder_id')->unsigned();
			$table->integer('sub_product_id')->unsigned();
			$table->integer('Quantity');
			$table->integer('Purchasing_price');
		});
	}

	public function down()
	{
		Schema::drop('supply_orders');
	}
}