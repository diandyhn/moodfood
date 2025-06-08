<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\RekomendasiController;

Route::get('/', function () {
    return view('layouts.app');
});


Auth::routes();

Route::prefix('mood')->group(function () {
    Route::get('/', [MoodController::class, 'index'])->name('mood.index');
    Route::post('/detect', [MoodController::class, 'detectMood'])->name('mood.detect');
    Route::get('/recommendations/{mood}', [MoodController::class, 'showRecommendations'])->name('mood.recommendations');
});

Route::resource('makanan', MakananController::class);

Route::prefix('rekomendasi')->group(function () {
    Route::get('/', [RekomendasiController::class, 'index'])->name('rekomendasi.index');
    Route::get('/mood/{mood}', [RekomendasiController::class, 'byMood'])->name('rekomendasi.mood');
    Route::get('/health', [RekomendasiController::class, 'healthy'])->name('rekomendasi.health');
    Route::get('/budget/{maxPrice}', [RekomendasiController::class, 'budget'])->name('rekomendasi.budget');
});

Route::prefix('api')->group(function () {
    Route::post('/mood/analyze', [MoodController::class, 'detectMood']);
    Route::get('/recommendations', [RekomendasiController::class, 'getRecommendations']);
});
