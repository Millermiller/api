<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Entities\Asset;
use App\Services\{AssetService, CardService};
use Doctrine\ORM\{ORMException, OptimisticLockException};
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
    /**
     * @var CardService
     */
    protected $cardService;

    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * AssetController constructor.
     * @param AssetService $assetService
     * @param CardService $cardService
     */
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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(Request $request)
    {
        $asset = $this->assetService->create($request->toArray());

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
     * @param Asset $asset
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Asset $asset)
    {
        $this->authorize('delete', $asset);

        $this->assetService->delete($asset);

        return response()->json(null, 204);
    }
}