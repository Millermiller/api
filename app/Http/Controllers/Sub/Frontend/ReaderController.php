<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Reader\UI\Query\ReadQuery;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ReaderController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class ReaderController extends Controller
{
    public function index(Language $language, Request $request): BinaryFileResponse
    {
        $text = $request->get('text');

        return response()->file($this->queryBus->execute(new ReadQuery(Auth::user(), $language, $text)));
    }
}