<?php

namespace App\Services;

use App\Events\AssetCreated;
use App\Events\AssetDelete;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Result;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Result\ResultRepositoryInterface;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

/**
 * Class AssetService
 * @package app\Services
 */
class AssetService
{
    /**
     * @var LanguageRepositoryInterface
     */
    protected $languageRepository;

    /**
     * @var AssetRepositoryInterface
     */
    protected $assetsRepository;

    /**
     * @var ResultRepositoryInterface
     */
    protected $resultRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository, AssetRepositoryInterface $assetsRepository, ResultRepositoryInterface $resultRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->assetsRepository = $assetsRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * @param Request $request
     * @return Asset|\Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        $asset = Asset::create([
            'title' => $request->get('title'),
            'basic' => false,
            'level' => 0,
            'lang' => config('app.lang')
        ]);

        Auth::user()->increment('assets_created');

        Result::create([
            'asset_id' => $asset->id,
            'user_id' => Auth::user()->id,
            'lang' => $asset->lang
        ]);

        event(new AssetCreated(Auth::user(), $asset));

        return $asset;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id)
    {
        event(new AssetDelete(Auth::user(), Asset::find($id)->first()));

        return response()->json(['success' => Asset::deleteAsset($id)]);
    }

    /**
     * Возвращает массив словарей определенного типа для пользователя
     *
     * @param \App\Entities\User $user
     * @param int $type
     * @return array
     */
    public function getAssetsByType(\App\Entities\User $user, int $type)
    {
        $language = $this->languageRepository->get(config('app.lang'));

        $activeArray  = $this->resultRepository->getActiveIds($user,  $language);

        $assets = $this->assetsRepository->getAssetsByType($language, $type);

        $canopen = true;
        $testlink = false;
        $counter = 0;

        /** @var \App\Entities\Asset $asset */
        foreach($assets as &$asset) {
            $counter++;
            if (in_array($asset->getId(), $activeArray)) {
                $asset = [
                    'count' => $asset->getCards()->count(),
                    'title' => $asset->getTitle(),
                    'id' => $asset->getId(),
                    'level' => $asset->getLevel(),
                    'active' => true,
                    'testlink' => false,
                    'canopen' => false,
                    'result' => $this->resultRepository->getResult($user,  $asset)->getValue(),
                    'type' => $asset->getType()
                ];
            } else {
                $asset = [
                    'count' => $asset->getCards()->count(),
                    'title' => $asset->getTitle(),
                    'id' => $asset->getId(),
                    'level' => $asset->getLevel(),
                    'active' => false,
                    'canopen' => $canopen,
                    'testlink' => $testlink,
                    'result' => 0,
                    'type' => $asset->getType()
                ];
                $canopen = false;
            }

            if($counter < 10 || $user->isPremium())
                $asset['available'] = true;
            else
                $asset['available'] = false;

            $testlink = $asset['id'];
        }

        return $assets;
    }

    /**
     * Получить наборы карточек для юзера
     *
     * @param  int $user_id int User Id
     * @return array
     */
    public function getAssets($user_id)
    {
        return DB::select('
                                 SELECT COUNT(wta.word_id) as num, a.title, a.id, a.basic, a.level, atu.result
                                 FROM assets AS a
                                 LEFT JOIN assets_to_users as atu
                                    ON a.id = atu.asset_id
                                 LEFT JOIN cards AS wta
                                    ON a.id = wta.asset_id
                                 WHERE user_id = ?
                                -- AND a.basic IN(1)
                                 GROUP BY a.id
                                 ORDER BY a.level
                                 ', [$user_id]);
    }

    /**
     * @param int $uid User Id
     * @return array
     */
    static function getUserAssets($uid)
    {
        return DB::select(
            'select a.id, a.title, a.basic, a.level, a.favorite, 
		            atu.result, count(wta.id) as count
              from assets_to_users as atu
                join assets as a
                  on atu.asset_id = a.id
         	    left join cards as wta
         		  on wta.asset_id = a.id
                where atu.user_id = ?
                  and a.basic = 0
                group by a.id
                order by a.favorite desc', [$uid]
        );
    }

    /**
     * @param $uid
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPersonalAssets(\App\Entities\User $user)
    {
        return Asset::domain()->whereHas(
            'result', function ($q) use ($uid) {
            /** @var \Illuminate\Database\Eloquent\Builder $q */
            $q->where('user_id', $uid);
        })->with('cards', 'cards.word', 'cards.translate', 'result')
            ->where('basic', 0)
            ->orderBy('id')
            ->get();
    }
}