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


    Route::get('/login',[\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/post-login',[\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('auth.post-login');
//    Route::get('/register','LoginController@show_signup_form')->name('register');
//    Route::post('/register','LoginController@process_signup');
    Route::post('/logout',[\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
