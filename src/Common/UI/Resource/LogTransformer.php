<?php


namespace Scandinaver\Common\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Entity\Log;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class LogTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class LogTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'owner',
    ];

    #[ArrayShape([
        'id'         => "int",
        'message'    => "string",
        'level'      => "string",
        'extra'      => "array|null",
        'created_at' => "string",
    ])]
    public function transform(Log $log): array
    {
        return [
            'id'         => $log->getId(),
            'message'    => $log->interpolate(),
            'level'      => $log->getLevelName(),
            'extra'      => $log->getExtra(),
            'created_at' => $log->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    public function includeOwner(Log $log): \League\Fractal\Resource\NullResource|Item
    {
        $owner = $log->getOwner();

        if ($owner !== NULL) {
            return $this->item($owner, new UserTransformer());
        }

        return $this->null();
    }
}