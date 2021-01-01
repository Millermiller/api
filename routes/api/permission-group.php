<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'permission:group:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => [],
    ],
    function () {
        Route::get(
            '/permission-group',
            [
                'as' => 'all',
                'uses' => 'PermissionGroupController@index',
            ]
        );

        Route::get(
            '/permission-group/{id}',
            [
                'as' => 'show',
                'uses' => 'PermissionGroupController@show',
            ]
        );

        Route::get(
            '/permission-group/search',
            [
                'as' => 'search',
                'uses' => 'PermissionGroupController@search',
            ]
        );
    }
);

Route::group(
    [
        'as' => 'permission:group:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => ['auth:api'],
    ],
    function () {

        Route::delete(
            '/permission-group/{id}',
            [
                'as' => 'delete',
                'uses' => 'PermissionGroupController@destroy',
            ]
        );

        Route::post(
            '/permission-group',
            [
                'as' => 'create',
                'uses' => 'PermissionGroupController@store',
            ]
        );

        Route::put(
            '/permission-group/{id}',
            [
                'as' => 'update',
                'uses' => 'PermissionGroupController@update',
            ]
        );
    }
);