<?php

use Illuminate\Database\Seeder;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Card;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Translate;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Word;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wordsIds     = Word::pluck('id')->toArray();
        $translateIds = Translate::pluck('id')->toArray();
        $assetIds     = Asset::pluck('id')->toArray();

        foreach($assetIds as $id){
            $cards = factory(Card::class, 25)->make()->each(function($card) use ($wordsIds, $translateIds, $id) {
                $card->asset_id = $id;
                $card->word_id = array_random($wordsIds);
                $card->translate_id = array_random($translateIds);
            })->toArray();

            Card::insert($cards);
        }
    }
}