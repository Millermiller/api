<?php


namespace Scandinaver\Learn\Domain\Services;

use App\Entities\User;
use App\Repositories\Language\LanguageRepositoryInterface;
use Doctrine\ORM\{ORMException, OptimisticLockException};
use Scandinaver\Learn\Domain\Card;
use Scandinaver\Learn\Domain\Contracts\{AssetRepositoryInterface,
    CardRepositoryInterface,
    TranslateRepositoryInterface,
    WordRepositoryInterface};
use Scandinaver\Learn\Domain\{Translate, Word};

/**
 * Class FavouriteService
 * @package App\Services
 */
class FavouriteService
{
    /**
     * @var CardService
     */
    private $cardService;

    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;

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
     * @param CardService $cardService
     * @param CardRepositoryInterface $cardRepository
     * @param WordRepositoryInterface $wordRepository
     * @param TranslateRepositoryInterface $translateRepository
     * @param AssetRepositoryInterface $assetRepository
     * @param LanguageRepositoryInterface $languageRepository
     */
    public function __construct(
        CardService $cardService,
        CardRepositoryInterface $cardRepository,
        WordRepositoryInterface $wordRepository,
        TranslateRepositoryInterface $translateRepository,
        AssetRepositoryInterface $assetRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->cardService = $cardService;
        $this->cardRepository = $cardRepository;
        $this->wordRepository = $wordRepository;
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