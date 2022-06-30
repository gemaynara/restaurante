<?php
//$producao = \App\Models\Setor::listaSetores() ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    @if(auth()->user()->hasRole('Super Admin'))
        <ul class="nav">
            <li class="nav-item nav-category">controle de acesso</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                    <i class="menu-icon mdi mdi-account"></i>
                    <span class="menu-title">Acesso</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">Usuários </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}">Perfil de Acesso </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item nav-category">Empresas</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('empresas.index')}}">
                    <i class="menu-icon mdi mdi-food"></i>
                    <span class="menu-title">Restaurantes</span>
                </a>
            </li>
        </ul>

    @else

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            @can('cardapio')
                <li class="nav-item nav-category">Cadastros</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                       aria-controls="ui-basic">
                        <i class="menu-icon mdi mdi-floor-plan"></i>
                        <span class="menu-title">Menu</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('mesas.index')}}">Mesas</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('categorias-cardapio.index')}}">Categorias</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('sub-categorias-cardapio.index')}}">SubCategorias</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('setores.index')}}">Setores</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('cardapios.index')}}">Cardápio</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('pedidos')
                <li class="nav-item nav-category">Controle de Pedidos</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                       aria-controls="form-elements">
                        <i class="menu-icon mdi mdi-format-list-bulleted-type"></i>
                        <span class="menu-title">Pedidos</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('pedidos.mesas')}}">Pedidos Salão</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('pedidos.recebidos')}}">Pedidos
                                    Recebidos</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('pedidos.lista')}}">Todos os
                                    Pedidos</a></li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('producao')
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                       aria-controls="charts">
                        <i class="menu-icon mdi mdi-clock-alert"></i>
                        <span class="menu-title">Painel</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('producao.pedidos', 'mesa')}}">Pedidos
                                    Salão</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('producao.pedidos', 'delivery')}}">Pedidos
                                    Entrega/Retirada</a></li>

                        </ul>
                    </div>
                </li>
            @endcan
            {{--          <li class="nav-item">--}}
            {{--            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">--}}
            {{--              <i class="menu-icon mdi mdi-table"></i>--}}
            {{--              <span class="menu-title">Tables</span>--}}
            {{--              <i class="menu-arrow"></i>--}}
            {{--            </a>--}}
            {{--            <div class="collapse" id="tables">--}}
            {{--              <ul class="nav flex-column sub-menu">--}}
            {{--                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>--}}
            {{--              </ul>--}}
            {{--            </div>--}}
            {{--          </li>--}}
            {{--          <li class="nav-item">--}}
            {{--            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">--}}
            {{--              <i class="menu-icon mdi mdi-layers-outline"></i>--}}
            {{--              <span class="menu-title">Icons</span>--}}
            {{--              <i class="menu-arrow"></i>--}}
            {{--            </a>--}}
            {{--            <div class="collapse" id="icons">--}}
            {{--              <ul class="nav flex-column sub-menu">--}}
            {{--                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>--}}
            {{--              </ul>--}}
            {{--            </div>--}}
            {{--          </li>--}}
            @can('delivery')
                <li class="nav-item nav-category">entrega e retirada</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#delivery" aria-expanded="false"
                       aria-controls="delivery">
                        <i class="menu-icon mdi mdi-motorbike"></i>
                        <span class="menu-title">Entrega e Retirada</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="delivery">
                        <ul class="nav flex-column sub-menu">
{{--                            <li class="nav-item"><a class="nav-link" href="pages/samples/login.html">Horário de Funcionamento </a></li>--}}
                            <li class="nav-item"><a class="nav-link" href="{{route('cardapio-online', ['slug'=>auth()->user()->empresa->parametros->slug])}}">Cardápio On-line</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            @can('estoque')
                <li class="nav-item nav-category">Controle de Estoque</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#notes" aria-expanded="false"
                       aria-controls="notes">
                        <i class="menu-icon mdi mdi-set-left-center"></i>
                        <span class="menu-title">Entrada e Saída</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="notes">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{route('fornecedores.index')}}">Fornecedores</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('notas-fiscais.index')}}">Notas
                                    Fiscais</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('saidas.index')}}">Saída de
                                    Produtos</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#stock" aria-expanded="false"
                       aria-controls="stock">
                        <i class="menu-icon mdi mdi-apps-box"></i>
                        <span class="menu-title">Controle de Produtos</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{route('categorias-produto.index')}}">Categorias</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('produtos.index')}}">Produtos</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('caixa')
                <li class="nav-item nav-category">controle de caixa</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon mdi mdi-cash"></i>
                        <span class="menu-title">Caixa</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('caixa.index')}}">Resumo do
                                    Caixa </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('pedidos.pdv')}}">Pagamento de
                                    Pedidos </a>
                            </li>
                        </ul>

                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('movimentacao.retirada-caixa')}}">Retiradas
                                    do Caixa </a>
                            </li>
                        </ul>

                        {{--                        <ul class="nav flex-column sub-menu">--}}
                        {{--                            <li class="nav-item"><a class="nav-link" href="pages/samples/login.html">Pagamentos </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                    </div>
                </li>
            @endcan
            @can('relatorios')
                <li class="nav-item nav-category">Relatórios</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false"
                       aria-controls="reports">
                        <i class="menu-icon mdi mdi-printer-3d"></i>
                        <span class="menu-title">Relatórios</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="reports">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('caixa.rel-resumo')}}">Resumo do
                                    Caixa</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('cardapio.rel-vendas')}}">Itens
                                    Vendidos</a></li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('acessos')
                <li class="nav-item nav-category">controle de acesso</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false"
                       aria-controls="users">
                        <i class="menu-icon mdi mdi-account"></i>
                        <span class="menu-title">Acesso</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('usuarios.index')}}">Usuários </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('ajustes')
                <li class="nav-item nav-category">Ajustes</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('parametros.index')}}">
                        <i class="menu-icon mdi mdi-cogs"></i>
                        <span class="menu-title">Configuração</span>
                    </a>
                </li>
            @endcan

            @endif
        </ul>
</nav>
