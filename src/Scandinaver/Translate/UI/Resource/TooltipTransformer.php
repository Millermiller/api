<?php


namespace Scandinaver\Translate\UI\Resource;


use League\Fractal\TransformerAbstract;
use Scandinaver\Translate\Domain\Entity\Tooltip;

/**
 * Class TooltipTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class TooltipTransformer extends TransformerAbstract
{

    public function transform(Tooltip $tooltip): array
    {
        return [
            'id'      => $tooltip->getId(),
            'text_id' => $tooltip->getText()->getId(),
            'object'  => $tooltip->getObject(),
            'value'   => $tooltip->getValue(),
        ];
    }
}