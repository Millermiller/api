<?php


namespace Scandinaver\Common\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Entity\Feedback;

/**
 * Class FeedbackTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class FeedbackTransformer extends TransformerAbstract
{

    #[ArrayShape([
        'id'        => "int",
        'name'      => "string",
        'message'   => "string",
        'createdAt' => "string",
    ])]
    public function transform(Feedback $feedback): array
    {
        return [
            'id'        => $feedback->getId(),
            'name'      => $feedback->getName(),
            'message'   => $feedback->getMessage(),
            'createdAt' => $feedback->getCreatedAt()->format('d.m.Y H:i:s'),
        ];
    }
}