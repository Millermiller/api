<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\{Contract\Repository\AssetRepositoryInterface,
    Contract\Repository\CardRepositoryInterface,
    Contract\Repository\TranslateRepositoryInterface,
    Model\Translate,
    Model\Word};
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\User\Domain\Model\User;

/**
 * Class FavouriteService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class FavouriteService
{
    private CardRepositoryInterface $cardRepository;

    private TranslateRepositoryInterface $translateRepository;

    private AssetRepositoryInterface $assetRepository;

    /**
     * FavouriteService constructor.
     *
     * @param  CardRepositoryInterface       $cardRepository
     * @param  TranslateRepositoryInterface  $translateRepository
     * @param  AssetRepositoryInterface      $assetRepository
     */
    public function __construct(
        CardRepositoryInterface $cardRepository,
        TranslateRepositoryInterface $translateRepository,
        AssetRepositoryInterface $assetRepository
    ) {
        $this->cardRepository = $cardRepository;
        $this->translateRepository = $translateRepository;
        $this->assetRepository = $assetRepository;
    }

    /**
     * @param  Language   $language
     * @param  User       $user
     * @param  Word       $word
     * @param  Translate  $translate
     *
     * @return Card
     */
    public function create(
        Language $language,
        User $user,
        Word $word,
        Translate $translate
    ): Card {
        $asset = $this->assetRepository->getFavouriteAsset($language, $user);

        return $this->cardRepository->save(new Card($word, $asset, $translate));
    }

    /**
     * @param  Language  $language
     * @param  User      $user
     * @param            $id
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Language $language, User $user, $id): void
    {
        $asset = $this->assetRepository->getFavouriteAsset($language, $user);
        $card = $this->cardRepository->findOneBy(
            ['wordId' => $id, 'assetId' => $asset->getId()]
        );

        app('em')->remove($card);
        app('em')->flush();
    }
}