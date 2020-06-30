<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Application\Commands\{CreateAssetCommand, DeleteAssetCommand, UpdateAssetCommand};
use Scandinaver\Learn\Application\Query\CardsOfAssetQuery;
use Scandinaver\Learn\Domain\Asset;

/**
 * Class AssetController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class AssetController extends Controller
{
    /**
     * @param Language $language
     * @param Asset    $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
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
     */
    public function store(Language $language, Request $request): JsonResponse
    {
        $asset = $this->commandBus->execute(new CreateAssetCommand($language, Auth::user(), $request->get('title')));

        return response()->json($asset, 201);
    }

    /**
     * @param Language $language
     * @param Asset    $asset
     *
     * @param Request  $request
     * @template
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Language $language, Asset $asset, Request $request): JsonResponse
    {
        $this->authorize('update', $asset);

        $asset = $this->commandBus->execute(new UpdateAssetCommand(Auth::user(), $asset, $request->toArray()));

        return response()->json($asset, 200);
    }

    /**
     * @param Language $language
     * @param Asset    $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Language $language, Asset $asset): JsonResponse
    {
        $this->authorize('delete', $asset);

        $this->commandBus->execute(new DeleteAssetCommand($asset));

        return response()->json(NULL, 204);
    }
}