<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Term;

/**
 * Class CardTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class TermTransformer extends TransformerAbstract
{

    #[Pure]
    #[ArrayShape(['id' => "int", 'value' => "string"])]
    public function transform(Term $term): array
    {
        return [
            'id'    => $term->getId(),
            'value' => $term->getValue(),
        ];
    }
}