@extends('layouts.app.delivery')
@section('content')
    <link href="{{ asset('cardapio') }}/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        header#banner {
            height: 30vh;
            width: 100%;
            background-color: red;
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

        section#menu .menu-contain nav ul {
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
    </style>

    <header id="banner">
        <figure>
            <img src="" alt="">
        </figure>
        <p class="endereco"></p>
        <div class="status-estabelecimento"></div>
        <div class="infos">
            <p class="horario"></p>
            <p class="valor-minimo"></p>
            <button class="ver-mais"></button>
        </div>
    </header>

    <section id="menu">
        <div class="menu-contain">
            <header>
                <h1>Menu</h1>
                <i class="fa fa-search" aria-hidden="true"></i>
            </header>
            <nav>
                <ul>
                    <li>Tudo</li>
                    <li>Entradas</li>
                    <li>Bebidas</li>
                    <li>Prato Principal</li>
                    <li>Sobremesa</li>
                </ul>
            </nav>
            <section id="lista-produtos">
                <div class="contain-produtos">
                    <div class="produto">
                        <div class="desc-produto">
                            <h3></h3>
                            <h4></h4>
                            <p></p>
                        </div>
                        <figure>
                            <img src="" alt="">
                        </figure>
                    </div>
                </div>
            </section>
        </div>
    </section>



    <footer id="nav">
        <nav>
            <ul>
                <li>Home</li>
                <li>Pesquisar</li>
                <li>Carrinho</li>
                <li>Conta</li>
            </ul>
        </nav>
    </footer>
@endsection
