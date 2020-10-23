<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubProductsTable extends Migration {

	public function up()
	{
		Schema::create('Sub_Products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('product_id')->unsigned();
			$table->string('color');
			$table->string('colorName');
			$table->integer('size');
			$table->integer('selling_price');
			$table->string('parcode_pre_all');
		});
	}

	public function down()
	{
		Schema::drop('Sub_Products');
	}
}