<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;

/**
 * Class LogController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class LogController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Activity::with('causer', 'subject')->get());
    }

    public function show($id): JsonResponse
    {
        return response()->json(Activity::findOrFail($id));
    }

    public function destroy($id): JsonResponse
    {
        Activity::destroy($id);

        return response()->json(null, 204);
    }
}