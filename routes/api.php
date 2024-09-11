<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('test', function (Request $request) {
        return response()->json([
            'message' => 'Teste de API'
        ]);
    });
});
