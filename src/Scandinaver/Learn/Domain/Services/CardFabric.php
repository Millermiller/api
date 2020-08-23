<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Class CardFabric
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class CardFabric
{
    public function build($data): Card
    {
        $card = new Card();
        $word = new Word();
        $translate = new Translate();

        $word->setWord($data['word']);
        $translate->setValue($data['value']);

        $translate->setWord($word);

        $card->setWord($word);
        $card->setTranslate($translate);
        $card->setCreator($data['creator']);

        return $card;
    }
}