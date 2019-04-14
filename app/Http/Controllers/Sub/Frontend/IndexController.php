<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Message;
use App\Services\AssetService;
use App\Services\CardService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class IndexController
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    protected $assetService;

    protected $userService;

    protected $cardService;

    public function __construct(AssetService $assetService, UserService $userService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->userService = $userService;

        $this->cardService = $cardService;
    }

    public function index()
    {
       return view('sub.frontend.index');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('login'), 'password' => $request->input('password')])) {
            return response()->json(['success' => true, 'link' => $_SERVER['HTTP_REFERER'], 'state' => $this->userService->getState()]);
        } else {
            return response()->json(['success' => false, 'message' => 'Пользователь не найден, попробуйте еще раз.']);
        }
    }

    public function getUser()
    {
        $info = $this->userService->getInfo();

        return response()->json($info);
    }

    public function getInfo()
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    public function getWords()
    {
        $words = $this->assetService->getAssetsByType(Asset::TYPE_WORDS, Auth::user()->id);

        return response()->json($words);
    }

    public function getSentences()
    {
        $sentences = $this->assetService->getAssetsByType(Asset::TYPE_SENTENCES, Auth::user()->id);

        return response()->json($sentences);
    }

    public function getPersonal()
    {
        $personal = $this->assetService->getAssets(Auth::user()->id);

        return response()->json($personal);
    }

    public function getUserAssets()
    {
        $userAssets = $this->assetService->getUserAssets(Auth::user()->id);

        return response()->json($userAssets);
    }

    public function getAsset($id)
    {
        $asset = $this->cardService->getCards($id);

        return response()->json($asset);
    }

    public function check()
    {
        return response()->json([
            'auth' => Auth::check(),
            'state' => $this->userService->getState()
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