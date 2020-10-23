<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDelivaryPriceTable extends Migration {

	public function up()
	{
		Schema::create('delivary_price', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('city_id')->unsigned();
			$table->float('price', 10,2)->default(0)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('delivary_price');
	}
}