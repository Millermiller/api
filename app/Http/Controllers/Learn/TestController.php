<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Request;
use Scandinaver\Learn\UI\Command\GiveNextLevelCommand;
use Scandinaver\Learn\UI\Command\SaveTestResultCommand;

/**
 * Class TestController
 *
 * @package App\Http\Controllers\Learn
 */
class TestController extends Controller
{
    public function complete(int $asset): JsonResponse
    {
        $this->commandBus->execute(new GiveNextLevelCommand(Auth::user(), $asset));

        return response()->json(null, 200);
    }

    /**
     * Сохранить результат
     *
     * @param  Request  $request
     * @param  int      $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function result(Request $request, int $asset): JsonResponse
    {
        $this->authorize('updateResult', $asset);

        $resultValue = $request->get('result');

        $this->commandBus->execute(new SaveTestResultCommand(Auth::user(), $asset, $resultValue));

        return response()->json(null, 200);
    }
}