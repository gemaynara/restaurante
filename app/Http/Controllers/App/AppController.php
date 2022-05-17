<?php

namespace App\Http\Controllers\App;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Services\PedidoService;
use App\Models\AdicionalCardapio;
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

        $adicionais = AdicionalCardapio::where('subcategoria_cardapio_id', $produto->subcategoria_cardapio_id)
            ->get();

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('empresa_id', $produto->empresa_id)
            ->first();

        return view('pages.app.detalhe-produto', compact('produto', 'restaurante', 'adicionais'));
    }

    public function removeItem($id)
    {

        dd($id);

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('empresa_id', $produto->empresa_id)
            ->first();

        return view('pages.app.detalhe-produto', compact('produto', 'restaurante', 'adicionais'));
    }

    public function verPedido(Request $request, $slug)
    {

        $restaurante = EmpresaParametros::query()->with('empresa')
            ->where('slug', $slug)
            ->first();

        $pedido = PedidoService::getPedidoUsuario(auth()->user());

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

        $produto = [
            'id_produto' => $produto->id,
            'produto' => $produto,
            'quantidade' => $request->quantidade,
            'empresa' => $produto->empresa_id,
            'valor' => $produto->valor,
            'observacoes' => $request->observacoes,
            'adicionais' => $request->adicionais
        ];

        if (auth()->guest() || auth()->user()->type != 'client') {
            return redirect()->route('app.login', $restaurante->slug)
                ->with('restaurante', $restaurante);
//            $request->session()->push('carrinho', $data);
        }
        if (auth()->user()->type == 'client') {
            $user = auth()->user();
            $ped = PedidoService::createOrUpdatePedido($produto, 'delivery', $user, $restaurante);
            $pedido = $ped->id;
//            $request->session()->forget('carrinho');
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
//            $data = $request->session()->get('carrinho');
//            Pedido::createPedido($data, 'delivery', $user, $restaurante);
//            $request->session()->forget('carrinho');
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
                    'cep' => $request->cep
                ]);
        }


        $pedido = Pedido::with('detalhes', 'endereco')
            ->where('usuario_id', $user->id)
            ->orderBy('id', 'desc')
            ->first();

        Pedido::where('usuario_id', $user->id)
            ->where('status_pedido', 'Pedido Efetuado')->update(['endereco_id' => $endereco->id]);

        return view('pages.app.checkout.step2', compact('pedido', 'restaurante', 'endereco'));
    }
}
