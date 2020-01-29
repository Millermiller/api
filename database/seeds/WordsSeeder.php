<?php

use Illuminate\Database\Seeder;

class WordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Helpers\Eloquent\Word::class, 50)->create()->each(
          function ($word) {
              /*** @var App\Helpers\Eloquent\Word $word*/
            $word->translates()->saveMany(factory(App\Helpers\Eloquent\Translate::class, 2)->make());
        });
    }
}