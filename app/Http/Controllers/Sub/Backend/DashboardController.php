<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Services\AdminService;

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
     * @var AdminService
     */
    private $adminService;

    /**
     * DashboardController constructor.
     * @param AdminService $adminService
     */
    public function __construct(\App\Services\AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->adminService->stats());
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