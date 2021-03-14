<?php


namespace Scandinaver\Learn\Domain\Services;


use Exception;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\SentenceAsset;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetFactory
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetFactory
{
    /**
     * @param  array  $data
     *
     * @return Asset
     * @throws Exception
     */
    public static function build(array $data): Asset
    {
        $type = $data['type'];

        switch ($type) {
            case Asset::TYPE_WORDS:
                $asset = new WordAsset($data['title'], $data['basic'], 0, $data['language']);
                break;
            case Asset::TYPE_SENTENCES:
                $asset = new SentenceAsset($data['title'], $data['basic'], 0, $data['language']);
                break;
            case Asset::TYPE_PERSONAL:
                $asset = new PersonalAsset($data['title'], $data['basic'], 0, $data['language']);
                break;
            default:
                throw new Exception('undefined type');
        }

        $asset->setOwner($data['user']);
        $asset->setLevel($data['level']);
        $asset->setType($data['type']);

        /** @var User $user */
        $user = $data['user'];
        $user->incrementAssetCounter();

        return $asset;
    }
}