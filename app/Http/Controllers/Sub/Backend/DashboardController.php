<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Message;
use App\Models\Text;
use App\Models\Word;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:26
 *
 * Class DashboardController
 * @package Application\Controllers\Admin
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'words'      => Word::all()->count(),
            'assets'     => Asset::all()->count(),
            'audiofiles' => Word::where('audio', '!=', null)->count(),
            'texts'      => Text::all()->count(),
            'messages'   => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMessage($id)
    {
        return response()->json([
            'success'  => Message::destroy($id),
            'messages' => array_values(Message::all()->sortByDesc('created_at')->toArray())
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function readMessage($id)
    {
        return response()->json(['success' =>  Message::find($id)->update(['readed' => 1])]);
    }
}