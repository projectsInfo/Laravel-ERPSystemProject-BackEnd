<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserWarehouseTable extends Migration {

	public function up()
	{
		Schema::create('user_warehouse', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('warehouse_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('user_warehouse');
	}
}