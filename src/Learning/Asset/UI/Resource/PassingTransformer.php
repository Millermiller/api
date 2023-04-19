<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class PassingTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class PassingTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        'user',
        'asset',
    ];


    #[ArrayShape([
        'id'        => "int",
        'percent'   => "int",
        'completed' => "bool",
        'time'      => "int",
        'errors'    => "array",
    ])]
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

        return new Item($user, new UserTransformer(), 'user');
    }

    public function includeAsset(Passing $passing): Item
    {
        $asset = $passing->getSubject();

        return new Item($asset, new AssetTransformer(), 'asset');
    }
}