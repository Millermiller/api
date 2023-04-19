<?php


namespace Scandinaver\Learning\Translate\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Translate\Domain\Entity\Synonym;

/**
 * Class SynonymTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class SynonymTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        // 'word'
    ];

    #[Pure]
    #[ArrayShape(['id' => "int|null", 'value' => "string"])]
    public function transform(Synonym $synonym): array
    {
        return [
            'id'    => $synonym->getId(),
            'value' => $synonym->getValue(),
        ];
    }

    public function includeWord(Synonym $synonym): Item
    {
        $word = $synonym->getWord();

        return $this->item($word, new DictionaryItemTransformer());
    }
}