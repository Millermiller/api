<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\{Exceptions\CardAlreadyAddedException, Exceptions\CardNotFoundException};
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;

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
     * @param  UserInterface  $user
     * @param  int   $card
     *
     * @throws CardNotFoundException
     * @throws CardAlreadyAddedException
     */
    public function create(UserInterface $user, int $card): void
    {
        $card     = $this->getCard($card);
        $language = $card->getLanguage();
        $asset    = $user->getFavouriteAsset($language);

        $asset->addCard($card);

        $this->favouriteAssetRepository->save($asset);
    }

    /**
     * @param  UserInterface  $user
     * @param  int   $card
     *
     * @throws CardNotFoundException
     */
    public function delete(UserInterface $user, int $card): void
    {
        $card     = $this->getCard($card);
        $language = $card->getLanguage();
        $asset    = $user->getFavouriteAsset($language);

        $asset->removeCard($card);

        $this->favouriteAssetRepository->save($asset);
    }
}