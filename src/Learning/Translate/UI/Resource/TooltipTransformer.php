<?php


namespace Scandinaver\Learning\Translate\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Translate\Domain\Entity\Tooltip;

/**
 * Class TooltipTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class TooltipTransformer extends TransformerAbstract
{

    #[Pure]
    #[ArrayShape([
        'id'      => "int|null",
        'text_id' => "int",
        'object'  => "string",
        'value'   => "string",
    ])]
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