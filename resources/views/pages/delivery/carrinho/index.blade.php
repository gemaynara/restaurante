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

        #carrinho {
            display: flex;
            flex-direction: column;
            justify-content: center;
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

        #carrinho #forma-de-pagamento,
        #carrinho #endereco {
            padding: 0px 20px;
            display: flex;
            justify-content: space-between;
        }

        #carrinho #forma-de-pagamento .mudar,
        #carrinho #endereco .mudar {
            color: #db4d59;
        }

        .modal-title {
            font-weight: bold;
        }

        #carrinho #forma-de-pagamento .pagamento i,
        #carrinho #endereco .info-endereco i {
            font-size: 22px;
            margin-right: 10px;
        }

        #carrinho #endereco .info-endereco i {
            margin-right: 20px;
        }

        #carrinho #forma-de-pagamento .pagamento,
        #carrinho #endereco .info-endereco {
            display: flex;
            align-items: center;
            overflow: hidden;
            width: 80%;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        #carrinho #forma-de-pagamento p,
        #carrinho #endereco p {
            margin: 0px;
            margin-top: 20px;
        }

        #formas-pagamento .forma-pagamento {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0px;
            font-size: 18px;
        }

        #formas-pagamento .forma-pagamento input {
            transform: scale(1.2);
        }

        #mudarEndereco input,
        #mudarEndereco select {
            width: 100%;
            padding: 15px 10px;
            box-shadow: 0px 0px 13px 1px #afafaf57;
            margin-bottom: 10px;
            border-radius: 10px;
            color: rgb(138, 138, 138);
        }

        #mudarEndereco button,
        #formas-pagamento button,
        #carrinho button.submit-button {
            margin-top: 10px;
            background-color: #db4d59;
            color: white;
            padding: 15px;
            border-radius: 10px;
            border: 0px;
            box-shadow: 0px 0px 13px 1px #afafaf57;
            font-weight: bold;
        }

        #carrinho button.submit-button {
            width: 90%;
            margin: 20px auto;
            box-shadow: 0px 0px 13px 1px #afafaf57;
        }
    </style>

    <div class="modal fade" id="modalFormaPagamento" tabindex="-1" aria-labelledby="modalFormaPagamentoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Forma de pagamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section id="formas-pagamento">
                        <div class="forma-pagamento" action="">
                            <label for="formaPagamento1"><i class="fa fa-money" aria-hidden="true"></i> Dinheiro</label>
                            <input type="radio" name="formaPagamento" id="formaPagamento1">
                        </div>
                        <div class="forma-pagamento" action="">
                            <label for="formaPagamento2"><i class="fa fa-credit-card" aria-hidden="true"></i> Cartão de
                                débito</label>
                            <input type="radio" name="formaPagamento" id="formaPagamento2">
                        </div>
                        <div class="forma-pagamento" action="">
                            <label for="formaPagamento3"><i class="fa fa-credit-card" aria-hidden="true"></i> Cartão de
                                crédito</label>
                            <input type="radio" name="formaPagamento" id="formaPagamento3">
                        </div>

                        <button type="submit">Alterar forma de pagamento</button>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEndereco" tabindex="-1" aria-labelledby="modalEnderecoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Endereço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="mudarEndereco" action="">
                        <input type="text" name="cep" id="cep" placeholder="Digite seu CEP">
                        <input type="text" name="adress" id="adress" placeholder="Digite seu endereço">
                        <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento">
                        <input type="text" name="bairro" id="bairro" placeholder="Digite seu bairro">
                        <select id="estado" name="estado">
                            <option value="AC" disabled selected>Escolha seu estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="EX">Estrangeiro</option>
                        </select>
                        <button type="submit">Alterar endereço</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="carrinho">
        <header>
            <h1>Carrinho</h1>
        </header>
        <section id="pedidos">
            <h2>Pedidos</h2>
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
                Dinheiro
            </p>
            <p class="mudar" data-bs-toggle="modal" data-bs-target="#modalFormaPagamento">Mudar</p>
        </section>

        <section id="endereco">
            <p class="info-endereco">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                Rua Manoel Neves dos Santos 141 bloco D-12 apto
            </p>
            <p class="mudar" data-bs-toggle="modal" data-bs-target="#modalEndereco">Mudar</p>
        </section>

        <button class="submit-button" type="submit">Fazer pedido</button>
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
