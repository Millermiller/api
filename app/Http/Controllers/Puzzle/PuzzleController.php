<?php


namespace App\Http\Controllers\Puzzle;

use Gate;
use App\Helpers\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Puzzle\Domain\Permissions\Puzzle;
use Scandinaver\Shared\EventBusNotFoundException;
use Scandinaver\Puzzle\UI\Query\UserPuzzlesQuery;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;

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
     * @param  string  $language
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function index(string $language): JsonResponse
    {
        Gate::authorize(Puzzle::VIEW);

        return $this->execute(new PuzzlesQuery($language));
    }

    /**
     * @param  string  $language
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function byUser(string $language): JsonResponse
    {
        Gate::authorize('view-puzzles-by-user');

        return $this->execute(new UserPuzzlesQuery($language, Auth::user()));
    }

    /**
     * @param  int  $puzzleId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function show(int $puzzleId): JsonResponse
    {
        Gate::authorize(Puzzle::SHOW, $puzzleId);

        return $this->execute(new PuzzleQuery($puzzleId));
    }

    /**
     * @param  string  $language
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function store(string $language, Request $request): JsonResponse
    {
        Gate::authorize(Puzzle::CREATE);

        return $this->execute(
          new CreatePuzzleCommand($language, $request->toArray()),
          JsonResponse::HTTP_CREATED
        );
    }

    /**
     * @param  Request  $request
     * @param  int      $puzzleId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $puzzleId): JsonResponse
    {
        Gate::authorize(Puzzle::UPDATE, $puzzleId);
        // return response()->json($puzzle, 200);
    }

    /**
     * @param  string  $language
     * @param  int     $puzzleId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function complete(string $language, int $puzzleId): JsonResponse
    {
        Gate::authorize(Puzzle::COMPLETE, $puzzleId);

        return $this->execute(new PuzzleCompleteCommand(Auth::user(), $puzzleId));
    }

    /**
     * @param  int  $puzzleId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy(int $puzzleId): JsonResponse
    {
        Gate::authorize(Puzzle::DELETE, $puzzleId);

        return $this->execute(new DeletePuzzleCommand($puzzleId), JsonResponse::HTTP_NO_CONTENT);
    }

}