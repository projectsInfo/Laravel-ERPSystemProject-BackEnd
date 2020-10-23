<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountsTable extends Migration {

	public function up()
	{
		Schema::create('discounts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->enum('type', array('promocode', 'test'));
			$table->integer('value');
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('discounts');
	}
}