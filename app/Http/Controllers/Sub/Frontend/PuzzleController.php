<?php

namespace App\Http\Controllers\Sub\Frontend;

use Auth;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\{JsonResponse, Request};
use App\Repositories\Puzzle\PuzzleRepositoryInterface;

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
     * @var PuzzleRepositoryInterface
     */
    private $puzzleRepository;

    /**
     * PuzzleController constructor.
     * @param PuzzleRepositoryInterface $puzzleRepository
     */
    public function __construct(PuzzleRepositoryInterface $puzzleRepository)
    {
        $this->puzzleRepository = $puzzleRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $puzzles = $this->puzzleRepository->getForUser(Auth::user());

        return response()->json($puzzles);
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Request $request, $id)
    {
        $puzzle = $this->puzzleRepository->get($id);

        Auth::user()->addPuzzle($puzzle);

        app('em')->flush();

        return response()->json($puzzle, 200);
    }
}