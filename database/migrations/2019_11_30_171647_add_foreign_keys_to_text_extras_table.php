<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTextExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('text_extras', function(Blueprint $table)
		{
			$table->foreign('text_id', 'text_extras_ibfk_1')->references('id')->on('text')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('text_extras', function(Blueprint $table)
		{
			$table->dropForeign('text_extras_ibfk_1');
		});
	}

}
