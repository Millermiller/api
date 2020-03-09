<?php

namespace App\Http\Controllers\Sub\Backend;

use ReflectionException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Common\Application\Query\{IntroQuery, IntrosQuery};
use Scandinaver\Common\Application\Commands\CreateIntroCommand;
use Scandinaver\Common\Application\Handlers\CreateIntroCommandHandler;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:36
 *
 * Class IntroController
 * @package Application\Controllers\Admin
 */
class IntroController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index()
    {
        return response()->json($this->queryBus->execute(new IntrosQuery()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id)
    {
        return response()->json($this->queryBus->execute(new IntroQuery($id)));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Request $request)
    {
        $intro =  new Intro();

        $this->commandBus->execute(new CreateIntroCommand($request->toArray()));
        return response()->json(null, 201);
    }

    public function update(Request $request, $id)
    {
        $intro = Intro::findOrFail($id);
        $intro->update($request->all());

        return response()->json($intro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $puzzle = Intro::findOrFail($id);
        $puzzle->delete();

        return response()->json(null, 204);
    }
}