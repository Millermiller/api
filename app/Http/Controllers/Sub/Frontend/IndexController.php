<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Illuminate\Http\{JsonResponse};
use Scandinaver\Learn\UI\Query\AssetForUserByTypeQuery;
use Scandinaver\Learn\UI\Query\PersonalAssetsQuery;
use Scandinaver\User\UI\Query\GetStateQuery;
use Scandinaver\User\UI\Query\GetUserQuery;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    public function getUser(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetUserQuery(Auth::user())));
    }

    public function getInfo(): JsonResponse
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    public function getWords(Language $language): JsonResponse
    {
        $words = $this->queryBus->execute(new AssetForUserByTypeQuery($language, Auth::user(), Asset::TYPE_WORDS));

        return response()->json($words);
    }

    public function getSentences(Language $language): JsonResponse
    {
        $sentences = $this->queryBus->execute(new AssetForUserByTypeQuery($language, Auth::user(), Asset::TYPE_SENTENCES));

        return response()->json($sentences);
    }

    public function getPersonal(Language $language): JsonResponse
    {
        $personal = $this->queryBus->execute(new PersonalAssetsQuery(Auth::user(), $language));

        return response()->json($personal);
    }

    public function state(Language $language): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetStateQuery(Auth::user(), $language)));
    }
}