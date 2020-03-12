@extends("admin.entire.index")
@section('title','表格')
@section('resource')
    <script src="/js/ali/detail.js"></script>
    <link rel="stylesheet" href="{{ asset('layui/extend/ext/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('layui/extend/ext/soulTable.css') }}"/>
@stop
@section('style')
    <style>
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
    </style>

@stop
@section('content')
    <div class="body" id="table">
        <div class="self_inner">
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
                            <span class="infor_name">创建者:徐振</span>
                            <span>0个内容 &nbsp; · &nbsp; 公开</span>
                            <div id="jump" class="rgt_detail">
                                <span href="">添加</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table_body">
        <div class="table_detail" id="table_id">
            <table id="myTable" ></table>
        </div>
    </div>
@stop
@section('js')
    <script type="text/html" id="toolbar">
        <div><button class="layui-btn layui-btn-sm" lay-event="clearFilter">清除所有筛选条件</button></div>
    </script>
    <script type="text/html" id="bar">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
    <script>
        {{--layui--}}
        {{--自定义模块--}}
        layui.config({
            base: '/layui/extend/ext/',   // 模块目录
            version: 'v1.3.4'
        }).extend({                         // 模块别名
            soulTable: 'soulTable'
            // soulTable: 'tableChild'
        });

        layui.use(['layer', 'form', 'table','soulTable'], function () {
            var table = layui.table,
                layer = layui.layer,
                form = layui.form;
            soulTable = layui.soulTable;
            $ = layui.$;

            table.render({
                elem: '#myTable'
                ,id: 'myTable'
                                ,url: "{{url('admin/table/{table}')}}" //数据接口
                // ,url: 'https://soultable.saodiyang.com/back/poetry/dataGrid'
                ,toolbar: '#toolbar'
                // ,toolbar: true
                ,totalRow: true
                ,limit: 20
                ,page: true
                ,rowDrag: {/*trigger: 'row',*/ done: function(obj) {
                        // 完成时（松开时）触发
                        // 如果拖动前和拖动后无变化，则不会触发此方法
                        console.log(obj.row) // 当前行数据
                        console.log(obj.cache) // 改动后全表数据
                        console.log(obj.oldIndex) // 原来的数据索引
                        console.log(obj.newIndex) // 改动后数据索引
                    }}
                ,totalRow: true
                ,cols: [[

                    // {type: 'checkbox', fixed: 'left'},
                    // {field: 'title', title: '诗词', width: '10%', sort: true, filter: true},
                    // {field: 'dynasty', title: '朝代', width: '10%', sort: true, filter: true},
                    // {field: 'author', title: '作者', width: '10%' , filter: true},
                    // {field: 'content', title: '内容', width: '10%', filter: true},
                    // {field: 'type', title: '类型', width: '10%',  filter: {split:','}, sort:true},
                    // {field: 'heat', title: '点赞数', width: '10%',  filter: true, fixed: 'right', sort:true, excel:{cellType: 'n'}},
                    // {field: 'createTime', title: '录入时间', width: '10%', fixed: 'right', filter: {type: 'date[yyyy-MM-dd HH:mm:ss]'}, sort:true},
                    // {title: '操作', width: '30%', fixed: 'right', templet: '#bar'}
                    // {type: 'radio', title: '##', fixed: 'left'},
                    // {type: 'checkbox', title: '##', fixed: 'left'},
                    // {field: 'title', title: '名称', fixed: 'left', totalRowText: '合计',filter: true},
                    {field: 'title', title: '名称',width:'20%', sort: true, filter: true, totalRowText: '合计'},
                    {field: 'num', title: '数量',width:'20%', sort: true,filter: true,totalRow: true},
                    {field: 'detail', width:'20%',title: '描述',filter: true, },
                    // {field: 'content', title: '内容',},
                    {field: 'created_at',width:'10%', title: '录入时间', filter: true,},
                    {field: 'updated_at',width:'10%', title: '更新时间', filter: true,},
                    {title: '操作', width: '20%', fixed: 'right', templet: '#bar'},
                ]]
                ,done: function (res, curr, count) {
                    soulTable.render(this);
                    AutoTableHeight();
                }
            });

            $(document).on('click', '#jump', function () {
                layer.open({
                    type: 2,
                    title: '表格添加',
                    content: '/admin/table/create',
                    maxmin: true, //开启最大化最小化按钮
                    area: ['800px', '600px'],
                    resize: false
                });
            });
        });

        function AutoTableHeight()
        {
            var dev_obj = document.getElementById('table_id'); //table的父div

            var layuitable_main = dev_obj.getElementsByClassName("layui-table-main"); //在父div中找 layui-table-main 属性所在标签
            // if (layuitable_main != null && layuitable_main.length > 0) {
                layuitable_main[0].style.height = '100%';
                // console.log(layuitable_main);
            // }

            // var layuitable = dev_obj.getElementsByClassName("layui-form"); //在父div中找 layui-form 属性所在标签
            // if (layuitable != null && layuitable.length > 0) {
            //     layuitable[0].style.height = '100%';
            //     console.log(layuitable);
            // }
        }
    </script>
@stop
