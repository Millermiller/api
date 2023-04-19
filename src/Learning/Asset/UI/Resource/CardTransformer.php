<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Card;

/**
 * Class CardTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class CardTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        'term',
        'translate',
        'example',
    ];

    #[Pure]
    #[ArrayShape(['id' => "int", 'favourite' => "bool"])]
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

        return $this->item($term, new TermTransformer(), 'term');
    }

    public function includeTranslate(Card $card): Item
    {
        $translate = $card->getTranslate();

        return $this->item($translate, new TranslateTransformer(), 'translate');
    }

    public function includeExample(Card $card): Collection
    {
        $examples = $card->getExamples();

        return $this->collection($examples, new ExampleTransformer(), 'example');
    }
}