<?php


namespace App\Http\Controllers\Backend;

use ReflectionException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\UI\Command\CreateIntroCommand;
use Scandinaver\Common\UI\Query\IntroQuery;
use Scandinaver\Common\UI\Query\IntrosQuery;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:36
 * Class IntroController
 *
 * @package Application\Controllers\Admin
 */
class IntroController extends Controller
{
    /**
     * @throws ReflectionException
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new IntrosQuery()));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new IntroQuery($id)));
    }

    public function store(Request $request): JsonResponse
    {
        $intro = new Intro();

        $this->commandBus->execute(new CreateIntroCommand($request->toArray()));
        return response()->json(null, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $intro = Intro::findOrFail($id);
        $intro->update($request->all());

        return response()->json($intro, 200);
    }

    public function destroy($id): JsonResponse
    {
        $puzzle = Intro::findOrFail($id);
        $puzzle->delete();

        return response()->json(null, 204);
    }
}