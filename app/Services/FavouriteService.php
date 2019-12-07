<?php

namespace App\Services;

use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Card\CardRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Translate\TranslateRepositoryInterface;
use App\Repositories\Word\WordRepositoryInterface;
use App\User;
use Auth;
use Illuminate\Http\Request;

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

    public function __construct(
        CardService $cardService,
        CardRepositoryInterface $cardRepository,
        WordRepositoryInterface $wordRepository,
        TranslateRepositoryInterface $translateRepository,
        AssetRepositoryInterface $assetRepository,
        LanguageRepositoryInterface $languageRepository
    )
    {
        $this->cardService = $cardService;
        $this->cardRepository = $cardRepository;
        $this->wordRepository = $wordRepository;
        $this->translateRepository = $translateRepository;
        $this->assetRepository = $assetRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function getByUser($user_id)
    {
        $user = User::findOrFail($user_id);

        $cards = $this->cardService->getCards($user->favourite->id);

        return $cards;
    }

    /**
     * @param Request $request
     * @return \App\Entities\Card
     */
    public function create(Request $request)
    {
        $language  = $this->languageRepository->get(config('app.lang'));
        $asset     = $this->assetRepository->getFavouriteAsset($language, Auth::user());
        $word      = $this->wordRepository->get($request->get('word_id'));
        $translate = $this->translateRepository->get($request->get('translate_id'));

        $card = new \App\Entities\Card($word, $asset, $translate);

        $card = $this->cardRepository->save($card);

        return $card;
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id)
    {
        $language  = $this->languageRepository->get(config('app.lang'));
        $asset     = $this->assetRepository->getFavouriteAsset($language, Auth::user());
        $card      = $this->cardRepository->findOneBy(['wordId' => $id, 'assetId' => $asset->getId()]);

        app('em')->remove($card);
        app('em')->flush();
    }
}