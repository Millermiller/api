<?php


namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class DashboardController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // $last_day_users = User::where('created_at', '>', Carbon::yesterday())->count();
        // $message_count = Message::all()->count();
        // $unread = Message::find(['readed' => 0]);

        return response()->json([
            'users'    => User::all()->count(),
            'log'      => Activity::with('causer', 'subject')->get(),
            'messages' => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function readMessage($id): JsonResponse
    {
        return response()->json(['success' => Message::find($id)->update(['readed' => 1])]);
    }

    public function sendmail()
    {
        // $mailer = new Mailer();

        //  return response()->json(['success' =>   $mailer->reg()]);
    }
}