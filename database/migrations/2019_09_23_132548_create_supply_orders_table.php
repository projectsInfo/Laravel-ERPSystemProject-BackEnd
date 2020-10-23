<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplyOrdersTable extends Migration {

	public function up()
	{
		Schema::create('supply_orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('suppler_id')->unsigned();
			$table->integer('warehouse_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('supply_orders');
	}
}