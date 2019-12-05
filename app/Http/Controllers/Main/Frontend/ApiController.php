<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Validator;

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
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function languages()
    {
        $languages = $this->apiService->getLanguagesList();

        return response()->json($languages);
    }

    /**
     * @param $language
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assets($language)
    {
        $validator = Validator::make(['language' => $language], [
            'language' => 'exists:App\Entities\Language,name'
        ], [
            'exist' => 'Неверный параметр'
        ]);

        if($validator->fails()){
            return response()->json([$validator->errors()], 400);
        }

        $assets = $this->apiService->getAssets($language);

        return response()->json($assets);
    }
} 