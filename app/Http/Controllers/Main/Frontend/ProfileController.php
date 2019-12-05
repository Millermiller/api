<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{ProfileRequest, UploadAvatarRequest};
use App\Services\{FileService, UserService};
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Meta;
use Session;
use Spatie\Activitylog\Models\Activity;

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

    /**
     * ProfileController constructor.
     * @param UserService $userService
     * @param FileService $fileService
     */
    public function __construct(UserService $userService, FileService $fileService)
    {
        $this->userService = $userService;
        $this->fileService = $fileService;
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.info', ['user' => Auth::user()]);
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function settings()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.settings', ['user' => Auth::user()]);
    }

    /**
     * @param UploadAvatarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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
    public function edit(ProfileRequest $request)
    {
        $this->userService->updateUserInfo($request->toArray());

        Session::flash('message', 'Пользовательские данные обновлены');
        Session::flash('alert-class', 'success');

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