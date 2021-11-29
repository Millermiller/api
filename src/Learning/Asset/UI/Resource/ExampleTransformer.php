<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Example;

/**
 * Class ExampleTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class ExampleTransformer extends TransformerAbstract
{

    #[Pure]
    #[ArrayShape(['id' => "int|null", 'text' => "string", 'value' => "string"])]
    public function transform(Example $example): array
    {
        return [
            'id'    => $example->getId(),
            'text'  => $example->getText(),
            'value' => $example->getValue(),
        ];
    }
}