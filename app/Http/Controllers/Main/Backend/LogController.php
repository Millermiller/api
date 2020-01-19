<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

/**
 * Class SeoController
 * @package App\Http\Controllers\Main\Backend
 */
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Activity::with('causer', 'subject')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Activity::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $log = Activity::findOrFail($id);
        $log->delete();

        return response()->json(null, 204);
    }
}