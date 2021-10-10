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
     * @param  ReadRequest  $request
     *
     * @return BinaryFileResponse
     * @throws AuthorizationException
     * @throws BindingResolutionException
     */
    public function __invoke(ReadRequest $request): BinaryFileResponse
    {
        Gate::authorize(Reader::READ);

        $text     = $request->get('text');
        $language = $request->get('language');

        $data = $this->commandBus->execute(new ReadQuery(Auth::user(), $language, $text));

        return response()->file($data['path']);
    }
}