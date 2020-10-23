<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMobileTable extends Migration {

	public function up()
	{
		Schema::create('mobile', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('mobile');
			$table->integer('client_id')->unsigned();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('mobile');
	}
}