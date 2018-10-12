<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Input;
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
        Meta::set('title', 'You are at home');
        Meta::set('description', 'This is my home. Enjoy!');
        Meta::set('image', asset('images/home-logo.png'));

        return view('main.frontend.index.home');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxFeedback()
    {
        $name = Input::get('name', '');
        $message = Input::get('message', '');

        $message = new Message(['name' => $name, 'message' => $message, 'readed' => 0]);

        if ($message->save())
            $msg = ['success' => true, 'msg' => 'Сообщение отправлено'];
        else
            $msg = ['success' => false, 'msg' => 'Произошла ошибка'];

        event(new MessageEvent($message));

        return response()->json($msg);
    }
}