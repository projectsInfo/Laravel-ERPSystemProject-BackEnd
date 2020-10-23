<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('facebook_account')->nullable();
			$table->string('whats')->nullable();
			// $table->longText('note')->nullable();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}