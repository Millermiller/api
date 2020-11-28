<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'role:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => [],
    ],
    function () {
        Route::get(
            '/role',
            [
                'as' => 'all',
                'uses' => 'RoleController@index',
            ]
        );

        Route::get(
            '/role/{id}',
            [
                'as' => 'show',
                'uses' => 'RoleController@show',
            ]
        );

        Route::get(
            '/role/search',
            [
                'as' => 'search',
                'uses' => 'RoleController@search',
            ]
        );
    }
);

Route::group(
    [
        'as' => 'role:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => ['auth:api'],
    ],
    function () {

        Route::post(
            '/role/{roleId}/{permissionId}',
            [
                'as' => 'attachPermission',
                'uses' => 'RoleController@attachPermission',
            ]
        );

        Route::delete(
            '/role/{roleId}/{permissionId}',
            [
                'as' => 'detachPermission',
                'uses' => 'RoleController@detachPermission',
            ]
        );

        Route::delete(
            '/role/{id}',
            [
                'as' => 'delete',
                'uses' => 'RoleController@destroy',
            ]
        );

        Route::post(
            '/role',
            [
                'as' => 'create',
                'uses' => 'RoleController@store',
            ]
        );

        Route::put(
            '/role/{id}',
            [
                'as' => 'update',
                'uses' => 'RoleController@update',
            ]
        );
    }
);