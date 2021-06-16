<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Entity\Passing;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class PassingTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class PassingTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user',
        'asset',
    ];

    /**
     * @param  Passing  $passing
     *
     * @return array
     */
    public function transform(Passing $passing): array
    {
        return [
            'id'        => $passing->getId(),
            'percent'   => $passing->getPercent(),
            'completed' => $passing->isCompleted(),
            'time'      => $passing->getTime(),
            'errors'    => $passing->getErrors(),
        ];
    }

    public function includeUser(Passing $passing): Item
    {
        $user = $passing->getUser();

        return new Item($user, new UserTransformer());
    }

    public function includeAsset(Passing $passing): Item
    {
        $asset = $passing->getAsset();

        return new Item($asset, new AssetTransformer());
    }
}