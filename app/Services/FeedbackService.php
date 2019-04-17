<?php

namespace App\Services;


use App\Events\MessageEvent;
use App\Http\Requests\FeedbackRequest;
use App\Http\Requests\SubdomainFeedbackRequest;
use App\Models\Message;
use Auth;

/**
 * Class FeedbackService
 * @package app\Services
 */
class FeedbackService
{
    /**
     * @param FeedbackRequest $request
     */
    public function saveFeedback(FeedbackRequest $request)
    {
        $message = Message::create($request->all());

        event(new MessageEvent($message));

        return $message;
    }

    /**
     * @param SubdomainFeedbackRequest $request
     * @return mixed
     */
    public function saveSubdomainFeedback(SubdomainFeedbackRequest $request)
    {
        $request->request->add(['name', Auth::user()->login]);

        $message = Message::create($request->all());

        event(new MessageEvent($message));

        return $message;
    }
}