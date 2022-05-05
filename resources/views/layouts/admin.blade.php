<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Restaurante </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">


    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
{{--    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('js/select.dataTables.min.css')}}">--}}

    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
{{--    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet"/>--}}
{{--    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>--}}
<!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
@include('layouts.partials.navbar')
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
    @include('layouts.partials.sidebar')
    <!-- partial -->
        <div class="main-panel">
        @yield('content')
        <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('layouts.partials.footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<!-- container-scroller -->

<!-- plugins:js -->
<!-- Plugin js for this page-->
<script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{asset('/js/sweetalert2.all.min.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>

<!-- End plugin js for this page -->

<script src="{{asset('vendors/select2/select2.min.js')}}"></script>

<script src="{{asset('js/select2.js')}}"></script>
<!-- inject:js -->
<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/hoverable-collapse.js')}}"></script>
<script src="{{asset('js/template.js')}}"></script>
<script src="{{asset('js/settings.js')}}"></script>
<script src="{{asset('js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script src="{{asset('js/Chart.roundedBarCharts.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/validate.js')}}"></script>
<!-- End custom js for this page-->
@stack('scripts')
</body>

</html>

