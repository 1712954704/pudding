<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--左下角人物--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>--}}
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css">--}}
    {{--<script src="https://cdn.jsdelivr.net/gh/stevenjoezhang/live2d-widget/autoload.js"></script>--}}
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    <script src="/js/ali/iconfont.js"></script>
    <script src="{{ asset('layui/layui.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script  src="{{ asset('js/jquery-3.0.0.js') }}" charset="utf-8"></script>
    <script  src="{{ asset('ace/ace.js') }}" charset="utf-8"></script>

    <title>@yield('title', 'layui')</title>
    @section('resource')
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
