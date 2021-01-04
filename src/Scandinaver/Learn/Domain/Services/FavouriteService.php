<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\{Exceptions\CardAlreadyAddedException,
  Exceptions\CardNotFoundException,
  Exceptions\LanguageNotFoundException,
  Model\Translate,
  Model\Word};
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\User\Domain\Model\User;

/**
 * Class FavouriteService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class FavouriteService
{
    use LanguageTrait;
    use CardTrait;

    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    public function __construct(FavouriteAssetRepositoryInterface $favouriteAssetRepository)
    {
        $this->favouriteAssetRepository = $favouriteAssetRepository;
    }

    /**
     * @param  string  $language
     * @param  User  $user
     * @param  int  $card
     *
     * @throws CardNotFoundException
     * @throws LanguageNotFoundException
     * @throws CardAlreadyAddedException
     */
    public function create(string $language, User $user, int $card): void
    {
        $language = $this->getLanguage($language);
        $card = $this->getCard($card);

        $asset = $user->getFavouriteAsset($language);

        $asset->addCard($card);

        $this->favouriteAssetRepository->save($asset);
    }

    /**
     * @param  string  $language
     * @param  User  $user
     * @param  int  $card
     *
     * @throws CardNotFoundException
     * @throws LanguageNotFoundException
     */
    public function delete(string $language, User $user, int $card): void
    {
        $language = $this->getLanguage($language);
        $card = $this->getCard($card);

        $asset = $user->getFavouriteAsset($language);

        $asset->removeCard($card);

        $this->favouriteAssetRepository->save($asset);
    }
}