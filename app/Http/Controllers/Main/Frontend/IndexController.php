<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\Message;
use Meta;

/**
 * Class IndexController
 * @package Application\Controllers
 */
class IndexController extends Controller
{
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
        $message = Message::create($request->all());

        event(new MessageEvent($message));

        return response()->json(['success' => true, 'msg' => 'Сообщение отправлено']);
    }
}