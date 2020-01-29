<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\User\Domain\User;
use Doctrine\ORM\{ORMException, OptimisticLockException};
use Scandinaver\Learn\Domain\Card;
use Scandinaver\Learn\Domain\Contracts\{AssetRepositoryInterface,
    CardRepositoryInterface,
    TranslateRepositoryInterface};
use Scandinaver\Learn\Domain\{Translate, Word};

/**
 * Class FavouriteService
 * @package App\Services
 */
class FavouriteService
{
    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;

    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;

    /**
     * FavouriteService constructor.
     * @param CardRepositoryInterface $cardRepository
     * @param TranslateRepositoryInterface $translateRepository
     * @param AssetRepositoryInterface $assetRepository
     * @param LanguageRepositoryInterface $languageRepository
     */
    public function __construct(
        CardRepositoryInterface $cardRepository,
        TranslateRepositoryInterface $translateRepository,
        AssetRepositoryInterface $assetRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->cardRepository = $cardRepository;
        $this->translateRepository = $translateRepository;
        $this->assetRepository = $assetRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @param User $user
     * @param Word $word
     * @param Translate $translate
     * @return Card
     */
    public function create(User $user, Word $word, Translate $translate): Card
    {
        $language = $this->languageRepository->get(config('app.lang'));
        $asset    = $this->assetRepository->getFavouriteAsset($language, $user);

        return $this->cardRepository->save(new Card($word, $asset, $translate));
    }

    /**
     * @param User $user
     * @param $id
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(User $user, $id): void
    {
        $language = $this->languageRepository->get(config('app.lang'));
        $asset    = $this->assetRepository->getFavouriteAsset($language, $user);
        $card     = $this->cardRepository->findOneBy(['wordId' => $id, 'assetId' => $asset->getId()]);

        app('em')->remove($card);
        app('em')->flush();
    }
}