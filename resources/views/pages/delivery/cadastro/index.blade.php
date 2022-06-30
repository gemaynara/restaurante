@extends('layouts.app.delivery')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .title {
            text-align: center;
            margin-bottom: 25px;
        }

        .title figure img {
            width: 35%;
            margin-bottom: 10px;
            border-radius: 15px;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
        }

        .title h1 {
            font-weight: 400;
            margin: auto;
            overflow-wrap: revert;
            color: #db4d59;
        }

        .title p {
            color: #818181;
            font-size: 15px;
            margin: 0px;
            margin-top: 5px;
            font-weight: 300;
        }

        form p {
            text-align: right;
            color: #686868;
            text-decoration: underline;
        }

        .login {
            height: 100vh;
            width: 80%;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .login * {
            width: 100%;
        }

        .login form input {
            height: 60px;
            margin-bottom: 20px;
            padding: 15px;
            font-size: 14px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
        }

        .login input[type=submit] {
            background-color: #db4d59;
            font-size: 18px;
            font-weight: bold;
            color: white;
            border: 0;
            margin-top: 10px;
        }
    </style>

    <section class="login">
        <div class="title">
            <figure>
                <img src="{{ asset('imgs/logo.jpg') }}" alt="">
            </figure>
            <h1>Criar uma nova conta</h1>
            <p>Crie uma conta para pedir as deliciosas comidas direto na brasa!</p>
        </div>
        <form action="">
            <div>
                <input type="text" name="name" id="name" placeholder="Digite seu nome">
                <input type="tel" name="tel" id="tel" placeholder="Digite seu número de telefone">
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
                <input type="password" name="password" id="password" placeholder="Digite sua senha">
            </div>
            <input type="submit" value="Entrar">
        </form>
    </section>
@endsection
