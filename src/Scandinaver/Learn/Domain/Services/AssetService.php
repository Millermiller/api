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

    /**
     * AssetService constructor.
     *
     * @param  AssetRepositoryInterface          $assetsRepository
     * @param  ResultRepositoryInterface         $resultRepository
     * @param  AssetRepositoryInterface          $assetRepository
     * @param  PersonalAssetRepositoryInterface  $personalAssetRepository
     */
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

    /**
     * @param  Language  $language
     * @param  User      $user
     * @param  string    $title
     *
     * @return Asset
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Language $language, User $user, string $title): Asset
    {
        $asset = new PersonalAsset($title, 0,  0, $language);
        $asset->setLevel(0);
        $result = new Result($asset, $user, $language);
        $result->setValue(0);
        $user->incrementAssetCounter();

        app('em')->persist($asset);
        app('em')->persist($result);
        app('em')->flush();

        return $asset;
    }

    /**
     * @param  Language  $language
     * @param  int       $asset_id
     *
     * @return Asset
     */
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
     * @return void
     */
    public function delete(Asset $asset): void
    {
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        $repository->delete($asset);
    }

    /**
     * @param  Language  $language
     * @param  int       $type
     *
     * @return array
     */
    public function getAssets(Language $language, int $type): array
    {
        return $this->assetRepository->getAssetsByType($language, $type);
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

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return array
     */
    public function getPersonalAssets(Language $language, User $user): array
    {
        return $this->personalAssetRepository->getCreatedAssets($language, $user);
    }

    /**
     * @param  Language  $language
     * @param  User      $user
     * @param  Asset     $asset
     *
     * @return Asset
     */
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

    /**
     * @param  Language              $language
     * @param  Authenticatable|User  $user
     * @param  Asset                 $asset
     * @param  int                   $resultValue
     *
     * @return Result
     */
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

    /**
     * @param  Asset  $asset
     * @param  array  $data
     *
     * @return Asset
     */
    public function updateAsset(Asset $asset, array $data): Asset
    {
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        return $repository->update($asset, $data);
    }
}