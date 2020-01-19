<?php

namespace App\Http\Controllers\Sub\Frontend;

use Exception;
use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use ReflectionException;
use Scandinaver\Learn\Application\Query\{AssetForUserByTypeQuery, PersonalAssetsQuery};
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Services\{AssetService};
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\{JsonResponse};
use Illuminate\View\View;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class IndexController
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(AssetService $assetService, UserService $userService)
    {
        $this->assetService = $assetService;

        $this->userService = $userService;
    }

    /**
     * @return array|Factory|View|mixed
     */
    public function index()
    {
       return view('sub.frontend.index');
    }

    /**
     * @return JsonResponse
     */
    public function getUser()
    {
        $info = $this->userService->getInfo();

        return response()->json($info);
    }

    /**
     * @return JsonResponse
     */
    public function getInfo()
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getWords()
    {
        $words = $this->queryBus->execute(new AssetForUserByTypeQuery(Auth::user(), Asset::TYPE_WORDS));

        return response()->json($words);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getSentences()
    {
        $sentences = $this->queryBus->execute(new AssetForUserByTypeQuery(Auth::user(), Asset::TYPE_SENTENCES));

        return response()->json($sentences);
    }

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function getPersonal()
    {
        $personal = $this->queryBus->execute(new PersonalAssetsQuery(Auth::user()));

        return response()->json($personal);
    }

    /**
     * @return JsonResponse
     */
    public function check()
    {
        try {
            $responce = ['auth' => true, 'state' => $this->userService->getState(Auth::user())];
        }catch ( \Throwable $e){
            $responce = ['auth' => false, 'state' => []];
        }

        return response()->json($responce);
    }
}