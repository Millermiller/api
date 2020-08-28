<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Puzzle\Infrastructure\Persistence\Eloquent\Puzzle;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:39
 * Class PuzzleController
 *
 * @package Application\Controllers\Admin
 */
class PuzzleController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json(Puzzle::all());
    }

    public function show($id): JsonResponse
    {
        return response()->json(Puzzle::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json(Puzzle::create($request->all()), 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->update($request->all());

        return response()->json($puzzle, 200);
    }

    public function destroy($id): JsonResponse
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->delete();

        return response()->json(null, 204);
    }
}