<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="{{public_path('css/invoice-pdf.css')}}" media="all"/>
<title>Relatório de Resumo de Caixa </title>
<div>
    <head>
        <meta charset="utf-8">
        <title>Relatório de Resumo de Caixa</title>

        <style>

        </style>
    </head>

    <body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img
                                    src="{{  public_path('/imgs/empresas/'. auth()->user()->empresa->parametros->logo)}}"
                                    style="width:120px">
                            </td>

                            <td>
                                {{auth()->user()->empresa->razao_social}}<br>
                                Relatório de Resumo de Caixa <br>
                                Período: {{\Carbon\Carbon::parse($data)->format('d/m/y')}}<br>
                                Emitido em: {{ Carbon\Carbon::now()->format('d/m/Y H:i:s') }} <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td colspan="2">
                    Valores Recebidos
                </td>

            </tr>

            <?php $saldo_vendas = 0.00 ?>
            @foreach($movimentacoes as $mov)
                <tr class="item">
                    <td>
                        {{$mov->forma_pagamento}}
                    </td>

                    <td>
                        @money($mov->valor_pago)
                        <?php $saldo_vendas += $mov->valor_pago ?>
                    </td>
                </tr>

            @endforeach
            <tr class="total">
                <td></td>

                <td>
                    Saldo Vendas: @money($saldo_vendas)
                </td>
            </tr>

            <br>
            <tr class="heading">
                <td colspan="2">
                    Resumo
                </td>
            </tr>


            <tr class="item">
                <td>
                    Saldo Inicial
                </td>

                <td>
                    @money($caixa->valor_inicial)
                </td>
            </tr>
            <tr class="item">
                <td>
                    Valores Recebidos
                </td>

                <td>
                    @money($caixa->entradas)
                </td>
            </tr>

            <tr class="item">
                <td>
                    Retiradas Realizadas
                </td>

                <td>
                    - @money($caixa->saidas)
                </td>
            </tr>

            @if($caixa->status == 'A')
                <tr class="item">
                    <td>
                        <b>Saldo Atual</b>
                    </td>

                    <td><b> @money(($caixa->valor_inicial + $caixa->entradas)- $caixa->saidas)</b></td>
                </tr>
            @else

                <tr class="item">
                    <td>
                        <b>Saldo Final</b>
                    </td>

                    <td><b> @money($caixa->valor_final)</b></td>
                </tr>

                @if($caixa->saldo_quebra > 0)
                    <tr class="item">
                        <td>
                            <b>Sobra de Caixa</b>
                        </td>

                        <td><b> @money($caixa->saldo_quebra)</b></td>
                    </tr>
                @endif

                @if($caixa->saldo_falta > 0)
                    <tr class="item">
                        <td>
                            <b>Falta de Caixa</b>
                        </td>

                        <td><b> @money($caixa->saldo_falta)</b></td>
                    </tr>
                @endif
            @endif

        </table>
    </div>
    </body>
</html>
