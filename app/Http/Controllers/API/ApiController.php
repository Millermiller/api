<?php


namespace App\Http\Controllers\API;

use Validator;
use Exception;
use ReflectionException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\API\Application\Query\{AssetsQuery, LanguagesQuery};

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 19.02.15
 * Time: 23:08
 *
 * Class ApiController
 * @package App\Http\Controllers\Main\Frontend
 *
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
     * @throws ReflectionException
     */
    public function languages(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new LanguagesQuery()));
    }

    /**
     * @param $language
     * @return JsonResponse
     * @throws Exception
     */
    public function assets($language): JsonResponse
    {
        $validator = Validator::make(
            ['language' => $language],
            [
                'language' => 'exists:Scandinaver\Common\Domain\Language,name'
            ],
            [
                'exists' => 'Неверный параметр'
            ]
        );

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        }

        return response()->json($this->queryBus->execute(new AssetsQuery(auth('api')->user(), $language)));
    }
} 