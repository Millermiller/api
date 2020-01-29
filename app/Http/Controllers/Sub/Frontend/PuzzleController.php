<?php

namespace App\Http\Controllers\Sub\Frontend;

use ReflectionException;
use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\Puzzle\Application\Commands\PuzzleCompleteCommand;
use Scandinaver\Puzzle\Application\Query\UserPuzzlesQuery;

/**
 * Class PuzzleController
 * @package App\Http\Controllers\Sub\Frontend
 *
 * Created by PhpStorm.
 * User: john_
 * Date: 22.11.2018
 * Time: 4:35
 */
class PuzzleController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index()
    {
        return response()->json($this->queryBus->execute(new UserPuzzlesQuery(Auth::user())));
    }

    /**
     *
     * @param Puzzle $puzzle
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function update(Puzzle $puzzle)
    {
        $this->commandBus->execute(new PuzzleCompleteCommand(Auth::user(), $puzzle));

        return response()->json($puzzle, 200);
    }
}