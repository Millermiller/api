<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Learn\TestCompleteRequest;
use App\Http\Requests\Learn\UpdatePassingRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learn\Domain\Permission\Test;
use Scandinaver\Learn\UI\Command\CompleteTestCommand;
use Scandinaver\Learn\UI\Command\DeletePassingCommand;
use Scandinaver\Learn\UI\Command\UpdatePassingCommand;
use Scandinaver\Learn\UI\Query\GetAllPassingsQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestController
 *
 * @package App\Http\Controllers\Learn
 */
class TestController extends Controller
{

    /**
     * @param  string  $language
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(string $language): JsonResponse
    {
        Gate::authorize(Test::GET_ALL_PASSINGS);

        return $this->execute(new GetAllPassingsQuery($language));
    }

    /**
     * @param  UpdatePassingRequest  $request
     * @param  int                   $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePassingRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Test::UPDATE_PASSING, $id);

        $data = $request->toArray();

        return $this->execute(new UpdatePassingCommand($id, $data));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Test::DELETE_PASSING, $id);

        return $this->execute(new DeletePassingCommand($id), Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  TestCompleteRequest  $request
     * @param  int                  $assetId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function complete(TestCompleteRequest $request, int $assetId): JsonResponse
    {
        Gate::authorize(Test::COMPLETE, $assetId);

        $data = $request->toArray();

        return $this->execute(new CompleteTestCommand(Auth::user(), $assetId, $data), Response::HTTP_CREATED);
    }
}