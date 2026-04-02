<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EssenceController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\AvisController;
use App\Http\Controllers\Api\CommandeController;
use App\Http\Controllers\Api\OffreController;
use App\Http\Controllers\Api\PanierController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\PieceController;


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

Route::get('/commandes', [CommandeController::class, 'index']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::get('/commandes/{id}', [CommandeController::class, 'show']);
Route::put('/commandes/{id}', [CommandeController::class, 'update']);
Route::delete('/commandes/{id}', [CommandeController::class, 'destroy']);

Route::get('/offres', [OffreController::class, 'index']);   
Route::post('/offres', [OffreController::class, 'store']);
Route::get('/offres/{id}', [OffreController::class, 'show']);
Route::put('/offres/{id}', [OffreController::class, 'update']);
Route::delete('/offres/{id}', [OffreController::class, 'destroy']);

Route::get('/paniers', [PanierController::class, 'index']);
Route::post('/paniers', [PanierController::class, 'store']);
Route::get('/paniers/{id}', [PanierController::class, 'show']);
Route::put('/paniers/{id}', [PanierController::class, 'update']);
Route::delete('/paniers/{id}', [PanierController::class, 'destroy']);

Route::get('/produits', [ProduitController::class, 'index']);
Route::post('/produits', [ProduitController::class, 'store']);
Route::get('/produits/{id}', [ProduitController::class, 'show']);
Route::put('/produits/{id}', [ProduitController::class, 'update']);
Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);

Route::get('/pieces', [PieceController::class, 'index']);
Route::post('/pieces', [PieceController::class, 'store']);  
Route::get('/pieces/{id}', [PieceController::class, 'show']);
Route::put('/pieces/{id}', [PieceController::class, 'update']);
Route::delete('/pieces/{id}', [PieceController::class, 'destroy']);