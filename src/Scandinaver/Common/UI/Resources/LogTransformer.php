<?php


namespace Scandinaver\Common\UI\Resources;


use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Model\Log;

/**
 * Class LogTransformer
 *
 * @package Scandinaver\Common\UI\Resources
 */
class LogTransformer extends TransformerAbstract
{
    public function transform(Log $log): array
    {
        return [
            'id'         => $log->getId(),
            'message'    => $log->interpolate(),
            'owner'      => $log->getOwner(),
            'level'      => $log->getLevelName(),
            'extra'      => $log->getExtra(),
            'created_at' => $log->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}