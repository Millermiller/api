<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\MessageEvent;
use App\Events\MessageRecieved;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Message;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class IndexController
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{

    public function index()
    {
       return view('sub.frontend.index');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('login'), 'password' => $request->input('password')])) {
            return response()->json(['success' => true, 'link' => $_SERVER['HTTP_REFERER'], 'state' => $this->getState()]);
        } else {
            return response()->json(['success' => false, 'message' => 'Пользователь не найден, попробуйте еще раз.']);
        }
    }

    public function getState()
    {
        return Auth::check() ? Auth::user()->state() : [];
    }

    public function getUser()
    {
        return response()->json(Auth::user()->info());
    }

    public function getInfo()
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    public function getWords()
    {
        return response()->json(Asset::getAssetsByType(Asset::TYPE_WORDS, Auth::user()->id));
    }

    public function getSentences()
    {
        return response()->json(Asset::getAssetsByType(Asset::TYPE_SENTENCES, Auth::user()->id));
    }

    public function getFavourites()
    {
        return response()->json(Asset::getAssetsByType(Asset::TYPE_FAVORITES, Auth::user()->id));
    }

    public function getPersonal()
    {
        return response()->json(Asset::getAssets(Auth::user()->id));
    }

    public function getUserAssets()
    {
        return response()->json(Asset::getUserAssets(Auth::user()->id));
    }

    public function getAsset($id)
    {
        return response()->json(Card::getCards($id));
    }

    public function check()
    {
        return response()->json([
            'auth' => Auth::check(),
            'state' => $this->getState()
        ]);
    }

    public function feedback()
    {
        $message = Input::get('message', '');

        $message = new Message(['name' => Auth::user()->login, 'message' => $message]);

        if ($message->save()){

            event(new MessageEvent($message));

            return response()->json(['success' => true, 'msg' => 'Сообщение отправлено']);
        }
        else
            return response()->json(['success' => false, 'msg' => 'Произошла ошибка']);
    }
}