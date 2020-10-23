<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParcodesPreOneTable extends Migration {

	public function up()
	{
		Schema::create('parcodes_pre_one', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('barcode');
			$table->integer('supply_order_id')->unsigned();
			$table->integer('sub_product_id')->unsigned();
			$table->integer('warehouse_id')->unsigned();
			$table->tinyInteger('active')->default(0);
			$table->integer('order_id')->unsigned()->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('parcodes_pre_one');
	}
}