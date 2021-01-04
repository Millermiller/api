<?php


namespace App\Http\Controllers\Blog;

use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use Scandinaver\Blog\Domain\Permissions\Category;
use Scandinaver\Shared\EventBusNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Query\{CategoryQuery, CategoriesQuery};

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
     * @throws EventBusNotFoundException
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
     * @throws EventBusNotFoundException
     */
    public function show(int $categoryId): JsonResponse
    {
        Gate::authorize(Category::SHOW, $categoryId);

        return $this->execute(new CategoryQuery($categoryId));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize(Category::CREATE);

        return $this->execute(
          new CreateCategoryCommand($request->toArray()),
          JsonResponse::HTTP_CREATED
        );
    }

    /**
     * @param  Request  $request
     * @param  int      $categoryId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function update(Request $request, int $categoryId): JsonResponse
    {
        Gate::authorize(Category::UPDATE, $categoryId);

        return $this->execute(new UpdateCategoryCommand($categoryId, $request->toArray()));
    }

    /**
     * @param  int  $categoryId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy(int $categoryId): JsonResponse
    {
        Gate::authorize(Category::DELETE, $categoryId);

        return $this->execute(
          new DeleteCategoryCommand($categoryId),
          JsonResponse::HTTP_NO_CONTENT
        );
    }

}