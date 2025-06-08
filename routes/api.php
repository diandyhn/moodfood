<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoodApiController;
use App\Http\Controllers\Api\FoodApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/moods', [MoodApiController::class, 'index']);
    Route::post('/mood/detect', [MoodApiController::class, 'detect']);
    Route::get('/recommendations/{mood}', [MoodApiController::class, 'recommendations']);

    Route::apiResource('foods', FoodApiController::class);
});
