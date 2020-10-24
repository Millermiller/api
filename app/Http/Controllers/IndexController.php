<?php


namespace App\Http\Controllers;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Main\Frontend
 */
class IndexController extends Controller
{

    public function index()
    {
        echo 'v. '. json_decode(file_get_contents(base_path('/composer.json')))->version;
    }
}