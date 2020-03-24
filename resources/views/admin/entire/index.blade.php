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

    <title>@yield('title', '后台首页')</title>
    @section('resource')
    @show
    <style>
        {{--阿里样式--}}
        .nav_icon {
            width: 2em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
            position: absolute;
            top: 10px;
            right: 0;
        }
        #top a {
            color: #212121;
            text-shadow: none;
            text-decoration:none;
            margin: auto;
            white-space: nowrap;
            font-size: 16px;
        }
        #top a:hover{
            color: #00A1D6;
        }
        input {
            background: none;
            outline: none;
            border: none;
        }

        #top{
            display: flex;
            flex-direction: row;
            /*justify-content: flex-start;*/
            align-items: center;
            background: #fff;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
            padding: 0 0px 10px 0;
        }
        .top_interval{
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            width:30%;
            margin: 0 0 0 36px;
        }
        .nav_search{
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 30%;
            transition: 0.3s width;
            position: relative;
        }
        #nav_fromsearch{
            background: #F4F4F4;
            border: 1px solid #E7E7E7;
            display: block;
            padding: 0 38px 0 16px;
        }
        #nav_fromsearch input{
            height: 34px;
            width: 100%;
        }

        /*会员头像*/
        .head_img{
            width: 26px;
            height: 24px;
            border-radius: 50%;
            margin: 6px 0 0 0;
        }

        /*我的*/
        .mine{
            color: #212121;
            text-shadow: none;
            text-decoration: none;
            margin: auto;
            white-space: nowrap;
            font-size: 16px;
            position: relative;
        }
        .mine_detail{
            display: none;
            position: absolute;
            /*display: flex;*/
            flex-direction: column;
            background: #fff;
            box-shadow: 0 0 0 1px #eee;
            border-radius: 0 0 4px 4px;
            padding: 0 20px;
            left: -20px;
        }
        .mine:hover .mine_detail{
            display: flex;
        }
    </style>
    @section('style')
    @show
</head>
<body>
<div id="top">
    <div class="top_interval">
        <a href="">bilibili</a>
        <a href="">游戏</a>
        <a href="/admin/fiction">小说</a>
        <a href="">漫画</a>
        <a href="">番剧</a>
    </div>
    <div class="nav_search">
        <div id="nav_fromsearch">
            <input type="text" placeholder="请输入">
            <svg class="nav_icon" aria-hidden="true">
                <use xlink:href="#icon-sousuo2"></use>
            </svg>
        </div>
    </div>
    <div class="top_interval">
        <div class="mine">
            <img v-on:click="myself" class="head_img" src="/imgs/home_index/head.webp" alt="">
            <div class="mine_detail">
                <span style="font-size: 20px;">{{\Illuminate\Support\Facades\Auth::guard('user')->user()->name}}</span>
                <a href="#" v-on:click="loginout">退出登录</a>
            </div>
        </div>
        <a href="">权限</a>
        <a href="">消息</a>
        <a href="">动态</a>
        <a href="">收藏</a>
        <a href="">历史</a>
    </div>
</div>
@section('content')
@show
<script type=“text/html” src="{{ asset('layui/layui.js') }}" charset="utf-8"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var Vue = new Vue({
        el : "#top",
        data(){
            return {

            };
        },
        methods:{
            loginout(){
                axios({
                    method: 'get',
                    url: '/admin/loginout',
                    data: {
                    },
                    headers:{ '_token':'{{csrf_token()}}'},
                }).then(function(data) {
                    if(data.data.code == 200){
                        window.location.href="/admin/back";
                    }else{
                        alert(data.data.msg);
                    }
                }).catch(function (error) {
                    // console.log('失败');
                });
            },
            myself(){
                window.location.href="/admin/drama";
            },
        }
    });
</script>
@section('js')
@show
</body>
</html>
