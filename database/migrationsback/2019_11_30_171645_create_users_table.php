<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('login');
			$table->string('email')->unique('email');
			$table->dateTime('active_to')->nullable()->default('2000-11-29 20:00:00');
			$table->integer('plan_id')->nullable();
			$table->string('name')->nullable();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->string('photo')->nullable();
			$table->string('restore_link')->nullable()->index('restore_link');
			$table->integer('active')->default(1);
			$table->integer('role')->nullable()->default(0);
			$table->integer('assets_opened')->nullable()->default(0);
			$table->integer('assets_created')->nullable()->default(0);
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('last_online')->nullable()->index('last_online');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
