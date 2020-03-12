<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Meta;

/**
 * Class IndexController
 * @package Application\Controllers
 */
class IndexController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        Meta::set('title', 'Scandinaver');
        Meta::set('description', 'Scandinaver');

        return view('main.frontend.index.home');
    }
}