<?php

/**
 * Class ProfileController
 * @package Application\Controllers
 */

namespace Application\Controllers;

use Application\Services\Api\Requester;
use Intervention\Image\ImageManagerStatic as Image;
use Scandinaver\Classes\Controller;
use Scandinaver\Classes\User;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

class ProfileController extends Controller
{
    public function index()
    {
        $user = \Application\Models\User::find(User::$id);

        $this->view->setLayout('index')
                        ->setTemplate('index')
                        ->add('user', $user)
                        ->render();
    }

    public function settings()
    {
        $user = \Application\Models\User::find(User::$id);

        $this->view->setLayout('index')
            ->setTemplate('settings')
            ->add('user', $user)
            ->render();
    }

    public function uploadImage(){
        $storage = new FileSystem(PUBLIC_PATH.'/uploads/photo/');
        $file = new File('img', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            new Mimetype(array('image/png','image/jpg','image/jpeg')),
            new Size('5M')
        ));

        $this->answer['msg'] = 'Фотография профиля изменена';
        $this->answer['success']  = true;
        $url = '';

        try {
            $file->upload();
            $url = '/uploads/photo/'.$file->getNameWithExtension();

           // Image::configure(array('driver' => 'GD'));
            $img = Image::make(PUBLIC_PATH.$url);

            if($img->getWidth() > 1000)
                $img->widen(600);

            if($img->getHeight() > 1000)
                $img->heighten(600);

            $img->save(null, 100);

            $thumb = Image::make(PUBLIC_PATH.$url);
            $thumb->widen(150);
            $thumb->save(PUBLIC_PATH.'/uploads/thumbs/'.$file->getNameWithExtension());

            /**
             * @var \Application\Models\User $user
             */
            $user = \Application\Models\User::find(User::$id);
            $user->photo = $url;
            $user->avatar ='/uploads/thumbs/'.$file->getNameWithExtension();

            if($user->save())
                Requester::updateForumUser(['username' => $user->login, 'email'=> $user->email, 'password' => false, 'newemail'=>false,'avatar' => $user->photo]);

        } catch (\Exception $e) {
            $errors = $file->getErrors();
            $message = implode(', ',$errors);
            $this->answer['msg'] = $message;
            $this->answer['success']  = false;
            $this->answer['mess']  = $e->getMessage();
        }

        $this->send();
    }

    public function update()
    {
        $data['email'] = $this->request->get('lk-email');
        $data['login'] = $this->request->get('lk-login');
        $data['name']  = $this->request->get('lk-name');
        $pass1 = $this->request->get('pass', null);
        $pass2 = $this->request->get('pass-repeat', null);

        if($pass1 != null && $pass1 != null && $pass1 == $pass2){
            $data['pass'] = md5($pass1);
            $data['openpass'] = $pass1;
        }

        if(\Application\Models\User::find(User::$id)->update($data))
            Requester::updateForumUser(['username' => $data['login'], 'email'=> User::$email, 'newemail'=> $data['email'], 'password' => $data['openpass']]);

        $this->redirect('cabinet');
    }
}