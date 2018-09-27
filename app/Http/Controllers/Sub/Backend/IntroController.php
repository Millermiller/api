<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Intro;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:36
 *
 * Class IntroController
 * @package Application\Controllers\Admin
 */
class IntroController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Intro::all()->sortBy('page'));
    }

    public function edit($id)
    {
        /** @var Intro $intro */
        $intro = Intro::find($id)->update([
            'page'     => Input::get('page'),
            'element'  => Input::get('element'),
            'position' => Input::get('position'),
            'sort'     => Input::get('sort'),
            'tooltipClass' => Input::get('tooltipClass'),
            'intro'  => Input::get('content'),
            'active' => Input::get('active'),
        ]);

        return response()->json(['success' => $intro]);
    }

    public function delete($id)
    {
        return response()->json(['success' => Intro::destroy($id)]);
    }

    public function create()
    {
        $intro =  new Intro();
        if($intro->save()) return response()->json(['success' => true, 'intro' => $intro]);
    }
}