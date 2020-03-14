<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use ReflectionException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Text\Application\Commands\CompleteTextCommand;
use Scandinaver\Text\Application\Query\GetTextQuery;
use Scandinaver\Text\Domain\Text;

/**
 * Class TextController
 * @package App\Http\Controllers\Sub\Frontend
 */
class TextController extends Controller
{
    /**
     * @param Text $text
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function show(Text $text): JsonResponse
    {
        $this->authorize('view', $text);

        return response()->json($this->queryBus->execute(new GetTextQuery($text)));
    }

    /**
     * @param Text $text
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function complete(Text $text): JsonResponse
    {
        $this->commandBus->execute(new CompleteTextCommand(Auth::user(), $text));

        return response()->json(null, 200);
    }
}