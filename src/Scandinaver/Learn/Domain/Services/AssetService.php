<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Exception;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\{Asset, PersonalAsset, Result};
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\AssetRepository;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetService
{
    protected AssetRepositoryInterface $assetsRepository;

    protected ResultRepositoryInterface $resultRepository;

    private AssetRepositoryInterface $assetRepository;

    private PersonalAssetRepositoryInterface $personalAssetRepository;

    public function __construct(
        AssetRepositoryInterface $assetsRepository,
        ResultRepositoryInterface $resultRepository,
        AssetRepositoryInterface $assetRepository,
        PersonalAssetRepositoryInterface $personalAssetRepository
    ) {
        $this->assetsRepository = $assetsRepository;
        $this->resultRepository = $resultRepository;
        $this->assetRepository = $assetRepository;
        $this->personalAssetRepository = $personalAssetRepository;
    }

    public function count(Language $language): int
    {
        return $this->assetsRepository->getCountByLanguage($language);
    }


    public function create(Language $language, User $user, string $title): Asset
    {
        $data = [
            'title' => $title,
            'language' => $language,
            'user' => $user,
        ];

        $asset = AssetFactory::build($data);

        $this->assetRepository->save($asset);

        return $asset;
    }

    public function addBasic(Language $language, int $asset_id): Asset
    {
        $asset = new Asset($asset_id, 1, $asset_id, 0, $language);

        $asset->setLevel(
            $this->assetRepository->getLastAsset($language, $asset_id)->getLevel() + 1
        );

        $this->assetRepository->save($asset);

        return $asset;
    }

    /**
     * @param  Asset  $asset
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Asset $asset): void
    {
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        $repository->delete($asset);
    }

    public function getAssets(Language $language, int $type): array
    {
        $repository = AssetRepositoryFactory::getByType($type);

        return $repository->getByLanguage($language);
    }

    public function getAssetsByType(Language $language, User $user, int $type): array
    {
        $activeArray = $this->resultRepository->getActiveIds($user, $language);

        $repository = AssetRepositoryFactory::getByType($type);

        $assets = $repository->getByLanguage($language);

        $canopen = true;
        $testlink = false;
        $counter = 0;

        /** @var Asset $asset */
        foreach ($assets as &$asset) {
            $counter++;
            if (in_array($asset->getId(), $activeArray)) {
                $asset = [
                    'count' => $asset->getCards()->count(),
                    'title' => $asset->getTitle(),
                    'id' => $asset->getId(),
                    'level' => $asset->getLevel(),
                    'active' => true,
                    'testlink' => false,
                    'canopen' => false,
                    'result' => $this->resultRepository->getResult(
                        $user,
                        $asset
                    )->getValue(),
                    'type' => $asset->getType(),
                ];
            } else {
                $asset = [
                    'count' => $asset->getCards()->count(),
                    'title' => $asset->getTitle(),
                    'id' => $asset->getId(),
                    'level' => $asset->getLevel(),
                    'active' => false,
                    'canopen' => $canopen,
                    'testlink' => $testlink,
                    'result' => 0,
                    'type' => $asset->getType(),
                ];
                $canopen = false;
            }

            if ($counter < 10 || $user->isPremium()) {
                $asset['available'] = true;
            } else {
                $asset['available'] = false;
            }

            $testlink = $asset['id'];
        }

        return $assets;
    }

    public function getPersonalAssets(Language $language, User $user): array
    {
        return $this->personalAssetRepository->getCreatedAssets($language, $user);
    }

    public function giveNextLevel(
        Language $language,
        User $user,
        Asset $asset
    ): Asset {
        $nextAsset = $this->assetsRepository->getNextAsset($asset, $language);

        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'asset' => $asset]
        );

        if ($result === null) {
            $result = new Result($nextAsset, $user, $language);
        }

        $this->resultRepository->save($result);

        return $nextAsset;
    }

    public function saveTestResult(
        Language $language,
        User $user,
        Asset $asset,
        int $resultValue
    ): Result {
        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'asset' => $asset]
        );

        if ($result === null) {
            $result = new Result($asset, $user, $language);
        }

        $result->setValue($resultValue);

        return $this->resultRepository->save($result);
    }

    public function updateAsset(Asset $asset, array $data): Asset
    {
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        return $repository->update($asset, $data);
    }

    public function getAssetsForApp(Language $language, User $user): array
    {
        $assets = [];

        $activeArray = $this->resultRepository->getActiveIds($user, $language);
        $personaldata = $this->personalAssetRepository->getCreatedAssets(
            $language,
            $user
        );
        $publicdata = $this->assetsRepository->getPublicAssets($language);

        $data = $publicdata + $personaldata;

        $counter = [
            Asset::TYPE_WORDS => 0,
            Asset::TYPE_SENTENCES => 0,
            Asset::TYPE_PERSONAL => 0,
            Asset::TYPE_FAVORITES => 0,
        ];

        foreach ($data as $item) {
            $cards = [];

            /** @var Asset $item */
            foreach ($item->getCards() as $card) {
                $word = $card->getWord();

                if ($word === null) {
                    continue;
                }

                $cards[] = [
                    'id' => $card->getId(),
                    'word' => $word->getValue(),
                    'trans' => preg_replace(
                        '/^(\d\\)\s)/',
                        '',
                        $card->getTranslate()->getValue()
                    ),
                    'asset_id' => $item->getId(),
                    'examples' => $card->getExamples()->map(fn($example) => [
                        'id' => $example->getId(),
                        'card_id' => $example->getCard()->getId(),
                        'text' => $example->getText(),
                        'value' => $example->getValue(),
                    ])->toArray(),
                ];
            }

            $asset = [
                'id' => $item->getId(),
                'active' => in_array($item->getId(), $activeArray),
                'count' => $item->getCards()->count(),
                'result' => 0,
                'level' => $item->getLevel(),
                'title' => $item->getTitle(),
                'type' => $item->getType(),
                'basic' => $item->getBasic(),
                'cards' => $cards,
            ];

            $counter[$item->getType()] = $counter[$item->getType()] + 1;

            if ((in_array(
                        $item->getType(),
                        [Asset::TYPE_WORDS, Asset::TYPE_SENTENCES]
                    ) && $counter[$item->getType()] < 10) || $user->isPremium() || in_array(
                    $item->getType(),
                    [Asset::TYPE_FAVORITES, Asset::TYPE_PERSONAL]
                )) {
                $asset['available'] = true;
            } else {
                $asset['available'] = false;
            }

            $assets[] = $asset;
        }

        return $assets;
    }
}