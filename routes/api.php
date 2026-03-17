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
Route::get('/visiteurs', [VisiteurController::class, 'index']);
Route::post('/visiteurs', [VisiteurController::class, 'store']);
Route::get('/visiteurs/{id}', [VisiteurController::class, 'show']);
Route::put('/visiteurs/{id}', [VisiteurController::class, 'update']);
Route::delete('/visiteurs/{id}', [VisiteurController::class, 'destroy']);
Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories', [CategorieController::class, 'store']);
Route::get('/categories/{id}', [CategorieController::class, 'show']);   
Route::put('/categories/{id}', [CategorieController::class, 'update']);
Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);
Route::get('/produits', [ProduitController::class, 'index']);
Route::post('/produits', [ProduitController::class, 'store']); 
Route::get('/produits/{id}', [ProduitController::class, 'show']);
Route::put('/produits/{id}', [ProduitController::class, 'update']);
Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);