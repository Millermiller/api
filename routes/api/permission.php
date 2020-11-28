<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'permission:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => [],
    ],
    function () {
        Route::get(
            '/permission',
            [
                'as' => 'all',
                'uses' => 'PermissionController@index',
            ]
        );

        Route::get(
            '/permission/{id}',
            [
                'as' => 'show',
                'uses' => 'PermissionController@show',
            ]
        );

        Route::get(
            '/permission/search',
            [
                'as' => 'search',
                'uses' => 'PermissionController@search',
            ]
        );
    }
);

Route::group(
    [
        'as' => 'permission:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => ['auth:api'],
    ],
    function () {

        Route::delete(
            '/permission/{id}',
            [
                'as' => 'delete',
                'uses' => 'PermissionController@destroy',
            ]
        );

        Route::post(
            '/permission',
            [
                'as' => 'create',
                'uses' => 'PermissionController@store',
            ]
        );

        Route::put(
            '/permission/{id}',
            [
                'as' => 'update',
                'uses' => 'PermissionController@update',
            ]
        );
    }
);