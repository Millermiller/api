<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\Translate\UI\Command\CompleteTextCommand;
use Scandinaver\Translate\UI\Query\GetTextQuery;

/**
 * Class TextController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class TextController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function show(Language $language, Text $text): JsonResponse
    {
        $this->authorize('view', $text);

        return response()->json($this->queryBus->execute(new GetTextQuery($text)));
    }

    public function complete(Text $text): JsonResponse
    {
        $this->commandBus->execute(new CompleteTextCommand(Auth::user(), $text));

        return response()->json(null, 200);
    }
}