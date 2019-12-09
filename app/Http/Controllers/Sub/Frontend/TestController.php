<?php

namespace App\Http\Controllers\Sub\Frontend;

use Auth;
use App\Http\Controllers\Controller;
use App\Entities\Asset;
use App\Services\{AssetService, CardService};
use Doctrine\ORM\NoResultException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.05.2015
 * Time: 3:10
 *
 * Class TestController
 * @package App\Http\Controllers\Sub\Frontend
 */
class TestController extends Controller
{
    /**
     * @var CardService
     */
    private $cardService;

    /**
     * @var AssetService
     */
    private $assetService;

    /**
     * TestController constructor.
     * @param CardService $cardService
     * @param AssetService $assetService
     */
    public function __construct(CardService $cardService, AssetService $assetService)
    {
        $this->cardService = $cardService;
        $this->assetService = $assetService;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getAsset($id)
    {
        $cards = $this->cardService->getCards($id);

        return response()->json($cards);
    }

    /**
     * @param Asset $asset
     * @return JsonResponse
     */
    public function complete(Asset $asset)
    {
        try{
            $asset = $this->assetService->giveNextLevel(Auth::user(), $asset);
        }catch(NoResultException $e){
            //
        }

        return response()->json($asset);
    }

    /**
     * Сохранить результат
     * @param Asset $asset
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function result(Asset $asset)
    {
        $this->authorize('updateResult', $asset);

        $resultValue = Input::get('result');

        $result = $this->assetService->saveTestResult($asset, Auth::user(), $resultValue);

        return response()->json($result);
    }
}