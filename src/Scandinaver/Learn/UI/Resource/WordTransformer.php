<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Class CardTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class WordTransformer extends TransformerAbstract
{
    /**
     * @param  Word  $word
     *
     * @return array
     */
    public function transform(Word $word): array
    {
        return [
            'id'    => $word->getId(),
            'value' => $word->getValue(),
        ];
    }
}