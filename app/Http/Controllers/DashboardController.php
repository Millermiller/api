<?php


namespace App\Http\Controllers;

use App\Http\Requests\HasLanguageRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learning\Asset\UI\Query\AssetsCountByLanguageQuery;
use Scandinaver\Learning\Asset\UI\Query\AssetsCountQuery;
use Scandinaver\Learning\Asset\UI\Query\AudioCountByLanguageQuery;
use Scandinaver\Learning\Asset\UI\Query\TextsCountByLanguageQuery;
use Scandinaver\Learning\Asset\UI\Query\TextsCountQuery;
use Scandinaver\Learning\Asset\UI\Query\TermsCountByLanguageQuery;
use Scandinaver\Learning\Asset\UI\Query\TermsCountQuery;
use Scandinaver\User\UI\Query\UsersQuery;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:26
 * Class DashboardController
 *
 * @package Application\Controllers\Admin
 */
class DashboardController extends Controller
{

    /**
     * @param  HasLanguageRequest  $request
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function all(HasLanguageRequest $request): JsonResponse
    {
        return response()->json([
                'users'    => $this->commandBus->execute(new UsersQuery()),
                'words'    => $this->commandBus->execute(new TermsCountQuery()),
                'assets'   => $this->commandBus->execute(new AssetsCountQuery($request->get('lang'))),
                'audio'    => 0,
                'texts'    => $this->commandBus->execute(new TextsCountQuery()),
                'messages' => 0,
            ]);
    }

    public function one(string $language): JsonResponse
    {
        return response()->json([
                'words'  => $this->execute(new TermsCountByLanguageQuery($language)),
                'assets' => $this->execute(new AssetsCountByLanguageQuery($language)),
                'audio'  => $this->execute(new AudioCountByLanguageQuery($language)),
                'texts'  => $this->execute(new TextsCountByLanguageQuery($language)),
            ]);
    }
}