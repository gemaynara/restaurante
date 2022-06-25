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

Route::group(['prefix' => 'app'], function () {
    Route::get('{slug}/login', [\App\Http\Controllers\App\LoginController::class, 'login'])->name('app.login');
    Route::post('post-login', [\App\Http\Controllers\App\LoginController::class, 'postLogin'])->name('app.post-login');
    Route::get('{slug}/register', [\App\Http\Controllers\App\LoginController::class, 'register'])->name('app.register');
    Route::post('post-register', [\App\Http\Controllers\App\LoginController::class, 'postRegistration'])->name('app.post-register');
    Route::get('{slug}/pages', [\App\Http\Controllers\App\AppController::class, 'menu'])->name('app.pages');
    Route::get('{slug}/principal', [\App\Http\Controllers\App\AppController::class, 'index'])->name('app.home');
    Route::get('{slug}/ver-pedido', [\App\Http\Controllers\App\AppController::class, 'verPedido'])->name('app.ver-pedido');
    Route::get('/produto/{id}', [\App\Http\Controllers\App\AppController::class, 'verProduto'])->name('detalhe.produto');
    Route::post('/add-produto-carrinho', [\App\Http\Controllers\App\AppController::class, 'addProduto'])->name('add.produto');
    Route::post('/remove-item/{id}', [\App\Http\Controllers\App\AppController::class, 'removeItem'])->name('remove.item');
    Route::post('/checkout', [\App\Http\Controllers\App\AppController::class, 'checkoutStep1'])->name('app.checkout');
    Route::post('/checkout/step2', [\App\Http\Controllers\App\AppController::class, 'checkoutStep2'])->name('app.checkout-step2');
});


Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('auth.post-login');

});
Route::group(['middleware' => ['auth']], function () {
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'viewProfile'])->name('profile');
    Route::post('/update-profile',[App\Http\Controllers\UserController::class, 'changePassword'])->name('profile.update');
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::put('users/ativar/{id}', [\App\Http\Controllers\UserController::class, 'ativar'])->name('users.ativar');
    Route::put('users/desativar/{id}', [\App\Http\Controllers\UserController::class, 'desativar'])->name('users.desativar');
    Route::resource('empresas', \App\Http\Controllers\EmpresaController::class);
    Route::resource('parametros', \App\Http\Controllers\ParametrosEmpresaController::class);
    Route::put('empresas/ativar/{id}', [\App\Http\Controllers\EmpresaController::class, 'ativar'])->name('empresas.ativar');
    Route::put('empresas/desativar/{id}', [\App\Http\Controllers\EmpresaController::class, 'desativar'])->name('empresas.desativar');


    Route::group(['prefix' => 'cadastros'], function () {
        Route::resource('fornecedores', \App\Http\Controllers\FornecedorController::class);
        Route::resource('setores', \App\Http\Controllers\SetorController::class);
        Route::resource('mesas', \App\Http\Controllers\MesaController::class);
        Route::resource('usuarios', \App\Http\Controllers\UsuarioController::class);
    });

    Route::group(['prefix' => 'cardapio'], function () {
        Route::resource('cardapios', \App\Http\Controllers\CardapioController::class);
        Route::get('ver-cardapio/{id}', [\App\Http\Controllers\CardapioController::class, 'verCardapio'])->name('ver-cardapio');
        Route::put('cardapios/ativar/{id}', [\App\Http\Controllers\CardapioController::class, 'ativar'])->name('cardapios.ativar');
        Route::put('cardapios/desativar/{id}', [\App\Http\Controllers\CardapioController::class, 'desativar'])->name('cardapios.desativar');
        Route::resource('categorias-cardapio', \App\Http\Controllers\CategoriaCardapioController::class);

        Route::resource('sub-categorias-cardapio', \App\Http\Controllers\SubCategoriaCardapioController::class);
        Route::get('sub-categorias-cardapio/listaSubCategoriasCardapio/{categoria}',
            [\App\Http\Controllers\SubCategoriaCardapioController::class, 'listaSubCategoriasCardapio']);


        Route::get('sub-categorias-cardapio/{subcategoria}/adicionais', [\App\Http\Controllers\AdicionalCardapioController::class, 'index'])->name('adicionais');
        Route::post('/adicionais/store', [\App\Http\Controllers\AdicionalCardapioController::class, 'store'])->name('adicionais.store');
        Route::get('/adicionais/edit/{subcategoria}/{id}', [\App\Http\Controllers\AdicionalCardapioController::class, 'edit'])->name('adicionais.edit');
        Route::delete('/adicionais/delete/{id}', [\App\Http\Controllers\AdicionalCardapioController::class, 'destroy'])->name('adicionais.destroy');

        Route::get('relatorio-vendas', [\App\Http\Controllers\CardapioController::class, 'getRelatorioCardapio'])->name('cardapio.rel-vendas');
        Route::post('cardapios/vendas', [\App\Http\Controllers\CardapioController::class, 'cardapioVendasPdf'])->name('cardapio.vendas-pdf');

    });


    Route::group(['prefix' => 'estoque'], function () {
        Route::resource('categorias-produto', \App\Http\Controllers\CategoriaProdutoController::class);
        Route::resource('produtos', \App\Http\Controllers\ProdutoController::class);
        Route::resource('notas-fiscais', \App\Http\Controllers\NotaFiscalController::class);
        Route::resource('saidas', \App\Http\Controllers\SaidaController::class);

    });

    Route::group(['prefix' => 'pedidos'], function () {
        Route::get('imprimir-comanda/{id}', [App\Http\Controllers\PedidoController::class, 'imprimirComanda'])->name('pedidos.comanda');
        Route::get('imprimir-cupom/{id}', [App\Http\Controllers\PedidoController::class, 'imprimirCupom'])->name('pedidos.cupom');
        Route::get('lista-mesas', [App\Http\Controllers\PedidoController::class, 'listaMesas'])->name('pedidos.mesas');
        Route::get('todos-pedidos', [App\Http\Controllers\PedidoController::class, 'pedidos'])->name('pedidos.lista');
        Route::get('recebidos', [App\Http\Controllers\PedidoController::class, 'pedidosRecebidos'])->name('pedidos.recebidos');
        Route::get('encerrados', [App\Http\Controllers\PedidoController::class, 'pedidosFinalizados'])->name('pedidos.encerrados');
        Route::get('pdv', [App\Http\Controllers\PedidoController::class, 'pagamentoPedidos'])->name('pedidos.pdv');
        Route::get('show/{id}', [App\Http\Controllers\PedidoController::class, 'verPedido'])->name('pedidos.show');
        Route::post('abrir-comanda', [App\Http\Controllers\PedidoController::class, 'abrirComanda'])->name('pedidos.abrir-comanda');
        Route::post('add-item', [App\Http\Controllers\PedidoController::class, 'addItem'])->name('pedidos.add-item');
        Route::post('edit-item', [App\Http\Controllers\PedidoController::class, 'editItem'])->name('pedidos.edit-item');
        Route::delete('remove-item/{id}', [App\Http\Controllers\PedidoController::class, 'removeItem'])->name('pedidos.remove-item');
        Route::post('enviar-pedido', [App\Http\Controllers\PedidoController::class, 'enviarPedido'])->name('pedidos.enviar-pedido');
        Route::post('cancelar-comanda', [App\Http\Controllers\PedidoController::class, 'cancelarComanda'])->name('pedidos.cancelar-comanda');
        Route::post('encerrar-pedido', [App\Http\Controllers\PedidoController::class, 'encerrarPedido'])->name('pedidos.encerrar-pedido');
    });

    Route::group(['prefix' => 'producao'], function () {
        Route::get('em-producao/{id}', [App\Http\Controllers\ProducaoController::class, 'producao'])->name('producao.pedidos');
        Route::post('confirmar/{id}/{novoStatus}', [App\Http\Controllers\ProducaoController::class, 'confirmarPedido'])->name('producao.confirmar');
    });

    Route::group(['prefix' => 'caixa'], function () {
        Route::get('controle-caixa', [App\Http\Controllers\ControleCaixaController::class, 'index'])->name('caixa.index');
        Route::post('abrir-caixa', [App\Http\Controllers\ControleCaixaController::class, 'abrirCaixa'])->name('caixa.abrir-caixa');
        Route::post('fechar-caixa', [App\Http\Controllers\ControleCaixaController::class, 'fecharCaixa'])->name('caixa.fechar-caixa');
        Route::get('resumo-caixa', [App\Http\Controllers\ControleCaixaController::class, 'getResumoCaixa'])->name('caixa.rel-resumo');
        Route::post('pdf-resumo-caixa', [App\Http\Controllers\ControleCaixaController::class, 'resumoCaixaPdf'])->name('caixa.pdf-resumo');
    });

    Route::group(['prefix' => 'movimentacao'], function () {
       Route::get('pagar-pedido/{id}', [App\Http\Controllers\MovimentacaoController::class, 'pagarPedido'])->name('movimentacao.pagar-pedido');
       Route::post('pagamento-pedido', [App\Http\Controllers\MovimentacaoController::class, 'pagamentoPedido'])->name('movimentacao.pagamento-pedido');
       Route::post('retirada-caixa', [App\Http\Controllers\MovimentacaoController::class, 'saidaCaixa'])->name('movimentacao.saida-caixa');
       Route::get('retiradas-caixa', [App\Http\Controllers\MovimentacaoController::class, 'retiradasCaixa'])->name('movimentacao.retirada-caixa');
    });

});

