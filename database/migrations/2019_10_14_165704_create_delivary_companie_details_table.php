<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDelivaryCompanieDetailsTable extends Migration {

	public function up()
	{
		Schema::create('delivary_companie_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('city_id')->unsigned();
			$table->float('price', 10,2)->default(0)->nullable();
			$table->integer('delivary_company_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('delivary_companie_details');
	}
}