<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Entity\Term;

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