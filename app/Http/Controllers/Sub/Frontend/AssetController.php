<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Services\{AssetService, CardService};
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

    /**
     * @param \App\Entities\Asset $asset
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(\App\Entities\Asset $asset)
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $asset = $this->assetService->create($request);

        return response()->json($asset, 201);
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update($request->all());

        return response()->json($asset, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->assetService->delete($id);

        return response()->json(null, 204);
    }
}