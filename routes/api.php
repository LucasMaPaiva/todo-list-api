<?php

use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\API\V1\TaskSituationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('test', function (Request $request) {
        return response()->json([
            'message' => 'Teste de API'
        ]);
    });

    Route::group(['prefix' => 'task'], function () {
        Route::post('store', [TaskController::class, 'create']);
    });

    Route::group(['prefix' => 'task-situation'], function () {
        Route::post('store', [TaskSituationController::class, 'create']);
    });

});
