<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Entities\Asset;
use App\Services\{AssetService, CardService};
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};

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

    /**
     * @param Asset $asset
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Asset $asset)
    {
        $this->authorize('view', $asset);

        $cards = $this->cardService->getCards($asset);

        return response()->json($cards);
    }

    public function assetInfo($id)
    {
        return response()->json(Asset::with('result')->find($id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $asset = $this->assetService->create($request);

        return response()->json($asset, 201);
    }

    /**
     * @param Request $request
     * @param Asset $asset
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Asset $asset)
    {
        $this->authorize('update', $asset);

        $asset = $this->assetService->updateAsset($asset, $request->toArray());

        return response()->json($asset, 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->assetService->delete($id);

        return response()->json(null, 204);
    }
}