<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse};
use Scandinaver\User\UI\Query\GetStateQuery;
use Scandinaver\User\UI\Query\GetUserQuery;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class IndexController extends Controller
{
    public function getUser(): JsonResponse
    {
        return $this->execute(new GetUserQuery(Auth::user()));
    }

    public function getInfo(): JsonResponse
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    public function state(string $language): JsonResponse
    {
        return $this->execute(new GetStateQuery(Auth::user(), $language));
    }
}