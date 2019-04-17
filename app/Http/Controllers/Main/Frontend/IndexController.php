<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Services\FeedbackService;
use Meta;

/**
 * Class IndexController
 * @package Application\Controllers
 */
class IndexController extends Controller
{
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Meta::set('title', 'Scandinaver');
        Meta::set('description', 'Scandinaver');

        return view('main.frontend.index.home');
    }

    /**
     * @param FeedbackRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedback(FeedbackRequest $request)
    {
        $message = $this->feedbackService->saveFeedback($request);

        return response()->json($message, 201);
    }
}