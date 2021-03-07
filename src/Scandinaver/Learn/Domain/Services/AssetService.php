<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\{Asset, AssetDTO, Result, SentenceAsset, WordAsset};
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetService implements BaseServiceInterface
{

    use AssetTrait;
    use LanguageTrait;

    protected ResultRepositoryInterface $resultRepository;

    private AssetRepositoryInterface $assetRepository;

    private PersonalAssetRepositoryInterface $personalAssetRepository;

    public function __construct(
        ResultRepositoryInterface $resultRepository,
        AssetRepositoryInterface $assetRepository,
        PersonalAssetRepositoryInterface $personalAssetRepository
    ) {
        $this->resultRepository        = $resultRepository;
        $this->assetRepository         = $assetRepository;
        $this->personalAssetRepository = $personalAssetRepository;
    }

    /**
     * @param  string  $language
     *
     * @return int
     * @throws LanguageNotFoundException
     */
    public function count(string $language): int
    {
        $language = $this->getLanguage($language);

        return $this->assetRepository->getCountByLanguage($language);
    }

    /**
     * @param  string  $language
     * @param  User    $user
     * @param  string  $title
     *
     * @return AssetDTO
     * @throws LanguageNotFoundException
     */
    public function create(
        string $language,
        User $user,
        string $title
    ): AssetDTO {
        $language = $this->getLanguage($language);

        $data = [
            'title'    => $title,
            'language' => $language,
            'user'     => $user,
        ];

        $asset = AssetFactory::build($data);

        $this->assetRepository->save($asset);

        return $asset->toDTO();
    }

    /**
     * @param  string  $language
     * @param  int     $type
     *
     * @return Asset
     * @throws LanguageNotFoundException|BindingResolutionException
     * @throws Exception
     */
    public function addBasic(string $language, int $type): Asset
    {
        $language = $this->getLanguage($language);

        switch ($type) {
            case Asset::TYPE_WORDS:
                $asset = new WordAsset('New asset', 1, 0, $language);
                break;
            case Asset::TYPE_SENTENCES:
                $asset = new SentenceAsset('New asset', 1, 0, $language);
                break;
            default:
                throw new Exception('undefined type');
        }

        $repository = AssetRepositoryFactory::getByType($type);

        /** @var Asset $lastAsset */
        $lastAsset = $repository->getLastAsset($language, $type);
        if ($lastAsset === NULL) {
            $level = 1;
        }
        else {
            $level = $lastAsset->getLevel() + 1;
        }

        $asset->setLevel($level);

        $this->assetRepository->save($asset);

        return $asset;
    }

    /**
     * @param  int  $asset
     *
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(int $asset): void
    {
        $asset      = $this->getAsset($asset);
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        $asset->delete();
        $repository->delete($asset);
    }

    /**
     * @param  string  $language
     * @param  int     $type
     *
     * @return array
     * @throws LanguageNotFoundException|BindingResolutionException
     */
    public function getAssets(string $language, int $type): array
    {
        $result     = [];
        $language   = $this->getLanguage($language);
        $repository = AssetRepositoryFactory::getByType($type);

        /** @var Asset[] $assets */
        $assets = $repository->getByLanguage($language);
        foreach ($assets as $asset) {
            $result[] = $asset->toDTO();
        }

        return $result;
    }

    /**
     * @param  string  $language
     * @param  User    $user
     * @param  int     $type
     *
     * @return array
     * @throws LanguageNotFoundException|BindingResolutionException
     */
    public function getAssetsByType(string $language, User $user, int $type): array
    {
        $language = $this->getLanguage($language);

        $repository = AssetRepositoryFactory::getByType($type);

        $assets = $repository->getByLanguage($language);

        $data = [];

        $isNextAssetAvailable = FALSE;

        /** @var Asset $asset */
        foreach ($assets as &$asset) {

            $dto = $asset->toDTO();

            $result = $asset->getBestResultForUser($user);
            $dto->setBestResult($result);

            if ($asset->isFirstAsset() || $isNextAssetAvailable) {
                $dto->setActive(TRUE);
            }

            $isNextAssetAvailable = $asset->isCompletedByUser($user);

            if ($asset->getLevel() <= 10 || $user->isPremium()) { // TODO: implement settings
                $dto->setAvailable(TRUE);
            }

            $data[] = $dto;
        }

        return $data;
    }

    /**
     * @param  string  $language
     * @param  User    $user
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function getPersonalAssets(string $language, User $user): array
    {
        $language = $this->getLanguage($language);

        $createdAssets  = $user->getCreatedAssets($language);
        $favouriteAsset = $user->getFavouriteAsset($language);

        array_unshift($createdAssets, $favouriteAsset->toDTO());

        return $createdAssets;
    }

    /**
     * @param  User  $user
     * @param  int   $asset
     *
     * @return Asset
     * @throws AssetNotFoundException
     */
    public function giveNextLevel(User $user, int $asset): Asset
    {
        $asset = $this->getAsset($asset);

        $nextAsset = $this->assetRepository->getNextAsset($asset);

        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'asset' => $asset]
        );

        if ($result === NULL) {
            $result = new Result($nextAsset, $user, $asset->getLanguage());
        }

        $this->resultRepository->save($result);

        return $nextAsset;
    }

    /**
     * @param  User   $user
     * @param  int    $asset
     * @param  array  $data
     *
     * @return Result
     * @throws AssetNotFoundException
     */
    public function saveTestResult(User $user, int $asset, array $data): Result
    {
        $asset = $this->getAsset($asset);

        $minPercent = 80; //TODO: implement settings

        $completed = $data['percent'] >= $minPercent;

        $payload = [
            'time'   => $data['time'],
            'errors' => $data['errors'] ?? [],
        ];

        $data['payload'] = $payload;

        $result = new Result($asset, $user, $completed, $data);

        return $this->resultRepository->save($result);
    }

    /**
     * @param  int    $asset
     * @param  array  $data
     *
     * @return AssetDTO
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateAsset(int $asset, array $data): AssetDTO
    {
        $asset      = $this->getAsset($asset);
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        /** @var  Asset $asset */
        $asset = $repository->update($asset, $data);

        return $asset->toDTO();
    }

    /**
     * @param  string  $language
     * @param  User    $user
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function getAssetsForApp(string $language, User $user): array
    {
        $language = $this->getLanguage($language);

        $assets = [];

        $activeArray  = $this->resultRepository->getActiveIds($user, $language);
        $personalData = $user->getCreatedAssets($language);
        $publicData   = $this->assetRepository->getPublicAssets($language);

        $data = $publicData + $personalData;

        $counter = [
            Asset::TYPE_WORDS     => 0,
            Asset::TYPE_SENTENCES => 0,
            Asset::TYPE_PERSONAL  => 0,
            Asset::TYPE_FAVORITES => 0,
        ];

        foreach ($data as $item) {
            $cards = [];

            /** @var Asset $item */
            foreach ($item->getCards() as $card) {
                $word = $card->getWord();

                if ($word === NULL) {
                    continue;
                }

                $cards[] = [
                    'id'       => $card->getId(),
                    'word'     => $word->getValue(),
                    'trans'    => preg_replace(
                        '/^(\d\\)\s)/',
                        '',
                        $card->getTranslate()->getValue()
                    ),
                    'asset_id' => $item->getId(),
                    'examples' => $card->getExamples()->map(
                        fn($example) => [
                            'id'      => $example->getId(),
                            'card_id' => $example->getCard()->getId(),
                            'text'    => $example->getText(),
                            'value'   => $example->getValue(),
                        ]
                    )->toArray(),
                ];
            }

            $asset = [
                'id'     => $item->getId(),
                'active' => in_array($item->getId(), $activeArray),
                'count'  => $item->getCards()->count(),
                'result' => 0,
                'level'  => $item->getLevel(),
                'title'  => $item->getTitle(),
                'type'   => $item->getType(),
                'basic'  => $item->getBasic(),
                'cards'  => $cards,
            ];

            $counter[$item->getType()] = $counter[$item->getType()] + 1;

            if ((in_array(
                        $item->getType(),
                        [Asset::TYPE_WORDS, Asset::TYPE_SENTENCES]
                    )
                    && $counter[$item->getType()] < 10)
                || $user->isPremium()
                || in_array(
                    $item->getType(),
                    [Asset::TYPE_FAVORITES, Asset::TYPE_PERSONAL]
                )
            ) {
                $asset['available'] = TRUE;
            }
            else {
                $asset['available'] = FALSE;
            }

            $assets[] = $asset;
        }

        return $assets;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function one(int $id): DTO
    {
        // TODO: Implement one() method.
    }

}