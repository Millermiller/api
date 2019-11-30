<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('words', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('word')->index('word');
			$table->string('transcription')->nullable();
			$table->string('audio')->nullable();
			$table->integer('sentence')->nullable()->default(0);
			$table->integer('is_public')->nullable()->default(0);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('creator')->nullable();
			$table->string('lang', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('words');
	}

}
