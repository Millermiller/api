<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Doctrine\DBAL\ConnectionException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Core\Domain\Contract\BaseServiceInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\DTO\AssetDTO;
use Scandinaver\Learning\Asset\Domain\Entity\{Asset, FavouriteAsset, PersonalAsset, SentenceAsset, WordAsset};
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\AssetCreatedNotification;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\AssetDeletedNotification;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\CardAddedToAssetNotification;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\CardRemovedFromAssetNotification;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
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

    private AssetFactory $assetFactory;

    public function __construct(
        PassingRepositoryInterface       $passingRepository,
        AssetRepositoryInterface         $assetRepository,
        PersonalAssetRepositoryInterface $personalAssetRepository,
        UserRepositoryInterface          $userRepository,
        LoggerInterface                  $logger,
        LanguageService                  $languageService,
        AssetFactory                     $assetFactory
    ) {
        $this->passingRepository       = $passingRepository;
        $this->assetRepository         = $assetRepository;
        $this->personalAssetRepository = $personalAssetRepository;
        $this->userRepository          = $userRepository;
        $this->logger                  = $logger;
        $this->languageService         = $languageService;
        $this->assetFactory            = $assetFactory;
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

    public function paginate(RequestParametersComposition $params): LengthAwarePaginator
    {
        return $this->assetRepository->getData($params);
    }

    /**
     * @param  UserInterface  $user
     * @param  AssetDTO       $assetDTO
     *
     * @return Asset
     * @throws Exception
     */
    public function create(UserInterface $user, AssetDTO $assetDTO): Asset
    {
        if ($assetDTO->isBasic() === FALSE) {
            $assetDTO->setUser($user);
        }

        $asset = $this->assetFactory->fromDTO($assetDTO);

        $this->assetRepository->save($asset);

        AssetCreatedNotification::dispatch($asset->getId(), $user->getId());

        return $asset;
    }

    /**
     * @param  UserInterface  $user
     * @param  string         $id
     *
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     */
    public function delete(UserInterface $user, string $id): void
    {
        $asset      = $this->getAsset($id);
        $repository = AssetRepositoryFactory::getByType($asset->getType());
        $repository->delete($asset);

        AssetDeletedNotification::dispatch($id, $user->getId());
    }

    /**
     * @param  string     $language
     * @param  AssetType  $type
     *
     * @return array
     * @throws LanguageNotFoundException|BindingResolutionException
     */
    public function getAssets(string $language, AssetType $type): array
    {
        $language   = $this->getLanguage($language);
        $repository = AssetRepositoryFactory::getByType($type);

        return $repository->getByLanguage($language);
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     * @param  AssetType      $type
     *
     * @return array
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException
     */
    public function getAssetsByType(string $language, UserInterface $user, AssetType $type): array
    {
        $language = $this->getLanguage($language);

        $repository = AssetRepositoryFactory::getByType($type);

        $assets = $repository->getByLanguage($language);

        $isNextAvailable = FALSE;

        foreach ($assets as $asset) {

            $result = $asset->getBestResultForUser($user);
            $asset->setBestResult($result);

            if ($asset->isFirst() || $isNextAvailable) {
                $asset->setActive(TRUE);
            }

            $asset->setCompleted($asset->isCompletedByUser($user));
            $isNextAvailable = $asset->isCompletedByUser($user);

            if ($asset->getLevel() <= 5 || $user->isRaising()) { // TODO: implement settings
                $asset->setAvailable(TRUE);
            }
        }

        return $assets;
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function getPersonalAssets(string $language, UserInterface $user): array
    {
        $language = $this->getLanguage($language);

        $personalAssets = $user->getPersonalAssets($language);

        foreach ($personalAssets as $personalAsset) {

            if ($user->isRaising()) {
                $personalAsset->setActive(TRUE);
                $personalAsset->setAvailable(TRUE);
            }

            if ($personalAsset->isFavorite()) {
                $personalAsset->setActive(TRUE);
                $personalAsset->setAvailable(TRUE);
            }

            $result = $personalAsset->getBestResultForUser($user);
            $personalAsset->setBestResult($result);
        }

        return $personalAssets;
    }

    /**
     * @param  UserInterface  $user
     * @param  string         $id
     * @param  array          $data
     *
     * @return Asset
     * @throws AssetNotFoundException
     */
    public function updateAsset(UserInterface $user, string $id, array $data): Asset
    {
        $asset = $this->getAsset($id);

        $payloadData = [ //TODO: implement language
            'title' => $data['title'],
            'type'  => AssetType::from((int)$data['type']),
            'level' => $data['level'],
        ];

        if (TRUE === array_key_exists('sorting', $data)) {
            $asset->setSorting($data['sorting']);
        }

        $asset = $this->assetRepository->update($asset, $payloadData);

        $asset->setBestResult($asset->getBestResultForUser($user));

        return $asset;
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
     * @param  string         $asset
     * @param  int            $card
     *
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function addCard(UserInterface $user, string $asset, int $card): void
    {
        $asset = $this->getAsset($asset);
        $card  = $this->getCard($card);

        $repository = AssetRepositoryFactory::getByType($asset->getType());

        $asset->addCard($card);

        $repository->save($asset);

        CardAddedToAssetNotification::dispatch($asset->getId(), $user->getId(), $card->getId());
    }

    /**
     * @param  UserInterface  $user
     * @param  string         $asset
     * @param  int            $card
     *
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     */
    public function removeCard(UserInterface $user, string $asset, int $card): void
    {
        $asset = $this->getAsset($asset);
        $card  = $this->getCard($card);

        $asset->removeCard($card);
        $this->assetRepository->save($asset);

        CardRemovedFromAssetNotification::dispatch($asset->getId(), $user->getId(), $card->getId());
    }

    /**
     * @param  int  $languageId
     *
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException
     * @throws ConnectionException
     */
    public function removeByLanguage(int $languageId): void
    {
        $language = $this->getLanguageById($languageId);

        /** @var WordAsset[] $wordAssets */
        $wordAssets = $this->getAssets($language->getLetter(), AssetType::WORDS);
        /** @var SentenceAsset[] $wordAssets */
        $sentenceAssets = $this->getAssets($language->getLetter(), AssetType::SENTENCES);
        /** @var PersonalAsset[] $wordAssets */
        $personalAssets = $this->getAssets($language->getLetter(), AssetType::PERSONAL);
        /** @var FavouriteAsset[] $wordAssets */
        $favouriteAssets = $this->getAssets($language->getLetter(), AssetType::FAVORITES);

        $manager = app('em');
        $manager->getConnection()->beginTransaction();

        try {
            foreach ($wordAssets as $wordAsset) {
                $this->assetRepository->delete($wordAsset);
            }

            foreach ($sentenceAssets as $sentenceAsset) {
                $this->assetRepository->delete($sentenceAsset);
            }

            foreach ($personalAssets as $personalAsset) {
                $this->assetRepository->delete($personalAsset);
            }

            foreach ($favouriteAssets as $favouriteAsset) {
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
        $languages = $this->languageService->all($user);

        foreach ($languages as $language) {
            $assets         = $user->getPersonalAssets($language);
            $favouriteAsset = $user->getFavouriteAsset($language);

            if ($favouriteAsset !== NULL) {
                $this->assetRepository->delete($favouriteAsset);
            }

            foreach ($assets as $asset) {
                $asset->delete();
                $this->assetRepository->delete($asset);
            }
        }
    }

    /**
     * @param  int  $languageId
     *
     * use $languageId instead of entity because we pass it through queue
     * and entity manager dont know nothing about this
     *
     * @throws LanguageNotFoundException
     * @throws Exception
     */
    public function createDefaultAssets(int $languageId): void
    {
        $users    = $this->userRepository->findAll();
        $language = $this->getLanguageById($languageId);
        try {
            foreach ($users as $user) {
                $favourite = new FavouriteAsset($language);
                $favourite->setOwner($user);
                $user->addPersonalAsset($favourite);
                $this->assetRepository->save($favourite);
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }
}