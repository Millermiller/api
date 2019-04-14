<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Services\CardService;

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
class LearnController extends Controller
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function getAsset($id)
    {
        $cards = $this->cardService->getCards($id);

        return response()->json($cards);
    }

    public function assetInfo($id)
    {
        return response()->json(Asset::with('result')->find($id));
    }
}