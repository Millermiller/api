<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Intro;
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
 * @package Application\Controllers\Common
 */
class IntroController extends Controller
{

    public function index(): JsonResponse
    {
        Gate::authorize('view-intros');

        return $this->execute(new IntrosQuery());
    }

    public function show($id): JsonResponse
    {
        Gate::authorize('show-intro', $id);

        return $this->execute(new IntroQuery($id));
    }

    public function store(Request $request): JsonResponse
    {
        Gate::authorize('create-intro');

        return $this->execute(new CreateIntroCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id): JsonResponse
    {
        Gate::authorize('update-intro', $id);

        return $this->execute(new UpdateIntroCommand($id, $request->toArray()));
    }

    public function destroy($id): JsonResponse
    {
        Gate::authorize('delete-intro', $id);

        return $this->execute(new DeleteIntroCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }
}