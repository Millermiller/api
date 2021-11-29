<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Translate;

/**
 * Class TranslateTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class TranslateTransformer extends TransformerAbstract
{

    #[Pure]
    #[ArrayShape(['id' => "int", 'value' => "string"])]
    public function transform(Translate $translate): array
    {
        return [
            'id'    => $translate->getId(),
            'value' => $translate->getValue(),
        ];
    }
}