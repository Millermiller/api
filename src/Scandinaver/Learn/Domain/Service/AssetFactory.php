<?php


namespace Scandinaver\Learn\Domain\Service;

use Exception;
use Scandinaver\Learn\Domain\DTO\AssetDTO;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\SentenceAsset;
use Scandinaver\Learn\Domain\Model\WordAsset;

/**
 * Class AssetFactory
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetFactory
{
    /**
     * @param  AssetDTO  $dto
     *
     * @return Asset
     * @throws Exception
     */
    public static function fromDTO(AssetDTO $dto): Asset
    {
        $type = $dto->getType();

        switch ($type) {
            case Asset::TYPE_WORDS:
                $asset = new WordAsset($dto->getTitle(), $dto->isBasic(), 0, $dto->getLanguage());
                break;
            case Asset::TYPE_SENTENCES:
                $asset = new SentenceAsset($dto->getTitle(), $dto->isBasic(), 0, $dto->getLanguage());
                break;
            case Asset::TYPE_PERSONAL:
                $asset = new PersonalAsset($dto->getTitle(), $dto->isBasic(), 0, $dto->getLanguage());
                break;
            default:
                throw new Exception('undefined type');
        }

        $asset->setOwner($dto->getOwner());
        $asset->setLevel($dto->getLevel());
        $asset->setType($type);

        return $asset;
    }

    /**
     * @param  Asset  $asset
     *
     * @return AssetDTO
     */
    public static function toDTO(Asset $asset): AssetDTO
    {
        $assetDTO = new AssetDTO();

        $assetDTO->setId($asset->getId());
        $assetDTO->setTitle($asset->getTitle());
        $assetDTO->setType($asset->getType());
        $assetDTO->setLevel($asset->getLevel());
        $assetDTO->setLanguage($asset->getLanguage());
        $assetDTO->setBasic($asset->getBasic());

        $cardsDTOs = $asset->getCards()->map(fn($card) => CardFactory::toDTO($card))->toArray();
        $assetDTO->setCards($cardsDTOs);

        return $assetDTO;
    }
}