<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Meta;
use Redis;

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