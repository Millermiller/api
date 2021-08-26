<?php


namespace App\Http\Controllers\Reader;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reader\ReadRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Reader\Domain\Permission\Reader;
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
     * @param  string       $language
     * @param  ReadRequest  $request
     *
     * @return BinaryFileResponse
     * @throws AuthorizationException|BindingResolutionException
     */
    public function index(string $language, ReadRequest $request): BinaryFileResponse
    {
        Gate::authorize(Reader::READ);

        $text = $request->get('text');

        $data = $this->commandBus->execute(new ReadQuery(Auth::user(), $language, $text));

        return response()->file($data['path']);
    }
}