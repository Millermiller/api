<?php

namespace App\Services;

use App\Models\Card;
use App\User;
use Auth;
use Illuminate\Http\Request;

/**
 * Class FavouriteService
 * @package App\Services
 */
class FavouriteService
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function getByUser($user_id)
    {
        $user = User::findOrFail($user_id);

        $cards = $this->cardService->getCards($user->favourite->id);

        return $cards;
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        Card::create([
            'asset_id' =>  Auth::user()->favourite->id,
            'word_id' => $request->get('word_id'),
            'translate_id' =>  $request->get('translate_id')
        ]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        Card::whereRaw('word_id = ? and asset_id = ?', [$id, Auth::user()->favourite->id])->forceDelete();
    }
}