<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWordInTextTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('word_in_text', function(Blueprint $table)
		{
			$table->foreign('text_id', 'word_in_text_ibfk_1')->references('id')->on('text')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('word_in_text', function(Blueprint $table)
		{
			$table->dropForeign('word_in_text_ibfk_1');
		});
	}

}
