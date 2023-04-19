<?php


namespace App\Http\Controllers\Puzzle;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use App\Http\Requests\HasLanguageRequest;
use App\Http\Requests\Puzzle\CreatePuzzleRequest;
use App\Http\Requests\Puzzle\UpdatePuzzleRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use JsonMapper_Exception;
use Scandinaver\Learning\Puzzle\Domain\Permission\Puzzle;
use Scandinaver\Learning\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Learning\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Learning\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Learning\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Learning\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Learning\Puzzle\UI\Query\UserPuzzlesQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:39
 * Class PuzzleController
 *
 * @package Application\Controllers\Puzzle
 */
class PuzzleController extends Controller
{

    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException|JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(Puzzle::VIEW);

        return $this->execute(new PuzzlesQuery($request->getRequestParameters()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Puzzle::SHOW, $id);

        return $this->execute(new PuzzleQuery($id));
    }

    /**
     * @param  CreatePuzzleRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreatePuzzleRequest $request): JsonResponse
    {
        Gate::authorize(Puzzle::CREATE);

        $language = $request->get('language');

        return $this->execute(new CreatePuzzleCommand($language, $request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdatePuzzleRequest  $request
     * @param  int                  $id
     * TODO: implement
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePuzzleRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Puzzle::UPDATE, $id);
        return response()->json(null, 200);
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Puzzle::DELETE, $id);

        return $this->execute(new DeletePuzzleCommand($id), Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  HasLanguageRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function byUser(HasLanguageRequest $request): JsonResponse
    {
        Gate::authorize('view-puzzles-by-user');

        $language = $request->get('lang');

        return $this->execute(new UserPuzzlesQuery($language, Auth::user()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function complete(int $id): JsonResponse
    {
        Gate::authorize(Puzzle::COMPLETE, $id);

        return $this->execute(new PuzzleCompleteCommand(Auth::user(), $id));
    }
}