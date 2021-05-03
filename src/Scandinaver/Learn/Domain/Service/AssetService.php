<?php


namespace Scandinaver\Learn\Domain\Service;

use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\DTO\AssetDTO;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\{Asset, FavouriteAsset, PersonalAsset, SentenceAsset, WordAsset};
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

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

    private UserRepositoryInterface $userRepository;

    private LoggerInterface $logger;

    private LanguageService $languageService;

    public function __construct(
        PassingRepositoryInterface $passingRepository,
        AssetRepositoryInterface $assetRepository,
        PersonalAssetRepositoryInterface $personalAssetRepository,
        UserRepositoryInterface $userRepository,
        LoggerInterface $logger,
        LanguageService $languageService
    ) {
        $this->passingRepository       = $passingRepository;
        $this->assetRepository         = $assetRepository;
        $this->personalAssetRepository = $personalAssetRepository;
        $this->userRepository          = $userRepository;
        $this->logger                  = $logger;
        $this->languageService         = $languageService;
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
     * @param  UserInterface  $user
     * @param  array          $data
     *
     * @return Asset
     * @throws LanguageNotFoundException
     * @throws Exception
     */
    public function create(UserInterface $user, array $data): Asset
    {
        $language = $this->getLanguage($data['language']);

        $assetDTO = new AssetDTO();

        $assetDTO->setTitle($data['title']);
        $assetDTO->setLanguage($language);
        $assetDTO->setBasic((bool)$data['basic']);
        $assetDTO->setType($data['type']);
        $assetDTO->setLevel($data['level']);
        if ((bool)$data['basic'] === FALSE) {
            $assetDTO->setUser($user);
        }

        $asset = AssetFactory::fromDTO($assetDTO);

        $this->assetRepository->save($asset);

        return $asset;
    }

    /**
     * @param  int  $id
     *
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
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
        $language   = $this->getLanguage($language);
        $repository = AssetRepositoryFactory::getByType($type);

        /** @var Asset[] $assets */
        $assets = $repository->getByLanguage($language);

        return $assets;
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     * @param  int            $type
     *
     * @return array|AssetDTO[]
     * @throws LanguageNotFoundException|BindingResolutionException
     */
    public function getAssetsByType(string $language, UserInterface $user, int $type): array
    {
        $language = $this->getLanguage($language);

        $repository = AssetRepositoryFactory::getByType($type);

        $assets = $repository->getByLanguage($language);

        $data = [];

        $isNextAssetAvailable = FALSE;

        /** @var Asset $asset */
        foreach ($assets as $asset) {

            $assetDTO = AssetFactory::toDTO($asset);

            $result = $asset->getBestResultForUser($user);
            $assetDTO->setBestResult($result);

            if ($asset->isFirstAsset() || $isNextAssetAvailable) {
                $assetDTO->setActive(TRUE);
            }

            $assetDTO->setCompleted($asset->isCompletedByUser($user));
            $isNextAssetAvailable = $asset->isCompletedByUser($user);

            if ($asset->getLevel() <= 5 || $user->isPremium()) { // TODO: implement settings
                $assetDTO->setAvailable(TRUE);
            }

            $data[] = $assetDTO;
        }

        return $data;
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     *
     * @return array|AssetDTO[]
     * @throws LanguageNotFoundException
     */
    public function getPersonalAssets(string $language, UserInterface $user): array
    {
        $language = $this->getLanguage($language);

        $personalAssets = $user->getPersonalAssets($language);
        $personalData   = [];
        foreach ($personalAssets as $personalAsset) {

            $assetDTO = AssetFactory::toDTO($personalAsset);

            if ($user->isPremium()) {
                $assetDTO->setActive(TRUE);
                $assetDTO->setAvailable(TRUE);
            }

            if ($personalAsset->isFavorite()) {
                $assetDTO->setActive(TRUE);
                $assetDTO->setAvailable(TRUE);
            }

            $result = $personalAsset->getBestResultForUser($user);
            $assetDTO->setBestResult($result);

            $personalData[] = $assetDTO;
        }

        return $personalData;
    }

    /**
     * @param  UserInterface  $user
     * @param  int            $asset
     * @param  array          $data
     *
     * @return AssetDTO
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateAsset(UserInterface $user, int $asset, array $data): AssetDTO
    {
        $asset      = $this->getAsset($asset);
        $repository = AssetRepositoryFactory::getByType($asset->getType());

        $payloadData = [ //TODO: implement language
            'title' => $data['title'],
            'type'  => $data['type'],
            'level' => $data['level'],
        ];

        /** @var  Asset $asset */
        $asset = $repository->update($asset, $payloadData);

        $assetDTO = AssetFactory::toDTO($asset);
        $assetDTO->setBestResult($asset->getBestResultForUser($user));

        return $assetDTO;
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function getAssetsForApp(string $language, UserInterface $user): array
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
     * @param  UserInterface  $user
     * @param  int            $asset
     * @param  int            $card
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     * @throws CardAlreadyAddedException
     */
    public function addCard(UserInterface $user, int $asset, int $card): void
    {
        $asset = $this->getAsset($asset);
        $card  = $this->getCard($card);

        $repository = AssetRepositoryFactory::getByType($asset->getType());

        $asset->addCard($card);

        $repository->save($asset);
    }

    /**
     * @param  int  $asset
     * @param  int  $card
     *
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     */
    public function removeCard(int $asset, int $card): void
    {
        $asset = $this->getAsset($asset);
        $card  = $this->getCard($card);

        $asset->removeCard($card);
        $this->assetRepository->save($asset);
    }

    /**
     * @param  Language  $language
     *
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException|ConnectionException
     */
    public function removeByLanguage(Language $language): void
    {
        /** @var WordAsset[] $wordAssets */
        $wordAssets = $this->getAssets($language->getLetter(), Asset::TYPE_WORDS);
        /** @var SentenceAsset[] $wordAssets */
        $sentenceAssets = $this->getAssets($language->getLetter(), Asset::TYPE_SENTENCES);
        /** @var PersonalAsset[] $wordAssets */
        $personalAssets = $this->getAssets($language->getLetter(), Asset::TYPE_PERSONAL);
        /** @var FavouriteAsset[] $wordAssets */
        $favouriteAssets = $this->getAssets($language->getLetter(), Asset::TYPE_FAVORITES);

        $manager = app('em');
        $manager->getConnection()->beginTransaction();

        try {
            foreach ($wordAssets as $wordAsset) {
                $wordAsset->delete();
                $this->assetRepository->delete($wordAsset);
            }

            foreach ($sentenceAssets as $sentenceAsset) {
                $sentenceAsset->delete();
                $this->assetRepository->delete($sentenceAsset);
            }

            foreach ($personalAssets as $personalAsset) {
                $personalAsset->delete();
                $this->assetRepository->delete($personalAsset);
            }

            foreach ($favouriteAssets as $favouriteAsset) {
                $favouriteAsset->delete();
                $this->assetRepository->delete($favouriteAsset);
            }

            $manager->getConnection()->commit();
        } catch (Exception $e) {
            $manager->getConnection()->rollBack();
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }

    public function removeByUser(UserInterface $user): void
    {
        /** @var Language[] $languages $languages */
        $languages = $this->languageService->all();

        foreach ($languages as $language) {
            $assets = $user->getPersonalAssets($language);
            $favouriteAsset = $user->getFavouriteAsset($language);

            if ($favouriteAsset !== NULL) {
                $favouriteAsset->delete();
                $this->assetRepository->delete($favouriteAsset);
            }

            foreach ($assets as $asset) {
                $asset->delete();
                $this->assetRepository->delete($asset);
            }
        }
    }

    /**
     * @param  Language  $language
     *
     * @throws ConnectionException
     */
    public function createDefaultAssets(Language $language): void
    {
        /** @var  UserInterface[] $users */
        $users   = $this->userRepository->findAll();
        $manager = app('em');
        $manager->getConnection()->beginTransaction();

        try {
            foreach ($users as $user) {
                $favourite = new FavouriteAsset($language);
                $favourite->setOwner($user);
                $user->addPersonalAsset($favourite);
                $this->assetRepository->save($favourite);
            }
            $manager->getConnection()->commit();
        } catch (Exception $e) {
            $manager->getConnection()->rollBack();
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }
}