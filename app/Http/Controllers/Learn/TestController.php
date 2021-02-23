<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestCompleteRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learn\Domain\Permissions\Test;
use Scandinaver\Learn\UI\Command\CompleteTestCommand;

/**
 * Class TestController
 *
 * @package App\Http\Controllers\Learn
 */
class TestController extends Controller
{

    /**
     * @param  TestCompleteRequest  $request
     * @param  string               $language
     * @param  int                  $assetId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function complete(TestCompleteRequest $request, string $language, int $assetId): JsonResponse
    {
        Gate::authorize(Test::COMPLETE, $assetId);

        $data = $request->toArray();

        $this->commandBus->execute(new CompleteTestCommand(Auth::user(), $assetId, $data));
    }
}