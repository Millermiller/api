<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Exception;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\DTO\AssetDTO;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Domain\Entity\PersonalAsset;
use Scandinaver\Learning\Asset\Domain\Entity\SentenceAsset;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

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

        $asset = match ($type) {
            AssetType::WORDS     => new WordAsset($assetDTO->getTitle(), $language),
            AssetType::SENTENCES => new SentenceAsset($assetDTO->getTitle(), $language),
            AssetType::PERSONAL  => new PersonalAsset($assetDTO->getTitle(), $language),
            default              => throw new Exception('undefined type'),
        };


        $asset->setLanguage($language);

        $asset->setOwner($assetDTO->getOwner());

        $isLevelSet = $assetDTO->getLevel() !== NULL;
        if ($isLevelSet) {
            $asset->setLevel($assetDTO->getLevel());
        }
        else {
            $repository = AssetRepositoryFactory::getByType($type);
            $level = $repository->getLastLevel($language)?->getLevel();
            $asset->setLevel($level ?? 1);
        }

        return $asset;
    }
}