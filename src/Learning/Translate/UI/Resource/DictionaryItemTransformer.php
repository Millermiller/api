<?php


namespace Scandinaver\Learning\Translate\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Translate\Domain\Entity\DictionaryItem;

/**
 * Class DictionaryItem
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class DictionaryItemTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        'synonyms',
    ];

    #[Pure]
    #[ArrayShape([
        'id'          => "int|null",
        'text'        => "string",
        'value'       => "null|string",
        'sentenceNum' => "int",
        'coordinates' => "array",
    ])]
    public function transform(DictionaryItem $dictionaryItem): array
    {
        return [
            'id'          => $dictionaryItem->getId(),
            'text'        => $dictionaryItem->getObject(),
            'value'       => $dictionaryItem->getValue(),
            'sentenceNum' => $dictionaryItem->getSentenceNum(),
            'coordinates' => $dictionaryItem->getCoordinates(),
        ];
    }

    public function includeSynonyms(DictionaryItem $dictionaryItem): Collection
    {
        $synonyms = $dictionaryItem->getSynonyms();

        return $this->collection($synonyms, new SynonymTransformer());
    }
}