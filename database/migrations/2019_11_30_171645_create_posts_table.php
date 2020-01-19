<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('title', 200)->default('')->index('post_name');
			$table->bigInteger('user_id')->unsigned()->default(0)->index('post_author');
			$table->text('content')->nullable();
			$table->integer('category_id');
			$table->text('anonse', 65535)->nullable();
			$table->boolean('status')->default(1);
			$table->integer('comment_status')->default(1);
			$table->bigInteger('views')->default(0);
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
		Schema::drop('posts');
	}

}
