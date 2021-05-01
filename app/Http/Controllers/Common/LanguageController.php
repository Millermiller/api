<?php


namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Shared\EventBusNotFoundException;

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
     */
    public function index(): JsonResponse
    {
        Gate::authorize('view-languages');

        return $this->execute(new LanguagesQuery());
    }

}