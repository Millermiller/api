<?php


namespace Scandinaver\Common\UI\Resource;


use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class LogTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class LogTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'owner'
    ];

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

    public function includeOwner(Log $log): ?Item
    {
        $owner = $log->getOwner();

        if ($owner !== NULL) {
            return $this->item($owner, new UserTransformer());
        }
         return NULL;
    }
}