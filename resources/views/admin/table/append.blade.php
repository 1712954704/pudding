@extends("layouts.layui")
@section('title','表格添加')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="layui-fluid" style="margin-bottom: 70px;">
    <form  id="form" class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="x-red">*</span>名称</label>
            {{ csrf_field() }}
            <div class="layui-input-inline">
                <input type="text" name="title"  autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="x-red">*</span>人数</label>
            <div class="layui-input-inline">
                <input type="number" name="num" required lay-verify="required"  autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="x-red">*</span>描述</label>
            <div class="layui-input-block">
                <textarea name="detail" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            </div>
        </div>
    </form>
</div>
@stop
@section('js')
<script>

    // Demo
    layui.use('form', function(){
        var form = layui.form;
        // 监听提交
        form.on('submit(formDemo)', function(data){
            $.ajax({
                url:'{{url('admin/table')}}',
                method:'post',
                data:data.field,
                dataType:'JSON',
                async : true,
                success:function(data){
                if(data.code == 200){
                    layer.alert('添加成功', {
                            icon: 6
                        },
                        function() {
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        });
                }else if(data.code == 416){
                    layer.alert(data.msg, {
                        icon: 5
                    });
                }else if(data.code == 1){
                    layer.alert(data.msg, {
                        icon: 5
                    });
                }else{
                    layer.alert('网络链接超时', {
                        icon: 5
                    });
                }
            },
            error:function (data) {
                layer.alert('网络链接超时', {
                    icon: 5
                });
            }
        })
            return false;
        });
    });
</script>
@stop
