<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplerAddressTable extends Migration {

	public function up()
	{
		Schema::create('suppler_addresses', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('address');
			$table->integer('suppler_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('suppler_addresses');
	}
}