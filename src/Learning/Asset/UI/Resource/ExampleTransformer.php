<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Example;

/**
 * Class ExampleTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class ExampleTransformer extends TransformerAbstract
{

    public function transform(Example $example): array
    {
        return [
            'id'    => $example->getId(),
            'text'  => $example->getText(),
            'value' => $example->getValue(),
        ];
    }
}