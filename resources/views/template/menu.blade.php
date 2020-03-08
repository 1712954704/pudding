<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="Vz3m24tm9IN6H1QAsHphKcoHpsw-k-KCapVZTGt6dd8" />
    <title>徐振的个人博客 | @yield('title', '首页')</title>
    <link rel="icon" type="image/x-icon/png" href="@yield('ico','/imgs/head.png')"/>

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/gh/stevenjoezhang/live2d-widget/autoload.js"></script>

    @section('resource')
        <script src="{{ asset('js/vue.js') }}"></script>
    @show
    @section('style')
    @show
</head>
<body>
@section('content')
@show
@section('js')
@show
</body>
</html>
