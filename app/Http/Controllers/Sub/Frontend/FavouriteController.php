<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};
use Doctrine\ORM\{OptimisticLockException, ORMException};
use Illuminate\Http\{JsonResponse, Request};

class FavouriteController extends Controller
{
    /**
     * @var FavouriteService
     */
    protected $favouriteService;

    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * FavouriteController constructor.
     * @param AssetService $assetService
     * @param FavouriteService $favouriteService
     */
    public function __construct(AssetService $assetService, FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;

        $this->assetService = $assetService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $card = $this->favouriteService->create($request);

        return response()->json($card, 201);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($id)
    {
        $this->favouriteService->delete($id);

        return response()->json([  'success' => true ]);
    }
}