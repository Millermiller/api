<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Puzzle;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:39
 *
 * Class PuzzleController
 * @package Application\Controllers\Admin
 */
class PuzzleController extends Controller
{

    public function index()
    {
        return response()->json(Puzzle::paginate());
      //  return response()->json([
      //      'total' => Puzzle::all()->count(),
      //      'per_page' => 1,
      //      'current_page' => 1,
      //      'last_page' =>1,
      //      'next_page_url' => "/admin/puzzles?page=2",
      //      'prev_page_url' => null,
      //      'from' => 1,
      //      'to' => 15,
      //      'data' => Puzzle::all()
      //  ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function add()
    {
        /** @var Puzzle $puzzle */
        $puzzle = new Puzzle();

        $text  = $this->cleartext(Input::get('text'));
        $translate = $this->cleartext(Input::get('translate'));

        $puzzle->text = $text;
        $puzzle->translate = $translate;

        return response()->json(['success' => $puzzle->save()]);
    }

    protected function cleartext($text)
    {
        return  str_replace(array("\r\n", "\r", "\n"), '', strip_tags(trim($text)));
    }
}