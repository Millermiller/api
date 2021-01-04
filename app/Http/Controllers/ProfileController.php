<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Services\FileService;
use Scandinaver\User\Domain\Services\UserService;
use App\Http\Requests\{ProfileRequest, UploadAvatarRequest};
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Main\Frontend
 */
class ProfileController extends Controller
{
    use ValidatesRequests;

    protected UserService $userService;

    protected FileService $fileService;

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
     * TODO: implement
     *
     * @param  ProfileRequest  $request
     */
    public function edit(ProfileRequest $request)
    {
        $this->userService->updateUserInfo($request->toArray());
    }

    /**
     *  TODO: implement
     *  return user activity
     */
    public function log()
    {

    }
}