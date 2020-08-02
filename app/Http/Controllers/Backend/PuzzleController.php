<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json(Puzzle::findOrFail($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(Puzzle::create($request->all()), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->update($request->all());

        return response()->json($puzzle, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->delete();

        return response()->json(null, 204);
    }
}