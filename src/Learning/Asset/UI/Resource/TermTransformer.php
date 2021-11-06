<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Term;

/**
 * Class CardTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class TermTransformer extends TransformerAbstract
{
    /**
     * @param  Term  $term
     *
     * @return array
     */
    public function transform(Term $term): array
    {
        return [
            'id'    => $term->getId(),
            'value' => $term->getValue(),
        ];
    }
}