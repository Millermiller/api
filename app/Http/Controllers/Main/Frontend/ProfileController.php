<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Events\UserPhotoUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UploadAvatarRequest;
use App\Services\FeedbackService;
use App\Services\FileService;
use App\Services\Requester;
use App\Services\UserService;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
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

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var FileService
     */
    protected $fileService;

    public function __construct(UserService $userService, FileService $fileService)
    {
        $this->userService = $userService;
        $this->fileService = $fileService;
    }

    public function index()
    {
        Meta::set('title', 'Профиль');

      //  dd(Auth::user()->getAvatar());
        return view('main.frontend.profile.info', ['user' => Auth::user()]);
    }

    public function settings()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.settings', ['user' => Auth::user()]);
    }

    public function uploadImage(UploadAvatarRequest $request)
    {
        $request->validated();

        $this->fileService->uploadAvatar($request);

        return response()->json(['success' => true, 'msg' => 'Фотография успешно загружена']);
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