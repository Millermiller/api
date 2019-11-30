<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSynonymTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('synonym', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('word_id');
			$table->string('synonym');
			$table->timestamps();
			$table->index(['word_id','synonym'], 'word_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('synonym');
	}

}
