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
        $wordsIds     = App\Helpers\Eloquent\Word::pluck('id')->toArray();
        $translateIds = App\Helpers\Eloquent\Translate::pluck('id')->toArray();
        $assetIds     = App\Helpers\Eloquent\Asset::pluck('id')->toArray();

        foreach($assetIds as $id){
            $cards = factory(App\Helpers\Eloquent\Card::class, 25)->make()->each(function($card) use ($wordsIds, $translateIds, $id) {
                $card->asset_id = $id;
                $card->word_id = array_random($wordsIds);
                $card->translate_id = array_random($translateIds);
            })->toArray();

            App\Helpers\Eloquent\Card::insert($cards);
        }
    }
}