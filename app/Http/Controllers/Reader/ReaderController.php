<?php


namespace App\Http\Controllers\Reader;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Scandinaver\Reader\Domain\Permissions\Reader;
use Scandinaver\Reader\UI\Query\ReadQuery;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ReaderController
 *
 * @package App\Http\Controllers\Reader
 */
class ReaderController extends Controller
{

    /**
     * @param  string   $language
     * @param  Request  $request
     *
     * @return BinaryFileResponse
     * @throws AuthorizationException|BindingResolutionException
     */
    public function index(string $language, Request $request): BinaryFileResponse
    {
        Gate::authorize(Reader::READ);

        $text = $request->get('text');

        return response()->file($this->queryBus->execute(new ReadQuery(Auth::user(), $language, $text)));
    }
}