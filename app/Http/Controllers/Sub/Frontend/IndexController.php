<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubdomainFeedbackRequest;
use App\Models\Asset;
use App\Models\Message;
use App\Services\ApiService;
use App\Services\AssetService;
use App\Services\CardService;
use App\Services\FeedbackService;
use App\Services\UserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\Debug\Exception\FatalThrowableError;

/**
 * Class IndexController
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    protected $assetService;

    protected $userService;

    protected $cardService;

    protected $feedbackService;

    public function __construct(AssetService $assetService, UserService $userService, CardService $cardService, FeedbackService $feedbackService)
    {
        $this->assetService = $assetService;

        $this->userService = $userService;

        $this->cardService = $cardService;

        $this->feedbackService = $feedbackService;
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
        $personal = $this->assetService->getPersonalAssets(Auth::user()->id);

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

    /**
     * @return JsonResponse
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function check()
    {
        try {
            $responce = $this->userService->getState(Auth::user());
        }catch ( \Throwable $e){
            $responce = ['auth' => false, 'state' => []];
        }

        return response()->json($responce);
    }

    public function feedback(SubdomainFeedbackRequest $request)
    {
        $message = $this->feedbackService->saveSubdomainFeedback($request);

        return response()->json($message, 201);
    }
}