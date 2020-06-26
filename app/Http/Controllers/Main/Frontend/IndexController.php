<?php


namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Meta;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Main\Frontend
 */
class IndexController extends Controller
{

    public function index()
    {
        echo 'hello';
    }
}