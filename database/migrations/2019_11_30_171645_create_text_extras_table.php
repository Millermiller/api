<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('text_extras', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('text_id');
			$table->string('orig');
			$table->string('extra');
			$table->timestamps();
			$table->index(['text_id','orig','extra'], 'text_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('text_extras');
	}

}
