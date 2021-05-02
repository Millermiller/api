<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestCompleteRequest;
use App\Http\Requests\UpdatePassingRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learn\Domain\Permission\Test;
use Scandinaver\Learn\UI\Command\CompleteTestCommand;
use Scandinaver\Learn\UI\Command\DeletePassingCommand;
use Scandinaver\Learn\UI\Command\UpdatePassingCommand;
use Scandinaver\Learn\UI\Query\GetAllPassingsQuery;
use Scandinaver\Shared\EventBusNotFoundException;

/**
 * Class TestController
 *
 * @package App\Http\Controllers\Learn
 */
class TestController extends Controller
{

    /**
     * @param  TestCompleteRequest  $request
     * @param  int                  $assetId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function complete(TestCompleteRequest $request, int $assetId): JsonResponse
    {
        Gate::authorize(Test::COMPLETE, $assetId);

        $data = $request->toArray();

        return $this->execute(new CompleteTestCommand(Auth::user(), $assetId, $data), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  string  $language
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function getAllPassing(string $language): JsonResponse
    {
        Gate::authorize(Test::GET_ALL_PASSINGS);

        return $this->execute(new GetAllPassingsQuery($language));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroyPassing(int $id): JsonResponse
    {
        Gate::authorize(Test::DELETE_PASSING, $id);

        return $this->execute(new DeletePassingCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param  UpdatePassingRequest  $request
     * @param  int                   $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function updatePassing(UpdatePassingRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Test::UPDATE_PASSING, $id);

        $data = $request->toArray();

        return $this->execute(new UpdatePassingCommand($id, $data));
    }
}