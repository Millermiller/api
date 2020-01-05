<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use Illuminate\Http\JsonResponse;
use Scandinaver\Puzzle\Domain\{Puzzle, PuzzleService};

/**
 * Class PuzzleController
 * @package App\Http\Controllers\Sub\Frontend
 *
 * Created by PhpStorm.
 * User: john_
 * Date: 22.11.2018
 * Time: 4:35
 */
class PuzzleController
{
    /**
     * @var PuzzleService
     */
    private $puzzleService;

    /**
     * PuzzleController constructor.
     * @param PuzzleService $puzzleService
     */
    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->puzzleService->getForUser(Auth::user()));
    }

    /**
     *
     * @param Puzzle $puzzle
     * @return JsonResponse
     */
    public function update(Puzzle $puzzle)
    {
        $this->puzzleService->completed(Auth::user(), $puzzle);

        return response()->json($puzzle, 200);
    }
}