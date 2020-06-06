<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Language;
use Scandinaver\Puzzle\Application\Commands\PuzzleCompleteCommand;
use Scandinaver\Puzzle\Application\Query\UserPuzzlesQuery;
use Scandinaver\Puzzle\Domain\Puzzle;

/**
 * Class PuzzleController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class PuzzleController extends Controller
{
    /**
     * @param Language $language
     *
     * @return JsonResponse
     */
    public function index(Language $language): JsonResponse
    {
        return response()->json($this->queryBus->execute(new UserPuzzlesQuery(Auth::user())));
    }

    /**
     * @param Puzzle $puzzle
     *
     * @return JsonResponse
     */
    public function update(Puzzle $puzzle): JsonResponse
    {
        $this->commandBus->execute(new PuzzleCompleteCommand(Auth::user(), $puzzle));

        return response()->json($puzzle, 200);
    }
}