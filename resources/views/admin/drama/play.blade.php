<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    <script src="/js/ali/iconfont.js"></script>
    <script src="{{ asset('layui/layui.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script  src="{{ asset('js/jquery-3.0.0.js') }}" charset="utf-8"></script>
    <title>视频播放</title>
</head>
<body>
<div style="width: 100%;height: 100%;position:absolute;">
    <div class="video" id="video" data-url="{{$address}}" style="width: 100%;height: 100%;"></div>
</div>
<script type=“text/html” src="{{ asset('layui/layui.js') }}" charset="utf-8"></script>
<script>
    // 视频播放
    layui.config({
        base: '/layui/extend/ckplayer/'
    }).extend({
        ckplayer: 'ckplayer'
    }).use(['jquery', 'ckplayer'], function() {
        var $ = layui.$,
            ckplayer = layui.ckplayer;
        var vUrl = $('#video').data('url'),
            videoObject = {
                container: '#video',
                loop: true,
                autoplay: true,
                video: [
                    [vUrl, 'video/mp4']
                ]
            };
        var player = new ckplayer(videoObject);
    });
</script>
</body>
</html>
