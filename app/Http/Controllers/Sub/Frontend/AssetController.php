<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use ReflectionException;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Learn\Application\Commands\{CreateAssetCommand, DeleteAssetCommand, UpdateAssetCommand};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Application\Query\CardsOfAssetQuery;
use Scandinaver\Learn\Domain\Asset;

/**
 * Class LearnController
 *
 * @package App\Http\Controllers\Sub\Frontend
 * Created by PhpStorm.
 * User: whiskey
 * Date: 10.03.15
 * Time: 1:44
 */
class AssetController extends Controller
{
    /**
     * @param Language $language
     * @param Asset    $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function show(Language $language, Asset $asset): JsonResponse
    {
        $this->authorize('view', $asset);

        return response()->json($this->queryBus->execute(new CardsOfAssetQuery($language, Auth::user(), $asset)));
    }

    /**
     * @param Language $language
     * @param Request  $request
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Language $language, Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateAssetCommand($language, Auth::user(), $request->get('title')));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @param Asset   $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function update(Request $request, Asset $asset): JsonResponse
    {
        $this->authorize('update', $asset);

        $this->commandBus->execute(new UpdateAssetCommand(Auth::user(), $asset, $request->get('title')));

        return response()->json(null, 200);
    }

    /**
     * @param Asset $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function destroy(Asset $asset): JsonResponse
    {
        $this->authorize('delete', $asset);

        $this->commandBus->execute(new DeleteAssetCommand($asset));

        return response()->json(null, 204);
    }
}