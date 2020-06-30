<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use LaravelDoctrine\Migrations\Schema\Table;
use LaravelDoctrine\Migrations\Schema\Builder;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;
class CreateLanguagesTable extends AbstractMigration {

    /**
     * Run the migrations.
     *
     * @param Schema $schema
     *
     * @return void
     */
	public function up(Doctrine\DBAL\Schema\Schema $schema)
	{
        (new Builder($schema))->create('languages', function(Table $table) {
            $table->integer('id', true);
            $table->string('name', 50);
            $table->string('label', 50);
            $table->string('flag', 50);
        });

		//Schema::create('languages', function(Blueprint $table)
		//{
		//	$table->integer('id', true);
		//	$table->string('name', 50)->nullable();
		//	$table->string('label', 50)->nullable();
		//	$table->string('flag', 50)->nullable();
		//});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down($schema)
	{
		Schema::drop('languages');
	}

}
