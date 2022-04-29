<?php

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


Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('auth.post-login');

});
Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categorias-cardapio', \App\Http\Controllers\CategoriaCardapioController::class);
    Route::resource('sub-categorias-cardapio', \App\Http\Controllers\SubCategoriaCardapioController::class);
    Route::resource('setores', \App\Http\Controllers\SetorController::class);
});

