<?php

namespace App\Http\Controllers\Sub\Frontend;

use Auth;
use Scandinaver\Text\Domain\{TextService, Text};
use App\Http\Controllers\Controller;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NoResultException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

/**
 * Class TextController
 * @package App\Http\Controllers\Sub\Frontend
 */
class TextController extends Controller
{

    /**
     * @var TextService
     */
    private $textService;

    /**
     * TextController constructor.
     * @param TextService $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param Text $text
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws DBALException
     */
    public function show(Text $text)
    {
        $this->authorize('view', $text);

        $text = $this->textService->prepareText($text);

        return response()->json($text);
    }

    /**
     * @param Text $text
     * @return JsonResponse
     */
    public function complete(Text $text)
    {
        try{
            $text = $this->textService->giveNextLevel(Auth::user(), $text);
        }catch(NoResultException $e){
            //
        }

        return response()->json($text);
    }
}