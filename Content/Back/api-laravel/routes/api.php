<?php

use App\Http\Controllers\producteController;
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

Route::get('/productes', [producteController::class, 'index']);

Route::post('/productes', [producteController::class, 'store']);

Route::get('/productes/{id}', [producteController::class, 'show']);

Route::patch('/productes/{id}', [producteController::class, 'update']);

Route::delete('/productes/{id}', [producteController::class, 'destroy']);

Route::get('/productes/search/{name}', [producteController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
