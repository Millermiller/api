<?php


namespace App\Http\Controllers\Main\Frontend;

use Auth;
use Illuminate\Http\JsonResponse;
use Meta;
use Scandinaver\Common\Domain\Services\FileService;
use Scandinaver\User\Domain\Services\UserService;
use Session;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\{ProfileRequest, UploadAvatarRequest};
use Illuminate\Foundation\Validation\ValidatesRequests;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ProfileController
 *
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
     *
     * @param UserService $userService
     * @param FileService $fileService
     */
    public function __construct(UserService $userService, FileService $fileService)
    {
        $this->userService = $userService;
        $this->fileService = $fileService;
    }

    /**
     * @return array|Factory|View|mixed
     */
    public function index()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.info', ['user' => Auth::user()]);
    }

    /**
     * @return array|Factory|View|mixed
     */
    public function settings()
    {
        Meta::set('title', 'Профиль');

        return view('main.frontend.profile.settings', ['user' => Auth::user()]);
    }

    /**
     * @param UploadAvatarRequest $request
     *
     * @return JsonResponse
     */
    public function uploadImage(UploadAvatarRequest $request): JsonResponse
    {
        $request->validated();

        $this->fileService->uploadAvatar($request);

        return response()->json(['success' => true, 'msg' => 'Фотография успешно загружена']);
    }

    /**
     * @param ProfileRequest $request
     *
     * @return RedirectResponse
     */
    public function edit(ProfileRequest $request)
    {
        $this->userService->updateUserInfo($request->toArray());

        Session::flash('message', 'Пользовательские данные обновлены');
        Session::flash('alert-class', 'success');

        return redirect()->route('frontend::profile');
    }

    /**
     * @return Factory|View
     */
    public function log()
    {
        Meta::set('title', 'Профиль');

        $logs = Activity::where([
            'causer_id' => Auth::user()->getKey(),
            'log_name'  => 'public'
        ])->orderBy('id', 'DESC')
                        ->paginate(5);

        return view('main.frontend.profile.logs', ['logs' => $logs, 'user' => Auth::user()]);
    }
}