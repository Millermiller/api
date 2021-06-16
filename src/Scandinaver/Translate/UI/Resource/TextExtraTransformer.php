<?php


namespace Scandinaver\Translate\UI\Resource;


use League\Fractal\TransformerAbstract;
use Scandinaver\Translate\Domain\Entity\TextExtra;

/**
 * Class TextExtraTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class TextExtraTransformer extends TransformerAbstract
{

    public function transform(TextExtra $textExtra): array
    {
        return [
            'id'      => $textExtra->getId(),
            'text_id' => $textExtra->getText()->getId(),
            'object'  => $textExtra->getObject(),
            'value'   => $textExtra->getValue(),
        ];
    }
}