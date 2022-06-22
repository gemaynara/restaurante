<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cupom não Fiscal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

<table class="printer-ticket">
    <thead>
    <tr>
        <th class="title" colspan="3">{{app('restaurante')['razao_social']}}</th>
    </tr>
    <tr>
        <th colspan="3"> {{\Carbon\Carbon::parse($pedido->created_at)->format("d/m/Y H:i:s")}}</th>
    </tr>
    <tr>
        <th colspan="3">
            Mesa: {{$pedido->mesas->codigo}} <br/>
            <p>Nº Pessoas na mesa: {{$pedido->numero_pessoas}}</p>
        </th>
    </tr>
    <tr>
        <th class="ttu" colspan="3">
            <b>CUPOM NÃO FISCAL</b>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($pedido->detalhes as $item)
        <tr class="top">
            <td colspan="3">{{$item->cardapio->nome}}</td>
        </tr>
        <tr>
            <td>@money($item->valor_unitario)</td>
            <td>{{$item->quantidade}}</td>
            <td>@money($item->valor_subtotal)</td>
        </tr>
        <tr>
            <td colspan="3">
                @foreach($item->adicionais as $opc)
                    * {{$opc->quantidade}}x{{$opc->adicionalPedido->nome}} - @money($opc->valor)<br>
                @endforeach

            </td>
        </tr>
        <tr>
            <td colspan="3"> @if(!empty($item->observacoes))Obs.{{$item->observacoes}}@endif</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class="sup ttu p--0">
        <td colspan="3">
            <b>Totais</b>
        </td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Sub-total</td>
        <td align="right">@money($pedido->subtotal)</td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Adicionais</td>
        <td align="right">@money($pedido->adicionais)</td>
    </tr>
    @if(($pedido->desconto)>0)
        <tr class="ttu">
            <td colspan="2">Desconto</td>
            <td align="right">@money($pedido->desconto)</td>
        </tr>
    @endif

    @if($pedido->taxa> 0 )
        <tr class="ttu">
            <td colspan="2">Total</td>
            <td align="right"> @money($pedido->total)</td>
        </tr>
    @endif
    @if($pedido->numero_pessoas > 1)
        <tr class="ttu">
            <td colspan="2">Valor por Pessoa</td>
            <td align="right">@money(($pedido->total)/$pedido->numero_pessoas)</td>
        </tr>

    @endif

    <tr class="sup ttu p--0">
        <td colspan="3">
            <b>Pagamentos</b>
        </td>
    </tr>
    {{--        <tr class="ttu">--}}
    {{--            <td colspan="2">Voucher</td>--}}
    {{--            <td align="right">R$10,00</td>--}}
    {{--        </tr>--}}
    <?php $saldo_pago = 0.00 ?>
    @foreach($movimentacoes as $mov)
        <tr class="ttu">
            <td colspan="2">{{$mov->forma_pagamento}}</td>
            <td align="right">@money($mov->valor_pago)</td>
            <?php $saldo_pago += $mov->valor_pago ?>
        </tr>
    @endforeach
    <tr class="ttu">
        <td colspan="2">Total pago</td>
        <td align="right">@money($saldo_pago)</td>
    </tr>
    @if($saldo_pago > $pedido->total)
        <tr class="ttu">
            <td colspan="2">Troco</td>
            <td align="right"> @money($saldo_pago-$pedido->total)</td>
        </tr>
    @endif
    <tr class="sup">
        <td colspan="3" align="center">
            {{\App\Helpers\Util::BaseUrl()}}
        </td>
    </tr>
    </tfoot>
</table>


</body>

</html>
