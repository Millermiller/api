<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Services\Requester;
use Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Meta;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

/**
 * Class ProfileController
 * @package Application\Controllers
 */
class ProfileController extends Controller
{
    public function index()
    {
        Meta::set('title', 'Профиль');
        Meta::set('description', 'This is my home. Enjoy!');

        return view('main.frontend.profile.info', ['user' => Auth::user()]);
    }

    public function settings()
    {
        return view('main.frontend.profile.settings', ['user' => Auth::user()]);
    }

    public function uploadImage(){
        $storage = new FileSystem(public_path('/uploads/photo/'));
        $file = new File('img', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            new Mimetype(array('image/png','image/jpg','image/jpeg')),
            new Size('5M')
        ));

        $msg['msg'] = 'Фотография профиля изменена';
        $msg['success']  = true;

        try {
            $file->upload();
            $url = '/uploads/photo/'.$file->getNameWithExtension();

           // Image::configure(array('driver' => 'GD'));
            $img = Image::make(public_path($url));

            if($img->getWidth() > 1000)
                $img->widen(600);

            if($img->getHeight() > 1000)
                $img->heighten(600);

            $img->save(null, 100);

            $thumb = Image::make(public_path($url));
            $thumb->widen(150);
            $thumb->save(public_path('/uploads/thumbs/'.$file->getNameWithExtension()));

            Auth::user()->photo = $url;
            Auth::user()->avatar ='/uploads/thumbs/'.$file->getNameWithExtension();

            if(Auth::user()->save())
                Requester::updateForumUser(Auth::user(), false);

        } catch (\Exception $e) {
            $errors = $file->getErrors();
            $message = implode(', ',$errors);
            $msg['msg'] = $message;
            $msg['success']  = false;
            $msg['mess']  = $e->getMessage();
        }

        return response()->json($msg);
    }

    public function update()
    {
        Auth::user()->email = Input::get('lk-email');
        Auth::user()->login = Input::get('lk-login');
        Auth::user()->name  = Input::get('lk-name');
        $pass1 = Input::get('pass', null);
        $pass2 = Input::get('pass-repeat', null);

        if($pass1 != null && $pass1 != null && $pass1 == $pass2){
            $data['pass'] = md5($pass1);
            $data['openpass'] = $pass1;
        }

        if(Auth::user()->save())
            Requester::updateForumUser(Auth::user(), Auth::user()->email);

       return redirect()->route('cabinet');
    }
}