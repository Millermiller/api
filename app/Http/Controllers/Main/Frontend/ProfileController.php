<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Events\UserPhotoUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\FeedbackService;
use App\Services\Requester;
use App\Services\UserService;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Meta;
use Session;
use Spatie\Activitylog\Models\Activity;
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

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.info', ['user' => Auth::user()]);
    }

    public function settings()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.settings', ['user' => Auth::user()]);
    }

    public function uploadImage()
    {
        $storage = new FileSystem(public_path('/uploads/u/'));
        $file = new File('photo', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations([
            new Mimetype(['image/png', 'image/jpg', 'image/jpeg']),
            new Size('2M')
        ]);

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
            $msg['mess1'] = $e->getTraceAsString();
        }

        return response()->json($msg);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(ProfileRequest $request)
    {
        $oldemail = Auth::user()->email;

        Auth::user()->update([
            'login' => $request->post('login'),
            'email' => $request->post('email'),
            'password' => ($request->post('password')) ? bcrypt($request->post('password')) : Auth::user()->password
        ]);

        $data['login'] = $request->post('login');
        $data['email'] = $request->post('email');
        $data['password'] = $request->post('password');

        Session::flash('message', 'Пользовательские данные обновлены');
        Session::flash('alert-class', 'success');

        Requester::updateForumUser($data, $oldemail);

        return redirect()->route('frontend::profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function log()
    {
        Meta::set('title', 'Профиль');

        $logs = Activity::where([
            'causer_id' => Auth::user()->id,
            'log_name'  => 'public'
        ])->orderBy('id', 'DESC')
            ->paginate(5);

        return view('main.frontend.profile.logs', ['logs' => $logs, 'user' => Auth::user()]);
    }
}