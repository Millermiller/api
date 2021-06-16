<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Entity\Card;

/**
 * Class CardTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class CardTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'term',
        'translate',
        'examples',
    ];

    /**
     * @param  Card  $card
     *
     * @return array
     */
    public function transform(Card $card): array
    {
        return [
            'id'        => $card->getId(),
            'favourite' => $card->isFavourite(),
        ];
    }

    public function includeTerm(Card $card): Item
    {
        $term = $card->getTerm();

        return $this->item($term, new TermTransformer());
    }

    public function includeTranslate(Card $card): Item
    {
        $translate = $card->getTranslate();

        return $this->item($translate, new TranslateTransformer());
    }

    public function includeExamples(Card $card): Collection
    {
        $examples = $card->getExamples();

        return $this->collection($examples, new ExampleTransformer());
    }
}