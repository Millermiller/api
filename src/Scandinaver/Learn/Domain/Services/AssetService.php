<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\{Asset, AssetDTO, SentenceAsset, WordAsset};
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
    use CardTrait;
    use LanguageTrait;

    protected PassingRepositoryInterface $passingRepository;

    private AssetRepositoryInterface $assetRepository;

    private PersonalAssetRepositoryInterface $personalAssetRepository;

    public function __construct(
        PassingRepositoryInterface $passingRepository,
        AssetRepositoryInterface $assetRepository,
        PersonalAssetRepositoryInterface $personalAssetRepository
    ) {
        $this->passingRepository        = $passingRepository;
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
     * @param  User   $user
     * @param  array  $data
     *
     * @return AssetDTO
     * @throws LanguageNotFoundException
     * @throws Exception
     */
    public function create(User $user, array $data): AssetDTO
    {
        $language = $this->getLanguage($data['language']);

        $data = [
            'title'    => $data['title'],
            'language' => $language,
            'user'     => $user,
            'basic'    => $data['basic'],
            'level'    => $data['level'],
            'type'     => $data['type']
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
     * @param  int  $id
     *
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(int $id): void
    {
        $asset      = $this->getAsset($id);
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

        $personalAssets = $user->getPersonalAssets($language);
        $personalData = [];
        foreach ($personalAssets as $personalAsset) {
            $dto = $personalAsset->toDTO();

            if ($user->isPremium()) {
                $dto->setActive(TRUE);
                $dto->setAvailable(TRUE);
            }

            if ($personalAsset->isFavorite()) {
                $dto->setActive(TRUE);
                $dto->setAvailable(TRUE);
            }

            $result = $personalAsset->getBestResultForUser($user);
            $dto->setBestResult($result);

            $personalData[] = $dto;
        }

        return $personalData;
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

        $activeArray  = $this->passingRepository->getActiveIds($user, $language);
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

    /**
     * @param  User  $user
     * @param  int   $asset
     * @param  int   $card
     *
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     * @throws CardAlreadyAddedException
     */
    public function addCard(User $user, int $asset, int $card)
    {
        $asset = $this->getAsset($asset);
        $card  = $this->getCard($card);

        $repository = AssetRepositoryFactory::getByType($asset->getType());

        $asset->addCard($card);

        $repository->save($asset);

        return $asset->toDTO();
    }

    /**
     * @param  int  $asset
     * @param  int  $card
     *
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     */
    public function removeCard(int $asset, int $card)
    {
        $asset = $this->getAsset($asset);
        $card  = $this->getCard($card);

        $asset->removeCard($card);
        $this->assetRepository->save($asset);
    }
}