<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\DTO\CardDTO;

/**
 * Class CardDTOTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class CardDTOTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'word',
        'translate',
        'examples',
    ];

    public function transform(CardDTO $cardDTO): array
    {
        return [
            'id'        => $cardDTO->getId(),
            'favourite' => $cardDTO->isFavourite(),
            'examples'  => [],
        ];
    }

    public function includeWord(CardDTO $cardDTO): Item
    {
        $wordDTO = $cardDTO->getWordDTO();

        return $this->item($wordDTO, new WordDTOTransformer());
    }

    public function includeTranslate(CardDTO $cardDTO): Item
    {
        $translateDTO = $cardDTO->getTranslateDTO();

        return $this->item($translateDTO, new TranslateDTOTransformer());
    }

    public function includeExamples(CardDTO $cardDTO): Collection
    {
        $examples = $cardDTO->getExamples();

        return $this->collection($examples, new ExampleTransformer());
    }
}