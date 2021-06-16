<?php


namespace Scandinaver\Translate\UI\Resource;


use League\Fractal\TransformerAbstract;
use Scandinaver\Translate\Domain\Entity\Word;

/**
 * Class TermTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class WordTransformer extends TransformerAbstract
{

    public function transform(Word $word): array
    {
        return [
            'id'    => $word->getId(),
            'value' =>$word->getValue(),
            'orig'  => $word->getOrig(),
            'sentenceNum' => $word->getSentenceNum()
        ];
    }
}