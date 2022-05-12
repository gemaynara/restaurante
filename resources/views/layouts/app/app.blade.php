<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="icon" href="images/favicon.png">
    <title>APP Delivery</title>
    <link href="https://fonts.googleapis.com/css?family=Prompt:300,400,500,600,700,800,900|Playfair+Display:400,700,900"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('app/css/framework7.min.css')}}">
    <link rel="stylesheet" href="{{asset('app/css/framework7-icons.css')}}">
    <link rel="stylesheet" href="{{asset('app/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('app/css/style.css')}}">


<body>
<div id="app">

   @yield('content')
</div>

<script src="{{asset('app/js/framework7.js')}}"></script>
<script src="{{asset('app/js/routes.js')}}"></script>
<script src="{{asset('app/js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $(".link, .link-app").on('click', function () {
            window.location.href = $(this).attr('href');
        })
    })
</script>
@stack('scripts')
</body>
</html>
