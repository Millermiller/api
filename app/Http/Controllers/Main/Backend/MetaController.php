<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ReflectionException;
use Scandinaver\Blog\Application\Commands\CreateCommentCommand;
use Scandinaver\Blog\Application\Commands\DeleteCommentCommand;
use Scandinaver\Blog\Application\Commands\UpdateCommentCommand;
use Scandinaver\Blog\Application\Query\CommentQuery;
use Scandinaver\Blog\Application\Query\CommentsQuery;
use Scandinaver\Blog\Domain\Comment;
use Scandinaver\Common\Application\Commands\CreateMetaCommand;
use Scandinaver\Common\Application\Commands\DeleteMetaCommand;
use Scandinaver\Common\Application\Commands\UpdateMetaCommand;
use Scandinaver\Common\Application\Query\MetaQuery;
use Scandinaver\Common\Application\Query\MetasQuery;

/**
 * Class SeoController
 * @package App\Http\Controllers\Main\Backend
 */
class MetaController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index()
    {
        return response()->json($this->queryBus->execute(new MetasQuery()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id)
    {
        return response()->json($this->queryBus->execute(new MetaQuery($id)));
    }

    /**
     * @param  Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Request $request)
    {
        $this->commandBus->execute(new CreateMetaCommand($request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @param Meta $meta
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function update(Request $request, Meta $meta)
    {
        $this->commandBus->execute(new UpdateMetaCommand($meta, $request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy(Meta $meta)
    {
        $this->commandBus->execute(new DeleteMetaCommand($meta));

        return response()->json(null, 204);
    }
}