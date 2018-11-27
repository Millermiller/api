<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Events\UserPhotoUpdated;
use App\Http\Controllers\Controller;
use App\Services\Requester;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Meta;
use Session;
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
    use ValidatesRequests;

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

    public function uploadImage()
    {
        $storage = new FileSystem(public_path('/uploads/u/'));
        $file = new File('photo', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            new Mimetype(array('image/png', 'image/jpg', 'image/jpeg')),
            new Size('2M')
        ));

        $msg['msg'] = 'Фотография профиля изменена';
        $msg['success'] = true;

        try {
            $file->upload();

            Auth::user()->photo = $file->getNameWithExtension();

            if (Auth::user()->save())
                event(new UserPhotoUpdated(Auth::user()));

        } catch (\Exception $e) {
            $errors = $file->getErrors();
            $message = implode(', ', $errors);
            $msg['msg'] = $message;
            $msg['success'] = false;
            $msg['mess'] = $e->getMessage();
        }

        return response()->json($msg);
    }

    /**
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string|alpha_num|max:255|unique:users,login,' . Auth::user()->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|string|min:6|confirmed',
        ],
            [
                'required' => 'Обязательное поле',
                'alpha_num' => 'Только латинские буквы и цифры',
                'confirmed' => 'Пароли не совпадают',
                'unique' => 'Пользователь уже зарегистрирован',
                'min' => 'Минимум :min символов',
                'email' => 'Укажите корректный email',
            ]
        );

        $oldemail = Auth::user()->email;

        Auth::user()->update([
            'login' => $request->post('login'),
            'email' => $request->post('email'),
            'password' => bcrypt($request->post('password'))
        ]);

        $data['login'] = $request->post('login');
        $data['email'] = $request->post('email');
        $data['password'] = $request->post('password');

        Session::flash('message', 'Пользовательские данные обновлены');
        Session::flash('alert-class', 'success');

        Requester::updateForumUser($data, $oldemail);

        return redirect()->route('frontend::profile');
    }
}