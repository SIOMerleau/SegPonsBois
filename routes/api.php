<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EssenceController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\AvisController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/essences', [EssenceController::class, 'index']);
Route::post('/essences', [EssenceController::class, 'store']);
Route::get('/essences/{id}', [EssenceController::class, 'show']);
Route::put('/essences/{id}', [EssenceController::class, 'update']);
Route::delete('/essences/{id}', [EssenceController::class, 'destroy']);

Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories', [CategorieController::class, 'store']);
Route::get('/categories/{id}', [CategorieController::class, 'show']);
Route::put('/categories/{id}', [CategorieController::class, 'update']);
Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);

Route::get('/avis', [AvisController::class, 'index']);
Route::post('/avis', [AvisController::class, 'store']);
Route::get('/avis/{id}', [AvisController::class, 'show']);
Route::put('/avis/{id}', [AvisController::class, 'update']);
Route::delete('/avis/{id}', [AvisController::class, 'destroy']);