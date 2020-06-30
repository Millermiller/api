<?php

use Illuminate\Database\Seeder;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Translate;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Word;

class WordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Word::class, 50)->create()->each(
          function ($word) {
              /*** @var Word $word*/
            $word->translates()->saveMany(factory(Translate::class, 2)->make());
        });
    }
}