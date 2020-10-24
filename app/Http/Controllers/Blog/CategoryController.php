<?php


namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Query\CategoriesQuery;
use Scandinaver\Blog\UI\Query\CategoryQuery;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Blog
 */
class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        Gate::authorize('view-categories');

        return $this->execute(new CategoriesQuery());
    }

    public function show(int $categoryId): JsonResponse
    {
        Gate::authorize('show-category', $categoryId);

        return $this->execute(new CategoryQuery($categoryId));
    }

    public function store(Request $request): JsonResponse
    {
        Gate::authorize('create-category');

        return $this->execute(new CreateCategoryCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, int $categoryId): JsonResponse
    {
        Gate::authorize('update-category', $categoryId);

        return $this->execute(new UpdateCategoryCommand($categoryId, $request->toArray()));
    }

    public function destroy(int $categoryId): JsonResponse
    {
        Gate::authorize('delete-category', $categoryId);

        return $this->execute(new DeleteCategoryCommand($categoryId), JsonResponse::HTTP_NO_CONTENT);
    }
}