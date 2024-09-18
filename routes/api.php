<?php

use App\Http\Controllers\API\V1\TagController;
use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\API\V1\TaskSituationController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('test', function (Request $request) {
        return response()->json([
            'message' => 'Teste de API'
        ]);
    });

    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'task'], function () {
        Route::post('', [TaskController::class, 'store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::put('', [TaskController::class, 'update']);
            Route::delete('', [TaskController::class, 'destroy']);
        });
    });

    Route::group(['prefix' => 'task-situation'], function () {
        Route::post('store', [TaskSituationController::class, 'store']);
    });

    Route::group(['prefix' => 'tag'], function () {
        Route::post('',[TagController::class, 'store']);
    });

});
