<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Learn\Domain\DTO\CardDTO;
use Scandinaver\Learn\Domain\DTO\TranslateDTO;
use Scandinaver\Learn\Domain\DTO\WordDTO;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Class CardFabric
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class CardFactory
{
    public static function fromDTO(CardDTO $cardDTO): Card
    {
        $card      = new Card();
        $word      = new Word();
        $translate = new Translate();

        $word->setValue($cardDTO->getWordDTO()->getValue());
        $translate->setValue($cardDTO->getTranslateDTO()->getValue());

        $translate->setWord($word);

        $card->setWord($word);
        $card->setTranslate($translate);

        $card->setCreator($cardDTO->getCreator());
        $card->setLanguage($cardDTO->getLanguage());

        return $card;
    }

    public static function toDTO(Card $card): CardDTO
    {
        $cardDTO = new CardDTO();

        $wordDTO = new WordDTO(
            $card->getWord()->getId(),
            $card->getWord()->getValue()
        );

        $translateDTO = new TranslateDTO(
            $card->getTranslate()->getId(),
            $card->getTranslate()->getValue()
        );

        $cardDTO->setId($card->getId());
        $cardDTO->setLanguage($card->getLanguage());
        $cardDTO->setCreator($card->getCreator());
        $cardDTO->setWordDTO($wordDTO);
        $cardDTO->setTranslateDTO($translateDTO);
        $cardDTO->setExamples($card->getExamples()->toArray());

        return $cardDTO;
    }
}