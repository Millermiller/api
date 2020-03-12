<?php


namespace App\Http\Controllers\Sub\Frontend;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 06.02.15
 * Time: 0:52
 *
 * Class LogoutController
 * @package App\Http\Controllers\Sub\Frontend
 */
class LogoutController extends Controller {

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        setcookie('token', 'w', time()-1000, '/', '.'.config('app.DOMAIN'));
        setcookie('user',  'w', time()-1000, '/', '.'.config('app.DOMAIN'));

        Auth::logout();

        return response()->json(['success' => true]);
    }
}