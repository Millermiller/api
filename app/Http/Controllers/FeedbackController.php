<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubdomainFeedbackRequest;

/**
 * Class FeedbackController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class FeedbackController extends Controller
{
    public function store(SubdomainFeedbackRequest $request)
    {
        //  $message = $this->feedbackService->saveFeedback($request->toArray());

        //  return response()->json($message, 201);
    }
}