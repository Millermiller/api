<?php


namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateCategoryRequest;
use App\Http\Requests\Blog\UpdateCategoryRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse};
use Scandinaver\Blog\Domain\Permission\Category;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Query\{CategoriesQuery, CategoryQuery};
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Blog
 */
class CategoryController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Category::VIEW);

        return $this->execute(new CategoriesQuery());
    }

    /**
     * @param  int  $categoryId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $categoryId): JsonResponse
    {
        //Gate::authorize(Category::SHOW, $categoryId);

        return $this->execute(new CategoryQuery($categoryId));
    }

    /**
     * @param  CreateCategoryRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        Gate::authorize(Category::CREATE);

        return $this->execute(new CreateCategoryCommand($request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdateCategoryRequest  $request
     * @param  int                    $categoryId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateCategoryRequest $request, int $categoryId): JsonResponse
    {
        Gate::authorize(Category::UPDATE, $categoryId);

        return $this->execute(new UpdateCategoryCommand($categoryId, $request->toArray()));
    }

    /**
     * @param  int  $categoryId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $categoryId): JsonResponse
    {
        Gate::authorize(Category::DELETE, $categoryId);

        return $this->execute(new DeleteCategoryCommand($categoryId), Response::HTTP_NO_CONTENT);
    }

}