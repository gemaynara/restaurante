@extends('layouts.app.delivery')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        #app {
            overflow-y: auto;
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
            /* height: 100vh; */
            padding-top: 20px;
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

        .login form input,
        .login form select {
            height: 60px;
            margin-bottom: 20px;
            padding: 15px;
            font-size: 14px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0px 0px 13px 1px #afafaf3d;
            color: #707070;
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
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
                <input type="password" name="password" id="password" placeholder="Digite sua senha">
                <input type="password" name="confirm-password" id="confirm-password"
                    placeholder="Digite novamente sua senha">
            </div>
            <input type="submit" value="Entrar">
        </form>
    </section>
@endsection
