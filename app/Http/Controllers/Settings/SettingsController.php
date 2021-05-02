<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Settings\Domain\Permissions\Settings;
use Scandinaver\Settings\UI\Command\BulkSetSettingCommand;
use Scandinaver\Settings\UI\Command\CreateSettingCommand;
use Scandinaver\Settings\UI\Command\DeleteSettingCommand;
use Scandinaver\Settings\UI\Command\SetSettingCommand;
use Scandinaver\Settings\UI\Command\UpdateSettingCommand;
use Scandinaver\Settings\UI\Query\SettingQuery;
use Scandinaver\Settings\UI\Query\SettingsQuery;

/**
 * Class SettingsController
 *
 * @package App\Http\Controllers\Settings
 */
class SettingsController extends Controller
{
    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Settings::VIEW);

        return $this->execute(new SettingsQuery());
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
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize(Settings::CREATE);

        return $this->execute(new CreateSettingCommand($request->toArray()), JsonResponse::HTTP_CREATED);
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

        return $this->execute(new DeleteSettingCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize(Settings::UPDATE, $id);

        return $this->execute(new UpdateSettingCommand($id, $request->toArray()));
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setValue(Request $request, int $id): JsonResponse
    {
        Gate::authorize(Settings::UPDATE, $id);

        return $this->execute(new SetSettingCommand($id, $request->get('value')));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function bulkSetValue(Request $request): JsonResponse
    {
        Gate::authorize(Settings::CREATE);

        return $this->execute(new BulkSetSettingCommand($request->toArray()));
    }
}