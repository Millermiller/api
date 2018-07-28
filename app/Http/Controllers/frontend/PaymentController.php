<?php

/**
 * Created by PhpStorm.
 * User: john
 * Date: 29.06.2018
 * Time: 16:26
 *
 * Class ProfileController
 * @package Application\Controllers
 */

namespace Application\Controllers;

use Scandinaver\Classes\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $this->view->setLayout('index')
            ->setTemplate('index')
            ->render();
    }
}