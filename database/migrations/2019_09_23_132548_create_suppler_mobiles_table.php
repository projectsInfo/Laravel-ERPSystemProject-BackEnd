<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplerMobilesTable extends Migration {

	public function up()
	{
		Schema::create('suppler_mobiles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('mobile');
			$table->integer('suppler_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('suppler_mobiles');
	}
}