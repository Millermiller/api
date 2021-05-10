<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use Exception;
use Illuminate\Http\{JsonResponse};
use Scandinaver\Shared\EventBusNotFoundException;
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
     * @param  StateRequest  $request
     *
     * @return JsonResponse
     */
    public function state(StateRequest $request): JsonResponse
    {
        $language = $request->get('lang');

        return $this->execute(new GetStateQuery(Auth::user(), $language));
    }
}