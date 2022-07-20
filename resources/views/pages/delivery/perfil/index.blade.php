@extends('layouts.app.delivery')
@section('content')
    <link href="{{ asset('cardapio') }}/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        header {
            height: 30vh;
            background-color: #300205;
            padding: 20px;
        }

        header figure {
            background-position: center;
            background-size: cover;
            border-radius: 100%;
            height: 100px;
            width: 100px;
        }

        header h2 {
            color: white;
            font-size: 20px;
        }

        header h3 {
            color: #7c7c7c;
            font-size: 14px;
        }

        section#menu-perfil {
            position: relative;
        }

        section#menu-perfil div {
            position: absolute;
            background-color: #f7f7f7;
            height: 70vh;
            width: 100%;
            border-radius: 30px 30px 0px 0px;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
            padding: 20px;
            top: -30px;
        }

        section#menu-perfil ul {
            flex-direction: column;
        }

        section#menu-perfil li {
            padding: 15px 0px;
            font-size: 18px;
        }

        section#menu-perfil li i {
            margin-right: 5px;
        }

        section#menu-perfil li.excluir {
            color: #db4d59;
        }

        #mudarEndereco input,
        #mudarEndereco select,
        #modalNomeUsuario input {
            width: 100%;
            padding: 15px 10px;
            box-shadow: 0px 0px 13px 1px #afafaf57;
            margin-bottom: 10px;
            border-radius: 10px;
            color: rgb(138, 138, 138);
        }

        #mudarEndereco button,
        #formas-pagamento button,
        #modalNomeUsuario form button,
        #modalExcluirConta .contain-excluir button {
            margin-top: 10px;
            background-color: #db4d59;
            color: white;
            padding: 15px;
            border-radius: 10px;
            border: 0px;
            box-shadow: 0px 0px 13px 1px #afafaf57;
            font-weight: bold;
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

        #modalExcluirConta .contain-excluir {
            display: flex;
            column-gap: 15px;
        }

        #modalExcluirConta .contain-excluir #excluir-conta {
            background-color: white;
            color: rgb(36, 36, 36);
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

    <div class="modal fade" id="modalNomeUsuario" tabindex="-1" aria-labelledby="modalNomeUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nome de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <input type="text" name="nomeUsuario" id="nomeUsuario" placeholder="Digite seu nome de usuario">
                        <button type="submit">Alterar nome de usuario</button>
                    </form>
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

    <div class="modal fade" id="modalExcluirConta" tabindex="-1" aria-labelledby="modalExcluirContaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tem certeza que deseja excluir a conta?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contain-excluir">
                        <button id="excluir-conta">Sim</button>
                        <button>Nao</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header>
        <figure style="background-image: url({{ asset('imgs/delivery/perfil.jpg') }})">

        </figure>

        <h2>Lucas Barbosa</h2>
        <h3>email@email.com.br</h3>
    </header>

    <section id="menu-perfil">
        <div class="container-menu-perfil">
            <ul>
                <li data-bs-toggle="modal" data-bs-target="#modalFormaPagamento"><i class="fa fa-pencil"
                        aria-hidden="true"></i> Alterar metodo de pagamento</li>
                <li data-bs-toggle="modal" data-bs-target="#modalEndereco"><i class="fa fa-pencil"
                        aria-hidden="true"></i> Alterar endereco</li>
                <li data-bs-toggle="modal" data-bs-target="#modalNomeUsuario"><i class="fa fa-pencil"
                        aria-hidden="true"></i> Alterar nome</li>
                <li data-bs-toggle="modal" data-bs-target="#modalExcluirConta" class="excluir"><i class="fa fa-trash-o"
                        aria-hidden="true"></i> Excluir conta</li>
            </ul>
        </div>
    </section>

    <footer id="nav">
        <nav>
            <ul>
                <li onclick="window.location='{{ URL::route('delivery.home') }}'">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </li>

                <li onclick="window.location='{{ URL::route('delivery.carrinho') }}'">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Carrinho
                </li>
                <li onclick="window.location='{{ URL::route('delivery.perfil') }}'" class="menu-active">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Conta
                </li>
            </ul>
        </nav>
    </footer>
@endsection
