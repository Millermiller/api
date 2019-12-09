<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Services\FeedbackService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Meta;

/**
 * Class IndexController
 * @package Application\Controllers
 */
class IndexController extends Controller
{
    /**
     * @var FeedbackService
     */
    protected $feedbackService;

    /**
     * IndexController constructor.
     * @param FeedbackService $feedbackService
     */
    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        Meta::set('title', 'Scandinaver');
        Meta::set('description', 'Scandinaver');

        return view('main.frontend.index.home');
    }

    /**
     * @param FeedbackRequest $request
     * @return JsonResponse
     */
    public function feedback(FeedbackRequest $request)
    {
        $message = $this->feedbackService->saveFeedback($request);

        return response()->json($message, 201);
    }
}