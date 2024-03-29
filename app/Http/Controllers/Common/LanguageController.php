<?php


namespace App\Http\Controllers\Common;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Common\CreateLanguageRequest;
use App\Http\Requests\Common\UpdateLanguageRequest;
use App\Http\Requests\FilteringRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use JsonMapper_Exception;
use Scandinaver\Common\Domain\Permission\Language;
use Scandinaver\Common\UI\Command\CreateLanguageCommand;
use Scandinaver\Common\UI\Command\DeleteLanguageCommand;
use Scandinaver\Common\UI\Command\UpdateLanguageCommand;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LanguageController
 *
 * @package App\Http\Controllers\Common
 */
class LanguageController extends Controller
{

    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(Language::VIEW);

        return $this->execute(new LanguagesQuery($request->getRequestParameters()));
    }

    /**
     * @param  CreateLanguageRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateLanguageRequest $request): JsonResponse
    {
        Gate::authorize(Language::CREATE);

        $data         = $request->toArray();
        $data['flag'] = $request->file('file');

        return $this->execute(new CreateLanguageCommand($data), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdateLanguageRequest  $request
     * @param  int                    $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateLanguageRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Language::UPDATE, $id);

        $data          = $request->toArray();
        $data['flag']  = $request->file('file');
        $data['image'] = $request->file('image');

        return $this->execute(new UpdateLanguageCommand($id, $data));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Language::DELETE, $id);

        return $this->execute(new DeleteLanguageCommand($id), Response::HTTP_NO_CONTENT);
    }
}