<?php


namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\Application\Commands\CreateCategoryCommand;
use Scandinaver\Blog\Application\Commands\DeleteCategoryCommand;
use Scandinaver\Blog\Application\Commands\UpdateCategoryCommand;
use Scandinaver\Blog\Application\Query\CategoriesQuery;
use Scandinaver\Blog\Application\Query\CategoryQuery;
use Scandinaver\Blog\Domain\Category;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CategoriesQuery()));
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CategoryQuery($id)));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateCategoryCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param Request  $request
     * @param Category $category
     *
     * @return JsonResponse
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $this->commandBus->execute(new UpdateCategoryCommand($category, $request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param Category $category
     *
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->commandBus->execute(new DeleteCategoryCommand($category));

        return response()->json(NULL, 204);
    }
}