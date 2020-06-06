<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Common\Domain\Language;
use Scandinaver\Translate\Application\Commands\CompleteTextCommand;
use Scandinaver\Translate\Application\Query\GetTextQuery;
use Scandinaver\Translate\Domain\Text;

/**
 * Class TextController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class TextController extends Controller
{
    /**
     * @param Language $language
     * @param Text     $text
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Language $language, Text $text): JsonResponse
    {
        $this->authorize('view', $text);

        return response()->json($this->queryBus->execute(new GetTextQuery($text)));
    }

    /**
     * @param Text $text
     *
     * @return JsonResponse
     */
    public function complete(Text $text): JsonResponse
    {
        $this->commandBus->execute(new CompleteTextCommand(Auth::user(), $text));

        return response()->json(null, 200);
    }
}