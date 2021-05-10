<?php


namespace App\Http\Controllers\User;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UploadAvatarRequest;
use Illuminate\Http\JsonResponse;
use Request;
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
     */
    public function uploadImage(UploadAvatarRequest $request): JsonResponse
    {
        return $this->execute(new UploadAvatarCommand(Auth::user(), $request->file('file')));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function edit(Request $request): JsonResponse
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