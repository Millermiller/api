<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assets_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('asset_id');
			$table->integer('user_id');
			$table->integer('result')->default(0);
			$table->integer('language_id')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assets_to_users');
	}

}
