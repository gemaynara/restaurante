<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cardapio;
use App\Models\CategoriaCardapio;
use App\Models\Empresa;
use App\Models\EmpresaParametros;
use App\Models\Endereco;
use App\Models\Pedido;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function menu($slug)
    {
        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('slug', $slug)
            ->first();

        return view('pages.app.pages', compact('restaurante'));
    }


    public function index($slug)
    {
        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('slug', $slug)
            ->first();

        $categorias = CategoriaCardapio::where('empresa_id', $restaurante->empresa->id)->get();

        $cardapio = Cardapio::with('categoriasCardapio')
            ->where('empresa_id', $restaurante->empresa->id);

        $produtos = $cardapio->get();
        $populares = $cardapio->where('contador_pedidos', '>', 0)->take(5)->get();

        return view('pages.app.principal', compact('restaurante', 'categorias', 'populares', 'produtos'));

    }

    public function verProduto($id)
    {

        $produto = Cardapio::with('categoriasCardapio')
            ->where('id', $id)
            ->first();

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('empresa_id', $produto->empresa_id)
            ->first();

        return view('pages.app.detalhe-produto', compact('produto', 'restaurante'));
    }

    public function verPedido($slug)
    {

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('slug', $slug)
            ->first();

        $pedido = session()->get('carrinho');

        return view('pages.app.pedido.ver-pedido', compact('pedido', 'restaurante'));
    }

    public function addProduto(Request $request)
    {
        $produto = Cardapio::with('categoriasCardapio')
            ->where('id', $request->id_produto)
            ->first();

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('empresa_id', $produto->empresa_id)
            ->first();

        $data = [
            'id_produto' => $produto->id,
            'produto' => $produto,
            'quantidade' => $request->quantidade,
            'empresa' => $produto->empresa_id,
            'valor' => $produto->valor
        ];

        if (auth()->guest()) {
            session()->push('carrinho', $data);
        } else {
            Pedido::editPedido($data, 'delivery', auth()->user(), $restaurante);
        }

        return redirect()->route('app.ver-pedido', $restaurante->slug)
            ->with('restaurante', $restaurante);
    }

    public function checkoutStep1(Request $request)
    {
        $user = auth()->user();

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('empresa_id', $request->restaurante_id)
            ->first();

        if (auth()->guest()) {
            return redirect()->route('app.login', $restaurante->slug)
                ->with('restaurante', $restaurante);

        } elseif ($user->type == 'client') {
            $data = session()->get('carrinho');
            Pedido::createPedido($data, 'delivery', $user, $restaurante);

            $enderecos = Endereco::query()->where('user_id', $user->id)->get();
            return view('pages.app.checkout.step1', compact('restaurante', 'enderecos'));

        } else {
            return redirect()->route('app.login', $restaurante->slug)
                ->with('restaurante', $restaurante);
        }


    }

    public function checkoutStep2(Request $request)
    {
        $user = auth()->user();

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('empresa_id', $request->restaurante_id)
            ->first();

        if (isset($request->endereco_id)) {
            $endereco = Endereco::find($request->endereco_id);
        } else {
            $endereco = Endereco::firstOrCreate(
                ['user_id' => $user->id,
                    'tipo' => $request->tipo, 'cep' => $request->cep],
                ['user_id' => $user->id,
                    'tipo' => $request->tipo,
                    'endereco' => $request->endereco,
                    'complemento' => $request->complemento,
                    'bairro' => $request->bairro,
                    'cep' => $request->cep,
//            'cidade',
//            'estado',
                ]);
        }


        $pedido = Pedido::with('detalhes', 'endereco')
            ->where('user_id', $user->id)->first();

        $pedido->update(['endereco_id' => $endereco->id]);

        return view('pages.app.checkout.step2', compact('pedido', 'restaurante', 'endereco'));
    }
}
