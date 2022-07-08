@extends('layouts.app.delivery')
@section('content')
    <link href="{{ asset('cardapio') }}/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        #app,
        body {
            overflow: auto !important;
            position: static !important;
        }

        .md body {
            background-color: white;
            padding-bottom: 90.5px;
        }

        #carrinho header h1 {
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            margin: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #EEEEEE;
        }

        #carrinho #pedidos {
            padding: 0px 20px 20px;
        }

        #carrinho #pedidos h2 {
            font-size: 22px;
            font-weight: 600;
            margin: 0px;
        }

        #carrinho #pedidos figure {
            width: 90px;
            height: 90px;
            background-position: center;
            background-size: cover;
            border-radius: 10px;
            margin: 0px;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
        }

        #carrinho #pedido {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            border-bottom: 1px solid #EEEEEE;
        }

        #carrinho #pedidos .contain-info-pedido {
            display: flex;
        }

        #carrinho #pedidos .contain-info-pedido .info-pedido h4 {
            margin: 0px;
            font-size: 18px;
            font-weight: 600;
        }

        #carrinho #pedidos .contain-info-pedido .info-pedido p {
            font-size: 18px;
        }

        #carrinho #pedidos .contain-info-pedido .info-pedido {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #carrinho #pedidos .contain-info-pedido p {
            margin: 0px;
        }

        #carrinho #pedidos .info-pedido .quantidade-contain {
            display: flex;
        }

        #carrinho #pedidos .info-pedido {
            margin-left: 10px;
        }

        #carrinho #pedidos #pedido .fa-trash-o {
            font-size: 19px;
            font-weight: 500;
        }

        #carrinho #pedidos #pedido .quantidade-contain {
            display: flex;
            justify-content: center;
        }

        #carrinho #pedidos #pedido .quantidade-contain div {
            width: 30px;
            height: 30px;
            margin: 0px;
            font-size: 26px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        #carrinho #pedidos #pedido .quantidade-contain .menos {
            background-color: #ffa2a9;
        }

        #carrinho #pedidos #pedido .quantidade-contain .mais {
            background-color: #db4d59;
            color: white;
        }

        #carrinho #pedidos #pedido .quantidade-contain .quantidade {
            font-size: 18px;
            font-weight: bold;
            color: #db4d59;
        }

        #carrinho button {
            width: fit-content;
            border: 0px;
            background-color: #db4d59;
            padding: 10px;
            border-radius: 10px;
            margin-left: 20px;
            font-size: 14px;
            color: white;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #carrinho #valores {
            padding: 0px 20px;
            border-bottom: 1px solid #EEEEEE;
        }

        #carrinho #valores p {
            margin: 0px;
            font-size: 16px;
            margin: 10px 0px;
        }

        #carrinho #valores .subtotal,
        #carrinho #valores .delivery,
        #carrinho #valores .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #carrinho #valores .total {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #carrinho #forma-de-pagamento {
            padding: 0px 20px;
            display: flex;
            justify-content: space-between;
        }

        #carrinho #forma-de-pagamento .pagamento i {
            font-size: 22px;
        }
    </style>

    <section id="carrinho">
        <header>
            <h1>Carrinho</h1>
        </header>
        <section id="pedidos">
            <h2>Items</h2>
            <div id="pedido">
                <div class="contain-info-pedido">
                    <div class="contain-info-pedido">
                        <figure
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                        <div class="info-pedido">
                            <h4>Pad Thai</h4>
                            <p>$27.00</p>
                            <div class="quantidade-contain">
                                <div class="menos">-</div>
                                <div class="quantidade">1</div>
                                <div class="mais">+</div>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </div>
            <div id="pedido">
                <div class="contain-info-pedido">
                    <div class="contain-info-pedido">
                        <figure
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                        <div class="info-pedido">
                            <h4>Pad Thai</h4>
                            <p>$27.00</p>
                            <div class="quantidade-contain">
                                <div class="menos">-</div>
                                <div class="quantidade">1</div>
                                <div class="mais">+</div>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </div>
            <div id="pedido">
                <div class="contain-info-pedido">
                    <div class="contain-info-pedido">
                        <figure
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                        <div class="info-pedido">
                            <h4>Pad Thai</h4>
                            <p>$27.00</p>
                            <div class="quantidade-contain">
                                <div class="menos">-</div>
                                <div class="quantidade">1</div>
                                <div class="mais">+</div>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </div>
        </section>
        <button>+ Adicionar pedidos</button>

        <section id="valores">
            <div class="subtotal">
                <p>Subtotal</p>
                <p>$40.50</p>
            </div>
            <div class="delivery">
                <p>Taxa de entrega</p>
                <p>$0.00</p>
            </div>
            <div class="total">
                <p>Total</p>
                <p>$40.50</p>
            </div>
        </section>

        <section id="forma-de-pagamento">
            <p class="pagamento">
                <i class="fa fa-money" aria-hidden="true"></i>
            </p>
            <p>Mudar</p>
        </section>
    </section>

    <footer id="nav">
        <nav>
            <ul>
                <li>
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </li>
                <li class="menu-active">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Carrinho
                </li>
                <li>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Conta
                </li>
            </ul>
        </nav>
    </footer>
@endsection
