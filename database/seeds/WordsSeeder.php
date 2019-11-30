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
        factory(App\Models\Word::class, 50)->create()->each(
          function ($word) {
              /*** @var \App\Models\Word $word*/
            $word->translates()->saveMany(factory(App\Models\Translate::class, 2)->make());
        });
    }
}