<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDelivaryCompaniesTable extends Migration {

	public function up()
	{
		Schema::create('delivary_companies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('Name');
			$table->mediumText('Address');
			$table->string('Phone');
			$table->string('Email');
		});
	}

	public function down()
	{
		Schema::drop('delivary_companies');
	}
}