<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 29.06.2018
 * Time: 16:26
 *
 * Class ProfileController
 * @package Application\Controllers
 */
class PaymentController extends Controller
{
    public function index()
    {
        return view('main.frontend.payment.index');
    }
}