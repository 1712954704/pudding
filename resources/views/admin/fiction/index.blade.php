@extends("admin.entire.index")
@section('title','小说')
@section('style')
    <style>
    .body{
        display:flex;
        flex-direction:column;
        margin:auto;
        max-width: 90%;
    }

    .self_inner{
        background-image:url("/imgs/home_index/self_bg.png");
        width: 90%;
        height: 200px;
        background-repeat: no-repeat;
    }
    </style>
@stop
@section('content')
    <div class="body">
        <div class="self_inner">

        </div>
        <h1>测试继承</h1>
    </div>
@stop
