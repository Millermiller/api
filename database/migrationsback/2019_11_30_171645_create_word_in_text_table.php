<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWordInTextTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('word_in_text', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('text_id');
			$table->integer('sentence_num');
			$table->string('word');
			$table->string('orig');
			$table->timestamps();
			$table->index(['text_id','sentence_num','word'], 'text_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('word_in_text');
	}

}
