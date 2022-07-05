@extends('layouts.app.delivery')
@section('content')
    <link href="{{ asset('cardapio') }}/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        header#banner {
            padding-bottom: 40px;
            width: 100%;
            background-color: #db4d59;
        }

        section#menu {
            position: relative;
        }

        section#menu .menu-contain {
            position: absolute;
            background-color: white;
            width: 100%;
            padding: 20px;
            top: -30px;
            border-radius: 30px 30px 0px 0px;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
        }

        section#menu .menu-contain header h1 {
            font-size: 18px;
            font-weight: 600;
            margin: 0px;
        }

        section#menu .menu-contain header i {
            font-size: 20px;
        }

        section#menu .menu-contain header {
            display: flex;
            width: 100%;
            justify-content: space-between;
            padding-bottom: 10px;
            border-bottom: 1px solid #EEEEEE;
        }

        section#menu ul {
            overflow-y: auto;
            gap: 20px;
        }

        section#menu li {
            width: fit-content;
            margin-right: 20px;
            height: 21px;
            margin-bottom: 20px;
            white-space: pre;
        }

        ul {
            display: flex;
            list-style-type: none;
            justify-content: space-between;
            padding: 0;
            margin-top: 10px;
        }

        footer {
            position: absolute;
            bottom: 0px;
            background: white;
            width: 100%;
        }

        footer nav {
            padding: 20px;
        }

        footer nav ul {
            margin: 0px;
        }

        footer nav ul li {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 11px;
            width: 15%;
        }

        footer nav ul li .fa {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .menu-active {
            color: #db4d59;
        }

        #lista-produtos .desc-produto h3 {
            font-size: 16px;
            font-weight: 600;
        }

        #lista-produtos .desc-produto h4 {
            font-size: 16px;
            font-weight: 300;
        }

        #lista-produtos .produto {
            display: flex;
        }

        #lista-produtos .desc-produto {
            width: 75%;
        }

        #lista-produtos .desc-produto p {
            color: #767676;
        }

        #lista-produtos .desc-produto {
            width: 75%;
        }

        #lista-produtos .produto {
            margin-bottom: 30px;
            border-bottom: 1px solid #EEEEEE;
        }

        #lista-produtos .produto #food-image {
            width: 50%;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
            border-radius: 15px;
            background-position: center;
            background-size: cover;
        }

        #lista-produtos .contain-produtos {
            overflow: auto;
            height: calc(70vh - 50px - 90px - 41px - 33px - 20px);
        }

        #banner {
            position: relative;
            background-position: center;
            background-size: cover;
        }

        #banner i.fa-info-circle {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: white;
        }

        #banner figure {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 20px;
            margin: 0px
        }

        #banner img {
            width: 35%;
            margin-bottom: 10px;
            border-radius: 15px;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
            margin: 0px;
        }

        #banner .endereco,
        #banner .horario {
            text-align: center;
            color: white;
        }

        #banner h3 {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
            width: fit-content;
            padding: 10px;
            font-size: 16px;
            margin: auto;
        }

        .fechado {
            color: #db4d59;
        }

        .modal figure {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            box-shadow: 0px 0px 13px 1px #afafafba;
        }

        .modal .modal-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0px;
        }

        .modal .descricao-produto {
            color: #767676;
        }

        .modal .preco {
            font-size: 18px;
            font-weight: 700;
            color: #db4d59;
        }

        .modal .quantidade-contain {
            display: flex;
            justify-content: center;
        }

        .modal .quantidade-contain div {
            width: 40px;
            height: 40px;
            margin: 0px;
            font-size: 26px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .modal .quantidade-contain .menos {
            background-color: #ffa2a9;
        }

        .modal .quantidade-contain .mais {
            background-color: #db4d59;
            color: white;
        }

        .modal table {
            width: 100%;
            margin-top: 20px;
            font-size: 16px;
        }

        .modal table input {
            min-width: 15px;
            min-height: 15px;
        }

        .modal .add-carrinho {
            margin-top: 20px;
            border-radius: 10px;
            color: white;
            border: 0px;
            font-size: 18px;
            background-color: #db4d59;
            height: 50px;
        }
    </style>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pad Thai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <figure class="foto-produto"
                        style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                    </figure>
                    <p class="descricao-produto">Noodle stir fried with chives, bean shoot, fried tofu, egg, crushed peanuts
                        and lemon</p>
                    <h3 class="preco">R$ 13,50</h3>
                    <div class="quantidade-contain">
                        <div class="menos">-</div>
                        <div class="quantidade">0</div>
                        <div class="mais">+</div>
                    </div>

                    <table>
                        <tr>
                            <td>Mal Passado</td>
                            <td>+ R$0,00</td>
                            <td><input type="checkbox" name="select-adicional" id="select-adicional"></td>
                        </tr>
                        <tr>
                            <td>Bem Passado</td>
                            <td>+ R$0,00</td>
                            <td><input type="checkbox" name="select-adicional" id="select-adicional"></td>
                        </tr>
                        <tr>
                            <td>No ponto</td>
                            <td>+ R$0,00</td>
                            <td><input type="checkbox" name="select-adicional" id="select-adicional"></td>
                        </tr>
                    </table>

                    <button class="add-carrinho">Adicionar ao carrinho</button>
                </div>
            </div>
        </div>
    </div>

    <header id="banner"
        style="background-image: linear-gradient(#0000006b, #680f0dad), url({{ asset('/imgs/delivery/banner-delivery.jpg') }})">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        <figure>
            <img src="{{ asset('imgs/logo.jpg') }}" alt="">
        </figure>
        <p class="endereco"><i class="fa fa-map-marker" aria-hidden="true"></i> Avenida Litorânea, 100, São Luís, MA</p>
        <h3 class="status-estabelecimento fechado">Fechado</h3>
    </header>

    <section id="menu">
        <div class="menu-contain">
            <header>
                <h1>Menu</h1>
                <i class="fa fa-search" aria-hidden="true"></i>
            </header>
            <nav>
                <ul>
                    <li class="menu-active">Tudo</li>
                    <li>Entradas</li>
                    <li>Bebidas</li>
                    <li>Prato Principal</li>
                    <li>Sobremesa</li>
                    <li>Sobremesa</li>
                    <li>Sobremesa</li>
                    <li>Sobremesa</li>
                </ul>
            </nav>
            <section id="lista-produtos">
                <div class="contain-produtos">
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="produto">
                        <div class="desc-produto">
                            <h3>Pad Thai</h3>
                            <h4>R$ 13,50</h4>
                            <p>Noodle stir fried with chives, bean shoot, fried tofu, egg, crushed peanuts and lemon</p>
                        </div>
                        <figure id="food-image"
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                    </div>
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="produto">
                        <div class="desc-produto">
                            <h3>Pad Thai</h3>
                            <h4>R$ 13,50</h4>
                            <p>Noodle stir fried with chives, bean shoot, fried tofu, egg, crushed peanuts and lemon</p>
                        </div>
                        <figure id="food-image"
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                    </div>
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="produto">
                        <div class="desc-produto">
                            <h3>Pad Thai</h3>
                            <h4>R$ 13,50</h4>
                            <p>Noodle stir fried with chives, bean shoot, fried tofu, egg, crushed peanuts and lemon</p>
                        </div>
                        <figure id="food-image"
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                    </div>
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="produto">
                        <div class="desc-produto">
                            <h3>Pad Thai</h3>
                            <h4>R$ 13,50</h4>
                            <p>Noodle stir fried with chives, bean shoot, fried tofu, egg, crushed peanuts and lemon</p>
                        </div>
                        <figure id="food-image"
                            style="background-image: url({{ asset('/imgs/cardapios/1652047328-0q9RvuyikFhPfHxnUJWA2iF3eIg7bqEPDFjfZA9Q.jpg') }})">
                        </figure>
                    </div>
                </div>
            </section>
        </div>
    </section>



    <footer id="nav">
        <nav>
            <ul>
                <li class="menu-active">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </li>
                <li>
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
