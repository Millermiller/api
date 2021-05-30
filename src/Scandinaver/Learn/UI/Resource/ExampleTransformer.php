<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Model\Example;

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