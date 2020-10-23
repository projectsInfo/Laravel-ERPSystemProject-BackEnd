<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('mobile', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->foreign('style_id')->references('id')->on('styles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcodes_pre_one', function(Blueprint $table) {
			$table->foreign('sub_product_id')->references('id')->on('Sub_Products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('suppler_mobiles', function(Blueprint $table) {
			$table->foreign('suppler_id')->references('id')->on('supplers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('suppler_emails', function(Blueprint $table) {
			$table->foreign('suppler_id')->references('id')->on('supplers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('suppler_addresses', function(Blueprint $table) {
			$table->foreign('suppler_id')->references('id')->on('supplers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Sub_Products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

	}

	public function down()
	{
		Schema::table('mobile', function(Blueprint $table) {
			$table->dropForeign('mobile_client_id_foreign');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->dropForeign('address_client_id_foreign');
		});


		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_style_id_foreign');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_product_id_foreign');
		});
		Schema::table('parcodes_pre_one', function(Blueprint $table) {
			$table->dropForeign('parcodes_pre_one_supply_order_id_foreign');
		});
		Schema::table('parcodes_pre_one', function(Blueprint $table) {
			$table->dropForeign('parcodes_pre_one_sub_product_id_foreign');
		});

		Schema::table('suppler_mobiles', function(Blueprint $table) {
			$table->dropForeign('suppler_mobiles_suppler_id_foreign');
		});
		Schema::table('suppler_emails', function(Blueprint $table) {
			$table->dropForeign('suppler_emails_suppler_id_foreign');
		});
		Schema::table('suppler_addresses', function(Blueprint $table) {
			$table->dropForeign('suppler_addresses_suppler_id_foreign');
		});
		Schema::table('Sub_Products', function(Blueprint $table) {
			$table->dropForeign('Sub_Products_product_id_foreign');
		});

	}
}