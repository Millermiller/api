<?php


namespace Scandinaver\Learn\Domain\Services;


use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\User\Domain\Model\User;

class AssetFactory
{
    public static function build(array $data): Asset
    {
        $asset = new PersonalAsset($data['title'], 0, 0, $data['language']);
        $asset->setLevel(0);

        /** @var User $user */
        $user = $data['user'];
        $user->incrementAssetCounter();

        $result = new Result($asset, $user, $data['language']);
        $result->setValue(0);

        return $asset;
    }
}