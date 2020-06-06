<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Learn\Application\Commands\{GiveNextLevelCommand, SaveTestResultCommand};
use Scandinaver\Learn\Domain\Asset;

/**
 * Class TestController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class TestController extends Controller
{
    /**
     * @param Asset $asset
     *
     * @return JsonResponse
     */
    public function complete(Asset $asset): JsonResponse
    {
        $this->commandBus->execute(new GiveNextLevelCommand(Auth::user(), $asset));

        return response()->json(null, 200);
    }

    /**
     * Сохранить результат
     *
     * @param Asset $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function result(Asset $asset): JsonResponse
    {
        $this->authorize('updateResult', $asset);

        $resultValue = Input::get('result');

        $this->commandBus->execute(new SaveTestResultCommand(Auth::user(), $asset, $resultValue));

        return response()->json(null, 200);
    }
}