<?php


namespace App\Http\Controllers\Puzzle;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Puzzle\UI\Query\UserPuzzlesQuery;

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

    public function index(string $language): JsonResponse
    {
        Gate::authorize('view-puzzles');

        return $this->execute(new PuzzlesQuery($language));
    }

    public function byUser(string $language): JsonResponse
    {
        Gate::authorize('view-puzzles-by-user');

        return $this->execute(new UserPuzzlesQuery($language, Auth::user()));
    }

    public function show(int $puzzleId): JsonResponse
    {
        Gate::authorize('show-puzzle', $puzzleId);

        return $this->execute(new PuzzleQuery($puzzleId));
    }

    public function store(string $language, Request $request): JsonResponse
    {
        Gate::authorize('create-puzzle');

        return $this->execute(new CreatePuzzleCommand($language, $request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, int $puzzleId): JsonResponse
    {
        Gate::authorize('update-puzzle', $puzzleId);

        // return response()->json($puzzle, 200);
    }

    public function complete(string $language, int $puzzleId): JsonResponse
    {
        Gate::authorize('complete-puzzle', $puzzleId);

        return $this->execute(new PuzzleCompleteCommand(Auth::user(), $puzzleId));
    }

    public function destroy(int $puzzleId): JsonResponse
    {
        Gate::authorize('delete-puzzle', $puzzleId);

        return $this->execute(new DeletePuzzleCommand($puzzleId), JsonResponse::HTTP_NO_CONTENT);
    }
}