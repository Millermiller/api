<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\CreateIntroRequest;
use App\Http\Requests\Common\UpdateIntroRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Permission\Intro;
use Scandinaver\Common\UI\Command\CreateIntroCommand;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Common\UI\Command\UpdateIntroCommand;
use Scandinaver\Common\UI\Query\IntroQuery;
use Scandinaver\Common\UI\Query\IntrosQuery;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:36
 * Class IntroController
 *
 * @package App\Http\Controllers\Common
 */
class IntroController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Intro::VIEW);

        return $this->execute(new IntrosQuery());
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id): JsonResponse
    {
        Gate::authorize(Intro::SHOW, $id);

        return $this->execute(new IntroQuery($id));
    }

    /**
     * @param  CreateIntroRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateIntroRequest $request): JsonResponse
    {
        Gate::authorize(Intro::CREATE);

        return $this->execute(new CreateIntroCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  UpdateIntroRequest  $request
     * @param                      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateIntroRequest $request, $id): JsonResponse
    {
        Gate::authorize(Intro::UPDATE, $id);

        return $this->execute(new UpdateIntroCommand($id, $request->toArray()));
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy($id): JsonResponse
    {
        Gate::authorize(Intro::DELETE, $id);

        return $this->execute(new DeleteIntroCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }
}