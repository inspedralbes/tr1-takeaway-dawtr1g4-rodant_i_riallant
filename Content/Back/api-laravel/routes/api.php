<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComandaController;
use App\Http\Controllers\ProducteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/productes', [ProducteController::class, 'index']);

// Route::post('/productes', [ProducteController::class, 'store']);

Route::get('/productes/{id}', [ProducteController::class, 'show']);

// Route::patch('/productes/{id}', [ProducteController::class, 'update']);

// Route::delete('/productes/{id}', [ProducteController::class, 'destroy']);

Route::get('/productes/search/{name}', [ProducteController::class, 'search']);


Route::post('/comanda', [ComandaController::class,'store']);

Route::get('/comanda/{id}', [ComandaController::class, 'show']);

Route::patch('/comanda/{id}', [ComandaController::class, 'modificar']);

Route::get('/categories', [CategoriaController::class,'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
