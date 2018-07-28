<?php

/**
 * Class IndexController
 * @package Application\Controllers
 */

namespace Application\Controllers;

use Application\Models\Message;
use Scandinaver\Classes\App;
use Scandinaver\Classes\Controller;
use Scandinaver\Classes\GenericEvent;

class IndexController extends Controller{

    public function index()
    {
        //App::$dispatcher->dispatch('test.event', new GenericEvent($this, array('e', 2, 4)));

        $this->view->setLayout('index')->setTemplate('home')->render();
    }

    public function login()
    {
        $this->view->setLayout('main')
                    ->setTemplate('login')
                    ->render();
    }

    private function getHomePage()
    {
        $this->view->setLayout('main')
                    ->setTemplate('intro')
                    ->render();
    }

    /**
     *
     */
    public function ajaxFeedback()
    {
        if($this->request->isXmlHttpRequest())
        {
            $name = $this->request->get('name', '');
            $message = $this->request->get('message', '');

            $message = new Message(['name' => $name, 'message'=> $message, 'readed'=> 0]);

            if($message->save())
                $this->answer = ['success' => true, 'msg' => 'Сообщение отправлено'];
            else
                $this->answer = ['success' => false, 'msg' => 'Произошла ошибка'];

            App::$dispatcher->dispatch('message.event', new GenericEvent($this, ['name' => $name, 'message' => $message]));

            $this->send();
        }
    }
}