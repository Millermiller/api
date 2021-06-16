<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Learn\Domain\DTO\CardDTO;
use Scandinaver\Learn\Domain\DTO\TranslateDTO;
use Scandinaver\Learn\Domain\DTO\TermDTO;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\Translate;
use Scandinaver\Learn\Domain\Entity\Term;

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
        $term      = new Term();
        $translate = new Translate();

        $term->setValue($cardDTO->getTermDTO()->getValue());
        $translate->setValue($cardDTO->getTranslateDTO()->getValue());

        $translate->setTerm($term);

        $card->setTerm($term);
        $card->setTranslate($translate);

        $card->setCreator($cardDTO->getCreator());
        $card->setLanguage($cardDTO->getLanguage());

        return $card;
    }

    public static function toDTO(Card $card): CardDTO
    {
        $cardDTO = new CardDTO();

        $termDTO = new TermDTO(
            $card->getTerm()->getId(),
            $card->getTerm()->getValue()
        );

        $translateDTO = new TranslateDTO(
            $card->getTranslate()->getId(),
            $card->getTranslate()->getValue()
        );

        $cardDTO->setId($card->getId());
        $cardDTO->setLanguage($card->getLanguage());
        $cardDTO->setCreator($card->getCreator());
        $cardDTO->setTermDTO($termDTO);
        $cardDTO->setTranslateDTO($translateDTO);
        $cardDTO->setExamplesDTO($card->getExamples()->map(fn($example) => ExampleFactory::toDTO($example))->toArray());

        return $cardDTO;
    }
}