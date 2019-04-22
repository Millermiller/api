<?php

namespace App\Services;

use App\Events\AssetCreated;
use App\Events\AssetDelete;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Result;
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
     * Возвращает массив словарей определенного типа для пользователя с id = $uid
     *
     * @param string $type 'Предложения' || 'Слова' || 'Избранное'
     * @param $user_id
     * @return array
     */
    public function getAssetsByType($type, $user_id)
    {
        $activeArray = Result::domain()->where('user_id', $user_id)->pluck('result', 'asset_id')->toArray();

        $rez = DB::select('SELECT id, level, title, type FROM assets WHERE type = ? AND lang = ? order by level asc', [$type, config('app.lang')]);

        $canopen = true;
        $testlink = 0;
        $counter = 0;

        foreach($rez as &$r) {
            $counter++;
            if (in_array($r->id, array_keys($activeArray))) {
                $r = ['count' => Card::where('asset_id', $r->id)->count(),
                    'title' => $r->title,
                    'id' => $r->id,
                    'level' => $r->level,
                    'active' => true,
                    'canopen' => false,
                    'result' => $activeArray[$r->id],
                    'type' => $r->type
                ];
            } else {
                $r = ['count' => Card::where('asset_id', $r->id)->count(),
                    'title' => $r->title,
                    'id' => $r->id,
                    'level' => $r->level,
                    'active' => false,
                    'canopen' => $canopen,
                    'testlink' => $testlink,
                    'result' => 0,
                    'type' => $r->type
                ];
                $canopen = false;
            }

            if($counter < 10 || User::find($user_id)->premium)
                $r['available'] = true;
            else
                $r['available'] = false;

            $testlink = $r['id'];
        }

        return $rez;
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
    public function getPersonalAssets($uid)
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