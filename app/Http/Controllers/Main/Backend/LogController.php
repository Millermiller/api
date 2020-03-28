<?php


namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;

/**
 * Class SeoController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Activity::with('causer', 'subject')->get());
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
        return response()->json(Activity::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id): JsonResponse
    {
        Activity::destroy($id);

        return response()->json(null, 204);
    }
}