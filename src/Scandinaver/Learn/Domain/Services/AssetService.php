<?php


namespace Scandinaver\Learn\Domain\Services;

use Exception;
use Scandinaver\Common\Domain\Language;
use Scandinaver\User\Domain\User;
use Doctrine\ORM\{ORMException, OptimisticLockException};
use Illuminate\Contracts\Auth\Authenticatable;
use Scandinaver\Learn\Domain\{Asset, Result};
use Scandinaver\Learn\Domain\Contracts\{AssetRepositoryInterface, ResultRepositoryInterface};

/**
 * Class AssetService
 * @package app\Services
 */
class AssetService
{
    /**
     * @var AssetRepositoryInterface
     */
    protected $assetsRepository;

    /**
     * @var ResultRepositoryInterface
     */
    protected $resultRepository;

    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;

    /**
     * AssetService constructor.
     * @param AssetRepositoryInterface  $assetsRepository
     * @param ResultRepositoryInterface $resultRepository
     * @param AssetRepositoryInterface  $assetRepository
     */
    public function __construct(
        AssetRepositoryInterface  $assetsRepository,
        ResultRepositoryInterface $resultRepository,
        AssetRepositoryInterface  $assetRepository
    )
    {
        $this->assetsRepository = $assetsRepository;
        $this->resultRepository = $resultRepository;
        $this->assetRepository  = $assetRepository;
    }

    /**
     * @param Language $language
     * @return int
     */
    public function count(Language $language): int
    {
        return $this->assetsRepository->getCountByLanguage($language);
    }

    /**
     * @param Language $language
     * @param User $user
     * @param string $title
     * @return Asset
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Language $language, User $user, string $title): Asset
    {
        $asset  = new Asset($title, 0, Asset::TYPE_PERSONAL, 0, $language);
        $result = new Result($asset, $user, $language);
        $user->incrementAssetCounter();

        app('em')->persist($asset);
        app('em')->persist($result);
        app('em')->flush();

        return $asset;
    }

    /**
     * @param Language $language
     * @param int $asset_id
     * @return Asset
     */
    public function addBasic(Language $language, int $asset_id): Asset
    {
        $asset  = new Asset($asset_id, 1, $asset_id, 0, $language);

        $asset->setLevel($this->assetRepository->getLastAsset($language, $asset_id)->getLevel() + 1);

        $this->assetRepository->save($asset);

        return $asset;
    }

    /**
     * @param Asset $asset
     * @return void
     */
    public function delete(Asset $asset): void
    {
        $this->assetsRepository->delete($asset);
    }

    /**
     * Возвращает массив словарей определенного типа для пользователя
     *
     * @param Language $language
     * @param User $user
     * @param int $type
     * @return array
     * @throws Exception
     */
    public function getAssetsByType(Language $language, User $user, int $type)
    {
        $activeArray = $this->resultRepository->getActiveIds($user,  $language);
        $assets      = $this->assetsRepository->getAssetsByType($language, $type);

        $canopen  = true;
        $testlink = false;
        $counter  = 0;

        /** @var Asset $asset */
        foreach($assets as &$asset) {
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
                    'result' => $this->resultRepository->getResult($user,  $asset)->getValue(),
                    'type' => $asset->getType()
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
                    'type' => $asset->getType()
                ];
                $canopen = false;
            }

            if($counter < 10 || $user->isPremium())
                $asset['available'] = true;
            else
                $asset['available'] = false;

            $testlink = $asset['id'];
        }

        return $assets;
    }

    /**
     * @param Language $language
     * @param User $user
     * @return array
     */
    public function getPersonalAssets(Language $language,User $user): array
    {
        return $this->assetRepository->getCreatedAssets($language, $user);
    }

    /**
     * @param Language $language
     * @param User $user
     * @param Asset $asset
     * @return Asset
     */
    public function giveNextLevel(Language $language, User $user, Asset $asset): Asset
    {
        $nextAsset = $this->assetsRepository->getNextAsset($asset, $language);

        $result = $this->resultRepository->findOneBy(['user' => $user, 'asset' => $asset]);

        if($result === null) $result = new Result($nextAsset, $user, $language);

        $this->resultRepository->save($result);

        return $nextAsset;
    }

    /**
     * @param Language $language
     * @param Authenticatable|User $user
     * @param Asset $asset
     * @param int $resultValue
     * @return Result
     */
    public function saveTestResult(Language $language, User $user, Asset $asset, int $resultValue): Result
    {
        $result = $this->resultRepository->findOneBy(['user' => $user, 'asset' => $asset]);

        if($result === null) $result = new Result($asset, $user, $language);

        $result->setValue($resultValue);

        return $this->resultRepository->save($result);
    }

    /**
     * @param Asset $asset
     * @param array $data
     * @return Asset
     */
    public function updateAsset(Asset $asset, array $data): Asset
    {
        return $this->assetsRepository->update($asset, $data);
    }
}