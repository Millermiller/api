<?php


namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Http\Requests\{ProfileRequest, UploadAvatarRequest};
use Illuminate\Http\JsonResponse;
use Scandinaver\Shared\EventBusNotFoundException;
use Scandinaver\User\UI\Command\UpdateUserSettingsCommand;
use Scandinaver\User\UI\Command\UploadAvatarCommand;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Main\Frontend
 */
class ProfileController extends Controller
{
    /**
     * @param  UploadAvatarRequest  $request
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function uploadImage(UploadAvatarRequest $request): JsonResponse
    {
        return $this->execute(new UploadAvatarCommand(Auth::user(), $request->file('file')));
    }

    /**
     * @param  ProfileRequest  $request
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function edit(ProfileRequest $request): JsonResponse
    {
        // Gate::authorize(Category::SHOW, $categoryId);

        return $this->execute(new UpdateUserSettingsCommand(Auth::user(), $request->toArray()));
    }

    /**
     *  TODO: implement
     *  return user activity
     */
    public function log()
    {

    }
}