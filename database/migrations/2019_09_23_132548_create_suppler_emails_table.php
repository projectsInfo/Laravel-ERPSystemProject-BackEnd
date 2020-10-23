<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplerEmailsTable extends Migration {

	public function up()
	{
		Schema::create('suppler_emails', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('email');
			$table->integer('suppler_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('suppler_emails');
	}
}