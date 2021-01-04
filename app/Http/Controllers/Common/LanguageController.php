<?php


namespace App\Http\Controllers\Common;


use Gate;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Shared\EventBusNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class LanguageController
 *
 * @package App\Http\Controllers\Common
 */
class LanguageController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function languages(): JsonResponse
    {
        Gate::authorize('view-languages');

        return $this->execute(new LanguagesQuery());
    }

}