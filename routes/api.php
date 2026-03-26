<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EssenceController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController ;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/essences', [EssenceController::class, 'index']);
Route::post('/essences', [EssenceController::class, 'store']);
Route::get('/essences/{id}', [EssenceController::class, 'show']);
Route::put('/essences/{id}', [EssenceController::class, 'update']);
Route::delete('/essences/{id}', [EssenceController::class, 'destroy']);