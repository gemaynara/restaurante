<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="{{public_path('css/invoice.css')}}" media="all"/>
<title>Relatório de Produtos Vendidos </title>
<div>

    <header>
        <div id="logo-dir">
            <img  src="{{  public_path('/imgs/empresas/'. auth()->user()->empresa->parametros->logo)}}" id="imagem">
        </div>

        <div id="dados">
            <p id="header">
                <b> {{auth()->user()->empresa->razao_social}}</b>
                <br>Relatório de Produtos Vendidos
                <br>Período: {{\Carbon\Carbon::parse($inicial)->format('d/m/y')}}
                a {{\Carbon\Carbon::parse($final)->format('d/m/y')}}
                <br>Emitido em: {{ Carbon\Carbon::now()->format('d/m/Y H:i:s') }} <br></p>

        </div>

    </header>

    <body>
    <section>
        <div>
            <table id="tabela-relatorio">
                <thead>
                <tr id="relatorio">
                    <th><strong>#</strong></th>
                    <th><strong>Nome</strong></th>
                    <th><strong>Qnt. Vendida</strong></th>
                    <th><strong>Valor Unitário</strong></th>
                    <th><strong>Subtotal</strong></th>
                </tr>
                </thead>

                <?php  $total = 0.00;?>
                @foreach($vendas as $p)
                    <?php  $subtotal = 0.00?>
                    <tbody>
                    <tr>
                        <td><p>{{ $p->id}}</p></td>
                        <td><p>{{ $p->produto}}</p></td>
                        <td><p>{{ $p->quantidade}}</p></td>
                        <td><p>@money($p->valor_produto)</p></td>
                        <td><p>@money($p->valor_produto*$p->quantidade)</p></td>
                        <?php $subtotal = $p->valor_produto * $p->quantidade?>
                        <?php $total += $subtotal?>
                    </tr>

                    </tbody>
                @endforeach
            </table>


        </div>

    </section>

    </body>
</div>


<div id="footer">

    Total: <strong>@money($total)</strong>


</div>
<script type='text/php'>
            if (isset($pdf))
            {
                $pdf->page_text(500, $pdf->get_height() - 50, "{PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0,0,0));
            }

</script>

</html>
