<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWarehousesTable extends Migration {

	public function up()
	{
		Schema::create('warehouses', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('address');
		});
	}

	public function down()
	{
		Schema::drop('warehouses');
	}
}