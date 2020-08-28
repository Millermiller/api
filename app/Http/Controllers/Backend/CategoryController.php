<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Query\CategoriesQuery;
use Scandinaver\Blog\UI\Query\CategoryQuery;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CategoriesQuery()));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CategoryQuery($id)));
    }

    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateCategoryCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $this->commandBus->execute(new UpdateCategoryCommand($category, $request->toArray()));

        return response()->json(NULL, 201);
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->commandBus->execute(new DeleteCategoryCommand($category));

        return response()->json(NULL, 204);
    }
}