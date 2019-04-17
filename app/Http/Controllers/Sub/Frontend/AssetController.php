<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\AssetCreated;
use App\Events\AssetDelete;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Result;
use App\Services\AssetService;
use App\Services\CardService;
use Auth;
use Illuminate\Http\Request;

/**
 * Class LearnController
 * @package App\Http\Controllers\Sub\Frontend
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 10.03.15
 * Time: 1:44
 *
 */
class AssetController extends Controller
{
    protected $cardService;

    protected $assetService;

    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    public function show($id)
    {
        $cards = $this->cardService->getCards($id);

        return response()->json($cards);
    }

    public function assetInfo($id)
    {
        return response()->json(Asset::with('result')->find($id));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $asset = $this->assetService->create($request);

        return response()->json($asset, 201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->assetService->delete($id);

        return response()->json(204);
    }
}