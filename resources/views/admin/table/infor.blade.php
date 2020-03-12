<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}"/>
    <link rel="stylesheet" href="{{ asset('layui/extend/ext/soulTable.css') }}"/>
    <title>Document</title>
    <style>
        .layui-table-view .layui-table {width:100%}
        .layui-table-cell {
            height: 50px;
        {{--height: inherit;--}}
        }
    </style>
</head>
<body>
<table id="myTable" ></table>
<script type="text/html" id="toolbar">
    <div><button class="layui-btn layui-btn-sm" lay-event="clearFilter">清除所有筛选条件</button></div>
</script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>

<script >
    // 自定义模块
    layui.config({
        base: '/layui/extend/ext/',   // 模块目录
        // version: 'v1.5.2'
    }).extend({                         // 模块别名
        soulTable: 'soulTable'
    });

    layui.use(['form', 'table','soulTable'], function () {
        var table = layui.table,
            soulTable = layui.soulTable;

        // 后台分页
        table.render({
            elem: '#myTable'
            ,id: 'myTable'
            ,url: 'https://soultable.saodiyang.com/back/poetry/dataGrid'
            {{--,url: "{{url('data.json')}}"--}}
            // ,height: 500
            // ,height: $(document).height() - $('#myTable').offset().top - 200
            // ,cellMinWidth: 60
            ,toolbar: '#toolbar'
            ,limit:20
            ,page: true
            ,cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'title', title: '诗词', width: '10%', sort: true, filter: true},
                {field: 'dynasty', title: '朝代', width: '10%', sort: true, filter: true},
                {field: 'author', title: '作者', width: '10%' , filter: true},
                {field: 'content', title: '内容', width: '10%', filter: true},
                {field: 'type', title: '类型', width: '10%',  filter: {split:','}, sort:true},
                {field: 'heat', title: '点赞数', width: '10%',  filter: true, fixed: 'right', sort:true, excel:{cellType: 'n'}},
                {field: 'createTime', title: '录入时间', width: '10%', fixed: 'right', filter: {type: 'date[yyyy-MM-dd HH:mm:ss]'}, sort:true},
                {title: '操作', width: '30%', fixed: 'right', templet: '#bar'}
            ]]
            ,done: function () {
                soulTable.render(this)
            }
        });

        table.on('toolbar(myTable)', function(obj){
            if (obj.event === 'clearFilter') {
                // 清除所有筛选条件并重载表格
                // 参数: tableId
                soulTable.clearFilter('myTable')
            }
        });
    })
</script>
</body>
</html>
