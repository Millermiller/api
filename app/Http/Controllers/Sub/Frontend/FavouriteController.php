<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Services\AssetService;
use App\Services\FavouriteService;
use Auth;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    protected $favouriteService;

    protected $assetService;

    public function __construct(AssetService $assetService, FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;

        $this->assetService = $assetService;
    }

    public function getFavourites()
    {
        $favorites = $this->assetService->getAssetsByType(Asset::TYPE_FAVORITES, Auth::user()->id);

        return response()->json($favorites);
    }

    public function getFavourite()
    {
        $cards =  $this->favouriteService->getByUser(Auth::user()->id);

        return response()->json($cards);
    }

    public function addToFavourite(Request $request)
    {
        $this->favouriteService->create($request);

        return response()->json(['success' => true]);
    }

    public function deleteFavourite($id)
    {
        $this->favouriteService->delete($id);

        return response()->json([  'success' => true ]);
    }
}
