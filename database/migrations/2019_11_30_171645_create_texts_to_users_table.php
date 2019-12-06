<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('texts_to_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('language_id')->nullable();
			$table->integer('text_id')->nullable()->index('text_id');
			$table->integer('user_id')->nullable()->index('user_id');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('texts_to_users');
	}

}
