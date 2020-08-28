<?php


namespace Scandinaver\Learn\Domain\Model;

use Scandinaver\Shared\DTO;

/**
 * Class CardDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class CardDTO extends DTO
{
    private Card $card;

    public function __construct(Card $card)
    {

        $this->card = $card;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->card->getId(),
            'favourite' => $this->card->isFavourite(),
            'word' => $this->card->getWord(),
            'translate' => $this->card->getTranslate(),
            'examples' => $this->card->getExamples()->map(fn($example) => [
                'id' => $example->getId(),
                'card_id' => $example->getCard()->getId(),
                'text' => $example->getText(),
                'value' => $example->getValue(),
            ])->toArray(),
        ];
    }
}