<?php


namespace App\Http\Controllers\Sub\Backend;

use ReflectionException;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\BaseRequest;
use App\Http\Controllers\Controller;
use Scandinaver\Learn\Application\Query\{AssetsCountQuery, AudioCountQuery, TextsCountQuery, WordsCountQuery};

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:26
 * Class DashboardController
 *
 * @package Application\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * @param BaseRequest $request
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function wordsCount(BaseRequest $request)
    {
        return response()->json($this->queryBus->execute(new WordsCountQuery($request->language)));
    }

    /**
     * @param BaseRequest $request
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function assetsCount(BaseRequest $request)
    {
        return response()->json($this->queryBus->execute(new AssetsCountQuery($request->language)));
    }

    /**
     * @param BaseRequest $request
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function audioCount(BaseRequest $request)
    {
        return response()->json($this->queryBus->execute(new AudioCountQuery($request->language)));
    }

    /**
     * @param BaseRequest $request
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function textsCount(BaseRequest $request)
    {
        return response()->json($this->queryBus->execute(new TextsCountQuery($request->language)));
    }
}