<?php

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wordsIds     = \App\Models\Word::pluck('id')->toArray();
        $translateIds = \App\Models\Translate::pluck('id')->toArray();
        $assetIds     = \App\Models\Asset::pluck('id')->toArray();

        foreach($assetIds as $id){
            $cards = factory(App\Models\Card::class, 25)->make()->each(function($card) use ($wordsIds, $translateIds, $id) {
                $card->asset_id = $id;
                $card->word_id = array_random($wordsIds);
                $card->translate_id = array_random($translateIds);
            })->toArray();

            App\Models\Card::insert($cards);
        }
    }
}