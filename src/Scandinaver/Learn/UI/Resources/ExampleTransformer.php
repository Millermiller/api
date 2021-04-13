<?php


namespace Scandinaver\Learn\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Model\Example;

/**
 * Class ExampleTransformer
 *
 * @package Scandinaver\Learn\UI\Resources
 */
class ExampleTransformer extends TransformerAbstract
{
    public function transform(Example $example): array
    {
        return [

        ];
    }
}