<?php


namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;

/**
 * Class FeedbackController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class FeedbackController extends Controller
{

    /**
     * @param  FeedbackRequest  $request
     */
    public function store(FeedbackRequest $request)
    {
        //  $message = $this->feedbackService->saveFeedback($request->toArray());

        //  return response()->json($message, 201);
    }
}