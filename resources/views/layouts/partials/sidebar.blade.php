<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Cadastros</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Menu</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('categorias-cardapio.index')}}">Categorias</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('sub-categorias-cardapio.index')}}">SubCategorias</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('setores.index')}}">Setores</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('cardapios.index')}}">Cardápio</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Controle de Pedidos</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-format-list-bulleted-type"></i>
              <span class="menu-title">Pedidos</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Pedidos Recebidos</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="menu-icon mdi mdi-clock-alert"></i>
              <span class="menu-title">Painel</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Cozinha</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Bar</a></li>
              </ul>
            </div>
          </li>
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
          <li class="nav-item nav-category">delivery e retirada</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#delivery" aria-expanded="false" aria-controls="delivery">
                    <i class="menu-icon mdi mdi-motorbike"></i>
                    <span class="menu-title">DELIVERY E RETIRADA</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="delivery">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Horário de Funcionamento </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Cardápio Mobile </a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Controle de Estoque</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock">
                    <i class="menu-icon mdi mdi-drawing-box"></i>
                    <span class="menu-title">Entrada e Saída</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="stock">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Notas Fiscais </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Saídas de Insumos </a></li>
                    </ul>
                </div>
                <a class="nav-link" data-bs-toggle="collapse" href="#insumos" aria-expanded="false" aria-controls="insumos">
                    <i class="menu-icon mdi mdi-stocking"></i>
                    <span class="menu-title">Estoque de Insumos</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="insumos">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Categorias </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Insumos </a></li>
                    </ul>
                </div>
            </li>
          <li class="nav-item nav-category">controle de caixa</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-cash"></i>
              <span class="menu-title">Caixa</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Pagamentos </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Ajustes</li>
          <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
              <i class="menu-icon mdi mdi-cogs"></i>
              <span class="menu-title">Configuração</span>
            </a>
          </li>
        </ul>
      </nav>
