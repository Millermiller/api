<?php

/**
 * Class ConfigController
 * @package Application\Controllers\Admin
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 29.11.14
 * Time: 18:49
 */

namespace Application\Controllers\Admin;

use Scandinaver\Classes\Controller;

class ConfigController extends Controller {

        public function index()
        {
            $this->view->setLayout('admin');
            $this->view->setTemplate('config');
            $this->view->render();
        }
}