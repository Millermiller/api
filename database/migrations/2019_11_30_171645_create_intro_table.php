<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('intro', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('page', 50)->nullable();
			$table->string('element')->nullable()->default('undefined');
			$table->text('intro', 65535)->nullable();
			$table->string('position')->nullable()->default('false');
			$table->string('tooltipClass')->nullable();
			$table->integer('sort')->nullable()->default(100);
			$table->integer('active')->nullable();
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
		Schema::drop('intro');
	}

}
