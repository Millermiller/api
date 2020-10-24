<?php


namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\UI\Query\LanguagesQuery;

/**
 * Class LanguageController
 *
 * @package App\Http\Controllers\Common
 */
class LanguageController extends Controller
{
    public function languages(): JsonResponse
    {
        Gate::authorize('view-languages');

        return $this->execute(new LanguagesQuery());
    }
}