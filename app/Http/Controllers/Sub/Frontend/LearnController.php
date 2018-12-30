<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;

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
    public function getAsset($id)
    {
        return response()->json(Card::getCards($id));
    }

    public function assetInfo($id)
    {
        return response()->json(Asset::with('result')->find($id));
    }
}