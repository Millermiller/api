<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('text', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('language_id')->nullable();
			$table->integer('level')->nullable();
			$table->string('title')->index('title');
			$table->text('description', 65535)->nullable();
			$table->text('text', 65535);
			$table->text('translate', 65535);
			$table->integer('published')->nullable()->default(0);
			$table->timestamps();
			$table->string('image')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('text');
	}

}
