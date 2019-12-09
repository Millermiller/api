<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubdomainFeedbackRequest;
use App\Entities\Asset;
use App\Services\{AssetService, CardService, FeedbackService, UserService};
use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\{JsonResponse, Request};
use Auth;
use Illuminate\View\View;

/**
 * Class IndexController
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var CardService
     */
    protected $cardService;

    /**
     * @var FeedbackService
     */
    protected $feedbackService;

    public function __construct(AssetService $assetService, UserService $userService, CardService $cardService, FeedbackService $feedbackService)
    {
        $this->assetService = $assetService;

        $this->userService = $userService;

        $this->cardService = $cardService;

        $this->feedbackService = $feedbackService;
    }

    /**
     * @return array|Factory|View|mixed
     */
    public function index()
    {
       return view('sub.frontend.index');
    }

    /**
     * @return JsonResponse
     */
    public function getUser()
    {
        $info = $this->userService->getInfo();

        return response()->json($info);
    }

    /**
     * @return JsonResponse
     */
    public function getInfo()
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    /**
     * @return JsonResponse
     */
    public function getWords()
    {
        $words = $this->assetService->getAssetsByType(Auth::user(), Asset::TYPE_WORDS);

        return response()->json($words);
    }

    /**
     * @return JsonResponse
     */
    public function getSentences()
    {
        $sentences = $this->assetService->getAssetsByType(Auth::user(), Asset::TYPE_SENTENCES);

        return response()->json($sentences);
    }

    /**
     * @return JsonResponse
     */
    public function getPersonal()
    {
        $personal = $this->assetService->getPersonalAssets(Auth::user());

        return response()->json($personal);
    }

    /**
     * @return JsonResponse
     * @throws QueryException
     */
    public function check()
    {
        try {
            $responce = ['auth' => true, 'state' => $this->userService->getState(Auth::user())];
        }catch ( \Throwable $e){
            $responce = ['auth' => false, 'state' => []];
        }

        return response()->json($responce);
    }

    /**
     * @param SubdomainFeedbackRequest $request
     * @return JsonResponse
     */
    public function feedback(SubdomainFeedbackRequest $request)
    {
        $message = $this->feedbackService->saveFeedback($request->toArray());

        return response()->json($message, 201);
    }
}