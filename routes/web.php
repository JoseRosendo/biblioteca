<?php

use App\Http\Controllers\autoresController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('prueba','prueba');
Route::view('agregar','aggAutor');
Route::apiResource('apiAutor',autoresController::class);
Route::put('desactivar/estado','App\Http\Controllers\autoresController@softdelete');