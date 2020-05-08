<?php


namespace App\Http\Controllers\Sub\Frontend;

use Exception;
use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use ReflectionException;
use Scandinaver\Learn\Application\Query\{AssetForUserByTypeQuery, PersonalAssetsQuery};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Asset;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\{JsonResponse};
use Illuminate\View\View;
use Scandinaver\User\Application\Query\GetStateQuery;
use Scandinaver\User\Application\Query\GetUserQuery;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    /**
     * @return array|Factory|View|mixed
     */
    public function index()
    {
        return view('sub.frontend.index');
    }

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function getUser(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetUserQuery(Auth::user())));
    }

    /**
     * @return JsonResponse
     */
    public function getInfo(): JsonResponse
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getWords(): JsonResponse
    {
        $words = $this->queryBus->execute(new AssetForUserByTypeQuery(Auth::user(), Asset::TYPE_WORDS));

        return response()->json($words);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getSentences(): JsonResponse
    {
        $sentences = $this->queryBus->execute(new AssetForUserByTypeQuery(Auth::user(), Asset::TYPE_SENTENCES));

        return response()->json($sentences);
    }

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function getPersonal(): JsonResponse
    {
        $personal = $this->queryBus->execute(new PersonalAssetsQuery(Auth::user()));

        return response()->json($personal);
    }

    /**
     * @param Language $language
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function state(Language $language): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetStateQuery(Auth::user(), $language)));
    }
}