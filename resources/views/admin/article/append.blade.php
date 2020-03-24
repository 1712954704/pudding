@extends("layouts.layui")
@section('title','文章添加')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="layui-fluid" style="margin-bottom: 70px;">
        <form  id="form" class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>文章标题</label>
                {{ csrf_field() }}
                <div class="layui-input-inline">
                    <input type="text" name="title"  autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>添加文章
                </label>
                <div>
                    <textarea id="layeditDemo"  style="display: none;">

                    </textarea>
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
        layui.use(['layedit','form','layer','laydate','upload','element','transfer'], function() {
            var form = layui.form;
            var $ = layui.jquery;
            var layedit = layui.layedit;

            layedit.set({
                //暴露layupload参数设置接口 --详细查看layupload参数说明
                uploadImage: {
                    // url: '/Attachment/LayUploadFile',
                    url: '{{url('tool/uploadRichImg')}}',
                    accept: 'image',
                    acceptMime: 'image/*',
                    exts: 'jpg|png|gif|bmp|jpeg',
                    size: '10240',
                    // dataType:'JSON',
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                }
                , uploadVideo: {
                    {{--url:'{{url('admin/fileDel')}}',--}}
                    url: '{{url('tool/uploadVideo')}}',
                    {{--url:'{{url('admin/uploadImg')}}',--}}
                    accept: 'video',
                    acceptMime: 'video/*',
                    exts: 'mp4|flv|avi|rm|rmvb',
                    size: '20480',
                    // method:"post",
                    // dataType:'JSON',
                    // async : true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                }
                //右键删除图片/视频时的回调参数，post到后台删除服务器文件等操作，
                //传递参数：
                //图片： imgpath --图片路径
                //视频： filepath --视频路径 imgpath --封面路径
                , calldel: {
                    // url: '/Attachment/DeleteFile',
                    url: '{{url('tool/delFile')}}',
                }
                //开发者模式 --默认为false
                , devmode: false
                //插入代码设置
                , codeConfig: {
                    hide: true,  //是否显示编码语言选择框
                    default: 'javascript' //hide为true时的默认语言格式
                }
                , tool: [
                    'html', 'code', 'strong', 'italic', 'underline', 'del', 'addhr', '|', 'fontFomatt', 'colorpicker', 'face'
                    , '|', 'left', 'center', 'right', '|', 'link', 'unlink', 'image_alt', 'video', 'anchors'
                    , '|', 'fullScreen'
                ]
                // , height: $("body").height()*1.8+'px'
            });
            var ieditor = layedit.build('layeditDemo');
            // 监听提交
            form.on('submit(formDemo)', function(data){
                data.field.content = layui.layedit.getContent(ieditor);
                $.ajax({
                    url:'{{url('admin/article')}}',
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
