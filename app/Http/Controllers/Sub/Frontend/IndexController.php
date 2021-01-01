<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Exception;
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

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getUser(): JsonResponse
    {
        return $this->execute(new GetUserQuery(Auth::user()));
    }

    /**
     * @return JsonResponse
     */
    public function getInfo(): JsonResponse
    {
        return response()->json(['site' => config('app.MAIN_SITE')]);
    }

    /**
     * @param  string  $language
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function state(string $language): JsonResponse
    {
        return $this->execute(new GetStateQuery(Auth::user(), $language));
    }
}