<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ComandaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comandes', [ComandaController::class,'index'])->name('comandes');

Route::get('comanda/{id}', [ComandaController::class,'buscar'])->name('comanda-modif');

Route::patch('comanda/{id}', [ComandaController::class, 'update'])->name('comanda-editar-estat');

 Route::get('/afegir', function(){
     return view('newProduct');
 })->name('afegir');

Route::post('/afegir',  [ProducteController::class, 'store'])->name('afegir');

Route::get('/llistat-prod', [ProducteController::class,'indexView'])->name('llistat-prod');

Route::get('/modificar/{id}', [ProducteController::class, 'showView'])->name('producte-form');

Route::get('/editar/{id}', [ProducteController::class,'editar'])->name('producte-editar');