<?php

use Illuminate\Support\Facades\Route;
use Modules\Website\User\Http\Controllers\AuthController;
use Modules\Website\User\Http\Controllers\PictureController;

Route::group([
    'prefix' => 'website/user',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group([
        'middleware' => 'auth:client'
    ], function () {
        Route::apiResource('albums', AlbumController::class);
        Route::get('drop-down/album/{id}', 'AlbumController@getDropDownData');
        Route::post('move/album/{source}/{destination}', 'AlbumController@move');
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('pictures', [PictureController::class, 'store']);
    });
});
