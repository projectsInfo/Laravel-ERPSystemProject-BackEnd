<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderInformationsTable extends Migration {

	public function up()
	{
		Schema::create('order_informations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('product_id')->unsigned();
			$table->integer('quantity');
			$table->integer('price');
			$table->integer('order_id')->unsigned();
			
		});
	}

	public function down()
	{
		Schema::drop('order_informations');
	}
}