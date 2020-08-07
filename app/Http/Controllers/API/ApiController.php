<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\API\UI\Query\AssetsQuery;
use Scandinaver\API\UI\Query\LanguagesQuery;
use Scandinaver\Common\Domain\Model\Language;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\API
 */
class ApiController extends Controller
{
    public function user(): JsonResponse
    {
        return response()->json(auth('api')->user());
    }

    public function languages(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new LanguagesQuery()));
    }

    public function assets(Language $language): JsonResponse
    {
       // $validator = Validator::make(
       //     ['language' => $language],
       //     [
       //         'language' => 'exists:Scandinaver\Common\Domain\Model\Language,name'
       //     ],
       //     [
       //         'exists' => 'Неверный параметр'
       //     ]
       // );
       //
       // if ($validator->fails()) {
       //     return response()->json([$validator->errors()], 400);
       // }

        return response()->json($this->queryBus->execute(new AssetsQuery(auth('api')->user(), $language)));
    }
} 
