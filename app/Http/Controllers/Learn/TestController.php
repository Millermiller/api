<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use App\Http\Requests\Learn\TestCompleteRequest;
use App\Http\Requests\Learn\UpdatePassingRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use JsonMapper_Exception;
use Scandinaver\Learning\Asset\Domain\Permission\Test;
use Scandinaver\Learning\Asset\UI\Command\CompleteTestCommand;
use Scandinaver\Learning\Asset\UI\Command\DeletePassingCommand;
use Scandinaver\Learning\Asset\UI\Command\UpdatePassingCommand;
use Scandinaver\Learning\Asset\UI\Query\GetAllPassingsQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestController
 *
 * @package App\Http\Controllers\Learn
 */
class TestController extends Controller
{

    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException|JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(Test::GET_ALL_PASSINGS);

        $includes = $request->get('includes', []);
        $params   = $request->getRequestParameters();

        return $this->execute(new GetAllPassingsQuery($includes, $params));
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
     * @param  string               $assetId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function complete(TestCompleteRequest $request, string $assetId): JsonResponse
    {
        Gate::authorize(Test::COMPLETE, $assetId);

        $data = $request->toArray();

        return $this->execute(new CompleteTestCommand(Auth::user(), $assetId, $data), Response::HTTP_CREATED);
    }
}