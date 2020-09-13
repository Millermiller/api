<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learn\Domain\Model\Card;
use Illuminate\Http\Request;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;

/**
 * Class CardController
 *
 * @package App\Http\Controllers\Backend
 */
class CardController extends Controller
{
    public function index()
    {

    }

    public function show()
    {

    }

    public function store()
    {

    }

    public function update(Card $card, Request $request): JsonResponse
    {
        return response()->json($this->commandBus->execute(new UpdateCardCommand($card, $request->toArray())));
    }

    public function destroy()
    {

    }
}