<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use App\Http\Requests\Settings\BulkSetValueRequest;
use App\Http\Requests\Settings\CreateSettingRequest;
use App\Http\Requests\Settings\SetValueRequest;
use App\Http\Requests\Settings\UpdateSettingRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use JsonMapper_Exception;
use Scandinaver\Settings\Domain\Permission\Settings;
use Scandinaver\Settings\UI\Command\BulkSetSettingCommand;
use Scandinaver\Settings\UI\Command\CreateSettingCommand;
use Scandinaver\Settings\UI\Command\DeleteSettingCommand;
use Scandinaver\Settings\UI\Command\SetSettingCommand;
use Scandinaver\Settings\UI\Command\UpdateSettingCommand;
use Scandinaver\Settings\UI\Query\SettingQuery;
use Scandinaver\Settings\UI\Query\SettingsQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SettingsController
 *
 * @package App\Http\Controllers\Settings
 */
class SettingsController extends Controller
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
        Gate::authorize(Settings::VIEW);

        $params = $request->getRequestParameters();

        return $this->execute(new SettingsQuery($params));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Settings::SHOW, $id);

        return $this->execute(new SettingQuery($id));
    }

    /**
     * @param  CreateSettingRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateSettingRequest $request): JsonResponse
    {
        Gate::authorize(Settings::CREATE);

        return $this->execute(new CreateSettingCommand($request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdateSettingRequest  $request
     * @param  int                   $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateSettingRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Settings::UPDATE, $id);

        return $this->execute(new UpdateSettingCommand($id, $request->toArray()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Settings::DELETE, $id);

        return $this->execute(new DeleteSettingCommand($id), Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  SetValueRequest  $request
     * @param  int              $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setValue(SetValueRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Settings::UPDATE, $id);

        return $this->execute(new SetSettingCommand($id, $request->get('value')));
    }

    /**
     * @param  BulkSetValueRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function bulkSetValue(BulkSetValueRequest $request): JsonResponse
    {
        Gate::authorize(Settings::CREATE);

        return $this->execute(new BulkSetSettingCommand($request->toArray()));
    }
}