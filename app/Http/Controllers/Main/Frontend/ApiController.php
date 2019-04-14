<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ApiService;

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

    public function assets($language)
    {
        $assets = $this->apiService->getAssets($language);

        return response()->json($assets);
    }
} 