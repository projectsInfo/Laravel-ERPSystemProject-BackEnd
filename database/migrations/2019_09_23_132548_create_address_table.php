<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration {

	public function up()
	{
		Schema::create('address', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('address');
			$table->integer('client_id')->unsigned();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('address');
	}
}