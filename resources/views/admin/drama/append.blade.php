@extends("layouts.layui")
@section('title','视频添加')
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
            <div>
                <label class="layui-form-label"><span class="x-red">*</span>视频</label>
                <div class="layui-input-inline" style="margin-bottom: 10px">
                    <input type="hidden" name="address" value="" id="site">
                    <button type="button" class="layui-btn" id="video" lay-type="video">
                        <i class="layui-icon">&#xe67c;</i>上传视频
                    </button>
                </div>
                {{--<div class="layui-input-inline">--}}
                    {{--<div class="layui-upload-list">--}}
                        {{--<img class="layui-upload-img headImage" style="width: 120px;height: 100px;margin-top: -10px;" src=""  id="demo1">--}}
                        {{--<span class="x-red">大小2m;后缀jpg,png,bmp,jpeg,gif</span>--}}
                        {{--<p id="demoText"></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
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
        // 表单提交
        layui.use(['form','upload','element'], function(){
            var upload = layui.upload,
                element = layui.element,
                layer = layui.layer;
            //拖拽上传
            var uploadInst = upload.render({
                elem: '#video'
                ,url: "{{url('/tool/uploadVideo')}}"
                // , size: 2048
                ,method:'post'
                ,accept: 'video' //视频
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
                    if (res.code = 200) {
                        layer.msg(res.msg);
                        $("#site").attr("value",res.data.src);
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

        // Demo
        layui.use('form', function(){
            var form = layui.form;
                // $ = layui.$;
            // 监听提交
            form.on('submit(formDemo)', function(data){
                // console.log(data.field);
                $.ajax({
                    url:'{{url('admin/drama')}}',
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
