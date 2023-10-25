<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\producteController;

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
//Route::get('/afegir', [FormController::class, 'show'])
 Route::get('/afegir', function(){
     return view('newProduct');
 });
Route::post('/afegir',  [producteController::class, 'store'])->name('afegir-form');