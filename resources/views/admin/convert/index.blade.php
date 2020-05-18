@extends("admin.entire.index")
@section('title','番剧')
@section('resource')
    <script src="/js/ali/detail.js"></script>
    <link rel="stylesheet" href="{{ asset('layui/extend/ext/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('layui/extend/ext/soulTable.css') }}"/>
@stop
@section('style')
    <style>
        body{overflow-y: scroll;}  /* 禁止刷新后出现横向滚动条 */
        .layui-table-view .layui-table {width:100%}
        .layui-table-cell {
            height: 50px;
        {{--height: inherit;--}}
    }
        {{--阿里样式--}}
    .icon {
            width: 2em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
        }
        {{--详情 --}}
    .detailIcon {
            width: 1em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
        }
        {{--取消ul样式--}}
    ul{
            list-style: none;
        }

        a {
            color: #212121;
            text-shadow: none;
            text-decoration:none;
            margin: auto;
            white-space: nowrap;
            font-size: 14px;
            text-decoration: none;
        }
        a:hover{
            color: #00A1D6;
        }
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

        .table_content{
            display:flex;
            flex-direction: row;
            width:90%;
            background: #fff;
            box-shadow: 0 0 0 1px #eee;
            border-radius: 4px;
            margin: 10px 0 0 0;
        }
        .table_lft{
            display:flex;
            flex-direction: column;
            width: 20%;
            border-right: 1px solid #eee;
        }
        .table_rgt{
            display: flex;
            flex-direction: column;
            width:80%;
        }
        .lft_folder{
            height: 54px;
            padding-left: 19px;
            line-height: 54px;
            font-size: 14px;
            color: #99a2aa;
        }
        .lft_folders{
            height: 54px;
            padding-left: 19px;
            line-height: 54px;
            font-size: 14px;
            color: #222;
            cursor: pointer;
        }
        .rgt_top{
            display:flex;
            flex-direction: row;
            padding: 20px 0;
            margin: 0 20px;
            box-sizing: border-box;
            /*border-bottom: 1px solid #e5e9ef;*/
        }
        .rgt_img{
            height: 119px;
            object-fit: cover;
            object-position: 50%;
            border-radius: 4px
        }
        .rgt_default{
            margin-left: 18px;
        }
        .rgt_default_name{
            display: block;
            margin-bottom: 14px;
        }
        .rgt_default_infor{
            display: flex;
            flex-direction: column;
            font-size: 12px;
            color: #99a2aa;
        }
        .infor_name{
            vertical-align: middle;
        }
        .rgt_detail{
            width: 120px;
            height: 32px;
            background: #00a1d6;
            border-radius: 2px;
            font-size: 14px;
            color: #fff;
            line-height: 32px;
            text-align: center;
            margin-top: 20px;
            cursor: pointer;
        }
        .rgt_handle{
            display: flex;
            flex-direction: row-reverse;
            margin-top: 15px;
        }
        .rgt_search{
            display:flex;
            height: 28px;
            margin: 0;
            border: 1px solid #ccd0d7;
            border-radius: 14px;
            white-space: nowrap;
            margin: 0 36px 0 0;
        }
        .rgt_search_color{
            height: 28px;
            margin: 0;
            border: 1px solid #ccd0d7;
            border-radius: 14px;
            white-space: nowrap;
            border-color:#00a1d6;
        }
        .rgt_search:focus-within{
            border-color:#00a1d6;
        }
        .table_body{
            margin: auto;
            max-width: 90%;
        }
        .table_detail{
            width: 90%;
            background: #fff;
            margin: 10px 0 0 0;
        }
        .convert{
            display: flex;
            flex-direction: row;
        }
        #download{
            margin-left: 15px;
            display: none;
        }

        /*我的导航*/
        .navigator{
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            width: 90%;
            background: #fff;
            box-shadow: 0 0 0 1px #eee;
            border-radius: 0 0 4px 4px;
            padding: 16px 0px;
        }
        .navigator a{
            font-size: 20px;
            /* margin-right: 4px; */
            vertical-align: middle;
        }
    </style>

@stop
@section('content')
    <div class="body" id="table">
        <div class="self_inner">
        </div>
        <div class="navigator">
            <a href="/admin/table">表格</a>
            <a href="/admin/drama">视频</a>
            <a href="/admin/article">文章</a>
            <a href="#">漫画</a>
            <a href="/admin/label">标签</a>
            <a href="/admin/convert">转换</a>
        </div>
        {{--表格内容--}}
        <div class="table_content">
            <div class="table_lft">
                <div class="lft_folder">
                    <span>我的文件夹</span>
                </div>
                <div class="lft_folders">
                    <span>新建文件夹</span>
                </div>
                <div class="lft_folders">
                    <a>默认文件夹</a>
                </div>
            </div>
            <div class="table_rgt">
                <div class="rgt_top">
                    <img src="/imgs/back/1.jpg" alt="" class="rgt_img">
                    <div class="rgt_default">
                        <a href="" class="rgt_default_name">默认收藏夹</a>
                        <div class="rgt_default_infor">
                            <span class="infor_name">创建者:{{\Illuminate\Support\Facades\Auth::guard('user')->user()->name}}</span>
                            <span>0个内容 &nbsp; · &nbsp; 公开</span>
                            {{--<div id="jump" class="rgt_detail">--}}
                                {{--<span href="">word上传</span>--}}
                            <div class="convert">
                                <button type="button" class="layui-btn" id="video" lay-type="video">
                                    <i class="layui-icon">&#xe67c;</i>word上传
                                </button>
                                <button type="button" class="layui-btn" id="download">
                                    {{--<a href="http://demo.xx.cn/demo.zip" class="layui-icon">&#xe67c;</a>txt下载--}}
                                </button>
                            </div>
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/html" id="toolbar">
        <div><button class="layui-btn layui-btn-sm" lay-event="clearFilter">清除所有筛选条件</button></div>
    </script>
    <script type="text/html" id="bar">
        {{--<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>--}}
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
    <script>
        // 表单提交
        layui.use(['form','upload','element'], function(){
            var upload = layui.upload,
                element = layui.element,
                layer = layui.layer;
            //拖拽上传
            var uploadInst = upload.render({
                elem: '#video'
                ,url: "{{url('/admin/analysis')}}"
                // , size: 2048
                ,method:'post'
                ,accept: 'file' //所有文件
                // ,ext: 'zip|rar'
                // ,type: 'file'
                ,headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                    //如果上传失败
                    if (res.code == 200) {
                        layer.msg('成功');
                        // $("#site").attr("value",res.data.src);
                        $("#download").css("display",'inline-block');
                        $("#download").append(
                            '<a href="'+res.data.src+'" download="转换测试" class="layui-icon">&#xe67c;txt下载\n</a>'
                        );
                    }else{
                        layer.msg(res.msg);
                    }
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demo = $('#demo');
                    demo.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demo.find('.demo-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            });
            element.init();
        });

        //表格宽高调整
        function AutoTableHeight()
        {
            var dev_obj = document.getElementById('table_id'); //table的父div
            var layuitable_main = dev_obj.getElementsByClassName("layui-table-main"); //在父div中找 layui-table-main 属性所在标签
            layuitable_main[0].style.height = '100%';
        }
    </script>
@stop
