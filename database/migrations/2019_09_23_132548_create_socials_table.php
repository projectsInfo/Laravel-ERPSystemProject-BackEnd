<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialsTable extends Migration {

	public function up()
	{
		Schema::create('socials', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('url');
			$table->integer('client_id')->unsigned();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('socials');
	}
}