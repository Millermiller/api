<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\API\Application\Query\{AssetsQuery, LanguagesQuery};
use Scandinaver\Common\Domain\Language;
use Validator;
use Illuminate\Http\Request;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\API
 */
class ApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return response()->json(auth('api')->user());
    }

    /**
     * @return JsonResponse
     */
    public function languages(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new LanguagesQuery()));
    }

    /**
     * @param Language $language
     *
     * @param Request  $request
     *
     * @return JsonResponse
     */
    public function assets(Language $language): JsonResponse
    {
       // $validator = Validator::make(
       //     ['language' => $language],
       //     [
       //         'language' => 'exists:Scandinaver\Common\Domain\Language,name'
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
