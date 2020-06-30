<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTranslateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translate', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('value');
			$table->integer('word_id');
			$table->string('variant')->nullable();
			$table->integer('form')->nullable();
			$table->integer('sentence')->default(0);
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
		Schema::drop('translate');
	}

}
