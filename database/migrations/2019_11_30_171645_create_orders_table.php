<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('sum')->default(0);
			$table->string('status', 50)->nullable();
			$table->integer('plan_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('notification_type')->nullable();
			$table->string('datetime')->nullable();
			$table->string('codepro')->nullable();
			$table->string('sender')->nullable();
			$table->string('sha1_hash')->nullable();
			$table->string('label')->nullable();
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
		Schema::drop('orders');
	}

}
