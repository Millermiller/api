<?php


namespace Scandinaver\Learn\Domain\Service;

use Exception;
use Scandinaver\Common\Domain\Service\LanguageTrait;
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
    use LanguageTrait;

    /**
     * @param  AssetDTO  $assetDTO
     *
     * @return Asset
     * @throws Exception
     */
    public function fromDTO(AssetDTO $assetDTO): Asset
    {
        $type = $assetDTO->getType();

        $languageId = $assetDTO->getLanguageLetter();
        $language = $this->getLanguage($languageId);

        switch ($type) {
            case Asset::TYPE_WORDS:
                $asset = new WordAsset($assetDTO->getTitle(), $assetDTO->isBasic(), 0, $language);
                break;
            case Asset::TYPE_SENTENCES:
                $asset = new SentenceAsset($assetDTO->getTitle(), $assetDTO->isBasic(), 0, $language);
                break;
            case Asset::TYPE_PERSONAL:
                $asset = new PersonalAsset($assetDTO->getTitle(), $assetDTO->isBasic(), 0, $language);
                break;
            default:
                throw new Exception('undefined type');
        }


        $asset->setLanguage($language);

        $asset->setOwner($assetDTO->getOwner());
        $asset->setLevel($assetDTO->getLevel());
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