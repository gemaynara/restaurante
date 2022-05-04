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
    Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('auth.post-login');

});
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('usuarios', \App\Http\Controllers\UsuarioController::class);
    Route::put('users/ativar/{id}', [\App\Http\Controllers\EmpresaController::class, 'ativar'])->name('users.ativar');
    Route::put('users/desativar/{id}', [\App\Http\Controllers\EmpresaController::class, 'desativar'])->name('users.desativar');

    Route::resource('empresas', \App\Http\Controllers\EmpresaController::class);
    Route::resource('parametros', \App\Http\Controllers\ParametrosEmpresaController::class);
    Route::put('empresas/ativar/{id}', [\App\Http\Controllers\EmpresaController::class, 'ativar'])->name('empresas.ativar');
    Route::put('empresas/desativar/{id}', [\App\Http\Controllers\EmpresaController::class, 'desativar'])->name('empresas.desativar');

    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('setores', \App\Http\Controllers\SetorController::class);
    Route::resource('cardapios', \App\Http\Controllers\CardapioController::class);
    Route::put('cardapios/ativar/{id}', [\App\Http\Controllers\CardapioController::class, 'ativar'])->name('cardapios.ativar');
    Route::put('cardapios/desativar/{id}', [\App\Http\Controllers\CardapioController::class, 'desativar'])->name('cardapios.desativar');
    Route::resource('categorias-cardapio', \App\Http\Controllers\CategoriaCardapioController::class);

    Route::resource('sub-categorias-cardapio', \App\Http\Controllers\SubCategoriaCardapioController::class);
    Route::get('sub-categorias-cardapio/listaSubCategoriasCardapio/{categoria}',
        [\App\Http\Controllers\SubCategoriaCardapioController::class, 'listaSubCategoriasCardapio']);

    Route::resource('categorias-produto', \App\Http\Controllers\CategoriaProdutoController::class);
    Route::resource('produtos', \App\Http\Controllers\ProdutoController::class);
    Route::resource('fornecedores', \App\Http\Controllers\FornecedorController::class);
    Route::resource('notas-fiscais', \App\Http\Controllers\NotaFiscalController::class);
    Route::resource('saidas', \App\Http\Controllers\SaidaController::class);

    Route::get('sub-categorias-cardapio/{subcategoria}/adicionais', [\App\Http\Controllers\AdicionalCardapioController::class, 'index'])->name('adicionais');
    Route::post('/adicionais/store', [\App\Http\Controllers\AdicionalCardapioController::class, 'store'])->name('adicionais.store');
    Route::get('/adicionais/edit/{subcategoria}/{id}', [\App\Http\Controllers\AdicionalCardapioController::class, 'edit'])->name('adicionais.edit');
    Route::delete('/adicionais/delete/{id}', [\App\Http\Controllers\AdicionalCardapioController::class, 'destroy'])->name('adicionais.destroy');
});

