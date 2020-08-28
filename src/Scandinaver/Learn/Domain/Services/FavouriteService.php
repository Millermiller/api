<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\{Contract\Repository\AssetRepositoryInterface,
    Contract\Repository\CardRepositoryInterface,
    Contract\Repository\FavouriteAssetRepositoryInterface,
    Contract\Repository\TranslateRepositoryInterface,
    Model\Translate,
    Model\Word
};
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\User\Domain\Model\User;

/**
 * Class FavouriteService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class FavouriteService
{
    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    public function __construct(
        FavouriteAssetRepositoryInterface $favouriteAssetRepository
    ) {
        $this->favouriteAssetRepository = $favouriteAssetRepository;
    }

    public function create(Language $language, User $user, Card $card): void
    {
        $asset = $this->favouriteAssetRepository->getFavouriteAsset($language, $user);

        $asset->addCard($card);

        $this->favouriteAssetRepository->save($asset);
    }

    public function delete(Language $language, User $user, Card $card): void
    {
        $asset = $this->favouriteAssetRepository->getFavouriteAsset($language, $user);

        $asset->removeCard($card);

        $this->favouriteAssetRepository->save($asset);
    }
}