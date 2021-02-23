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

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'        => $this->card->getId(),
            'favourite' => $this->card->isFavourite(),
            'word'      => [
                'id'        => $this->card->getWord()->getId(),
                'value'     => $this->card->getWord()->getValue(),
                'audio'     => $this->card->getWord()->getAudio(),
                'sentence'  => $this->card->getWord()->getSentence(),
                'is_public' => $this->card->getWord()->getIsPublic(),
                'creator'   => $this->card->getWord()->getCreator(),
            ],
            'translate' => [
                'id'       => $this->card->getTranslate()->getId(),
                'value'    => $this->card->getTranslate()->getValue(),
                'word'     => [
                    'id'        => $this->card->getTranslate()->getWord()->getId(),
                    'value'     => $this->card->getTranslate()->getWord()->getValue(),
                    'audio'     => $this->card->getTranslate()->getWord()->getAudio(),
                    'sentence'  => $this->card->getTranslate()->getWord()->getSentence(),
                    'is_public' => $this->card->getTranslate()->getWord()->getIsPublic(),
                    'creator'   => $this->card->getTranslate()->getWord()->getCreator(),
                ],
                'sentence' => $this->card->getTranslate()->getSentence(),
                'active'   => $this->card->getTranslate()->getId(),
            ],
            'examples'  => $this->card->getExamples()->map(
                fn($example) => [
                    'id'      => $example->getId(),
                    'card_id' => $example->getCard()->getId(),
                    'text'    => $example->getText(),
                    'value'   => $example->getValue(),
                ]
            )->toArray(),
        ];
    }
}