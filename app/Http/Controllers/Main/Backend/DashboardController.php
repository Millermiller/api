<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\User;
use Spatie\Activitylog\Models\Activity;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 16.08.2018
 * Time: 0:54
 *
 * Class DashboardController
 * @package App\Http\Controllers\Main\Backend
 */
class DashboardController extends Controller
{
    public function index()
    {
        // $last_day_users = User::where('created_at', '>', Carbon::yesterday())->count();
        // $message_count = Message::all()->count();
        // $unread = Message::find(['readed' => 0]);

        return response()->json([
            'users'      => User::all()->count(),
            'log'        => Activity::with('causer', 'subject')->get(),
            'messages'   => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    public function deleteMessage($id)
    {
        return response()->json([
            'success'  => Message::destroy($id),
            'messages' => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    public function readMessage($id)
    {
        return response()->json(['success' =>  Message::find($id)->update(['readed' => 1])]);
    }

    public function sendmail()
    {
       // $mailer = new Mailer();

      //  return response()->json(['success' =>   $mailer->reg()]);
    }
}