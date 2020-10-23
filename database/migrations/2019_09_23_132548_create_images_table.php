<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('img_url');
			$table->integer('product_id')->unsigned();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}