<?php


namespace Scandinaver\Common\UI\Resource;


use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Model\Feedback;

/**
 * Class FeedbackTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class FeedbackTransformer extends TransformerAbstract
{

    public function transform(Feedback $feedback): array
    {
        return [
            'id'        => $feedback->getId(),
            'name'      => $feedback->getName(),
            'message'   => $feedback->getMessage(),
            'createdAt' => $feedback->getCreatedAt()->format('d.m.Y'),
        ];
    }
}