<div class="navbar navbar-home">
    <div class="navbar-inner">
        <div class="block">
            <div class="row">
                <div class="col-20">
                    <a href="{{route('app.pages', $restaurante->slug)}}" class="link">
                        <i class="ti-align-left"></i>
                    </a>
                </div>
                <div class="col-20">
                    <a href="/categories/" class="link">
                        <i class="ti-layers"></i>
                    </a>
                </div>
                {{--                <div class="col-20">--}}
                {{--                    <a href="/search/" class="link">--}}
                {{--                        <i class="ti-search"></i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                <div class="col-20">
                    <a href="/menu-category/" class="link">
                        <i class="ti-receipt"></i>
                    </a>
                </div>
                <div class="col-20">
                    <a href="{{route('app.ver-pedido', $restaurante->slug)}}" class="link">
                        <i class="ti-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
