<?php


namespace App\Http\Controllers\Reader;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Scandinaver\Reader\UI\Query\ReadQuery;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ReaderController
 *
 * @package App\Http\Controllers\Reader
 */
class ReaderController extends Controller
{
    public function index(string $language, Request $request): BinaryFileResponse
    {
        Gate::authorize('read');

        $text = $request->get('text');

        return response()->file($this->queryBus->execute(new ReadQuery(Auth::user(), $language, $text)));
    }
}