@extends('template.menu')
@section('title','首页')
@section('style')
@stop
@section('content')
    <style>
        body{
            margin:0;
        }

        #subject{
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;  /*排列方式 按列的方向排列*/
        }

        #primary{
            /*height: 100%;*/
            background: url("/imgs/header-bg.jpg") no-repeat center;
            /*width: 100%;*/
            /*flex-direction: column;*/
            /*align-items: center;*/
        }

        .title{
            /*position: relative;*/
            align-items: center;
            height:70%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            z-index: 1;
        }

        a{
            color: #fff;
            outline: 0;
            text-decoration: none;
        }
        a:hover
        {
            color: #d9d4d4;
        }
        h1{
            margin:0;
        }
        .header_title{
            margin-top: 10px;
            color: rgba(255,255,255,0.8);
            line-height: 24px;
            text-shadow: 0 3px 6px rgba(0,0,0,0.3);
            animation: fade-in-down .9s both;
            animation-delay: .3s;
        }

        svg {
            fill: currentColor;
            display: inline-block;
            stroke-width: 0;
            stroke: currentColor;
            width: 14px;
            height: 14px;
        }

        .menu{
            position: fixed;
            z-index: 2;
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 6px;
            font-size: 12px;
            text-transform: uppercase;
            color: #fff;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            transition: left .3s ease;
        }

        .menu:hover{
            color: #d9d4d4;
            border: 1px solid rgba(124, 117, 117, 0.6);
        }

        .nav_1{
            width:15%;
            height:100%;
            background:black;
            /*animation:myfirst 5s;*/
            /*-moz-animation:myfirst 5s; !* Firefox *!*/
            /*-webkit-animation:myfirst 5s; !* Safari and Chrome *!*/
            /*-o-animation:myfirst 5s; !* Opera *!*/

            flex-direction: column;
            position:fixed;
            left:0px;
            z-index: 1;
            /*animation:myNav 0.5s;*/
        }

        .nav_2{
            width:15%;
            height:100%;
            background:black;
            /*animation:myfirst 5s;*/
            /*-moz-animation:myfirst 5s; !* Firefox *!*/
            /*-webkit-animation:myfirst 5s; !* Safari and Chrome *!*/
            /*-o-animation:myfirst 5s; !* Opera *!*/

            flex-direction: column;
            position:fixed;
            left:0px;
            z-index: 1;
            animation:myNav 0.5s;
        }

        .nav_3{
            width:15%;
            height:100%;
            background:black;
            /*animation:myfirst 5s;*/
            /*-moz-animation:myfirst 5s; !* Firefox *!*/
            /*-webkit-animation:myfirst 5s; !* Safari and Chrome *!*/
            /*-o-animation:myfirst 5s; !* Opera *!*/

            flex-direction: column;
            position:fixed;
            left:0px;
            z-index: 1;
            animation:myNavVanish 0.5s;
            animation-fill-mode : forwards;  //设置对象状态为动画结束时的状态
        }

        .navClose{
            position:absolute;
            right:10px;
            top:10px;
        }

        .hands{
            width:100%;
            height:239px;
            background-color: white;
            background: url("/imgs/side-bg.gif") no-repeat center;
            /*background-size: auto 100%;*/
            background-size: cover;
            padding-top: 40px;
            display: flex;
            flex-direction: column;         /* 改变排序方式会影响 justify-content 的控制方式 使之变为控制垂直的属性 需加上 align-item (此时已经改变为控制居中的属性) */
            /*justify-content: center;*/
            align-items: center;
            color: #fff;
            text-align: center;
        }

        .header_logo:hover{
            transform: rotate(-22deg);
        }

        .header_logo{
            width: 66px;
            height: 66px;
            border: 4px solid rgba(255,255,255,0.5);
            border-radius: 100%;
            box-shadow: inset 1px 1px 4px rgba(0,0,0,0.3), 0 2px 3px rgba(0,0,0,0.4);
            transition: all .3s ease;
        }

        .navCharacter {
            content: "";
            /*position: absolute;*/
            width: 100%;
            height: 1px;
            background-color: #3b3b3b;
        }

        .navCharacter span {
            position: relative;
            top: -10px;
            left: 41px;
            z-index: 1;
            padding: 0 10px;
            background-color: #000;
            color: #b8b8b8;
        }

        .tag{
            list-style-type: none;
            padding: 0px;
            margin: 26px;
            color: white;
        }

        #canvas{
            position: absolute;
            left:0px;
            bottom:0px;
            display: flex;
            height:30%;
            width:100%;
        }

        @keyframes myfirst
        {
            0%   {background: black;}
            25%  {background: yellow;}
            50%  {background: blue;}
            100% {background: black;}
        }

        @keyframes myheader
        {
            from{background: black;}
            to{background: yellow;}
        }


        /*导航栏动画(出)*/
        @keyframes myNav
        {
            0%   {left:-20%;top:-6%;transform: rotate(-30deg);}
            25%  {left:-13%;top:-4%;transform: rotate(-20deg);}
            50%  {left:-6%;top:-2%;transform: rotate(-8deg);}
            100% {left:0%;top:0%;transform: rotate(0deg);}
        }

        /*导航栏动画(消失)*/
        @keyframes myNavVanish
        {
            0%    {left:5%;}
            100%   {left:-15%;}
            /*50%   {left:-6%;}*/
            /*100%  {left:-15%;}*/
        }

    </style>
    <div id="subject">
        <div id="primary" :style="contentStyleObj">
            <div class="title">
                <h1><a href="http://www.pudding.test">laravel学院</a></h1>
                <h2 class="header_title">php程序员</h2>
            </div>
            <canvas id="canvas">
            </canvas>
        </div>

        <div class="menu"  v-on:click="navControl" :style="menuStyleObj">
            <svg v-on:click="closeNav" viewBox="0 0 32 32" width="100%" height="100%">
                <path d="M30 18h-28c-1.1 0-2-0.9-2-2s0.9-2 2-2h28c1.1 0 2 0.9 2 2s-0.9 2-2 2zM30 6.25h-28c-1.1 0-2-0.9-2-2s0.9-2 2-2h28c1.1 0 2 0.9 2 2s-0.9 2-2 2zM2 25.75h28c1.1 0 2 0.9 2 2s-0.9 2-2 2h-28c-1.1 0-2-0.9-2-2s0.9-2 2-2z"></path>
            </svg>
            <span>
                &nbsp;menu
            </span>
        </div>
        <div :class="navClass"  :style="navStyleObj">
            <svg class="navClose" v-on:click="closeNav" version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M18.362 19.324c-0.902 0.902-2.363 0.902-3.263 0l-5.098-5.827-5.098 5.825c-0.902 0.902-2.363 0.902-3.263 0-0.902-0.902-0.902-2.363 0-3.263l5.304-6.057-5.306-6.061c-0.902-0.902-0.902-2.361 0-3.263s2.361-0.902 3.263 0l5.1 5.829 5.098-5.829c0.902-0.902 2.361-0.902 3.263 0s0.902 2.363 0 3.263l-5.304 6.061 5.304 6.057c0.902 0.902 0.902 2.363 0 3.265z"></path>
            </svg>
            <div class="hands">
                <a href="http://www.pudding.test"><img class="header_logo" src="/imgs/head.png" alt=""></a>
                <br>
                404 文章</br>
                404 评论</br>
                404 浏览</br>
                404 访客</br>
            </div>
            <div class="navCharacter">
                <span>ღゝ◡╹)ノ❤️</span>
            </div>
            <ul class="tag">
                <li>
                    <a href="/">首页</a>
                </li>
            </ul>
        </div>
    </div>
@stop
@section('js')
    <script>
        // const canvas = document.getElementById("canvas");
        // const ctx = canvas.getContext("2d");
        //
        // const WIDTH = document.documentElement.clientWidth;
        // const HEIGHT = document.documentElement.clientHeight;
        // let arr = [];
        // alert(document.body.clientWidth);
        var app=new Vue({ // 创建Vue对象。Vue的核心对象。
            el:'#subject', // el属性：把当前Vue对象挂载到 div标签上，#app是id选择器
            data(){    // data: 是Vue对象中绑定的数据
                return {
                    message:'hello Vue!', // message 自定义的数据
                    contentStyleObj:{           // 主窗口属性
                        height:'',
                        width:'',
                    },
                    menuStyleObj:{              // 菜单按钮属性
                        display: 'block',
                    },
                    navStyleObj:{               // 导航条属性
                        display: 'none',
                    },
                    navClass:'nav_1',
                    // height:document.documentElement.clientHeight+'px',

                    // 配置粒子属性
                    canvas: null,       // 画布
                    ctx: null,          // 画布
                    w: 0,               // 画布宽
                    h: 0,               // 画布高
                    circles: [],        // 粒子对象
                };
            },
            methods:{
                // 获取浏览器高度 宽度
                getHeight(){
                    // this.contentStyleObj.height=window.innerHeight-70+'px';
                    this.contentStyleObj.height=document.documentElement.clientHeight+'px';
                    this.contentStyleObj.width=document.documentElement.clientWidth+'px';
                },
                navControl() {      // 导航条属性
                    this.menuStyleObj.display= 'none';      // 隐藏菜单安按钮
                    this.navStyleObj.display= 'flex';      // 隐藏导航栏
                    this.navClass = 'nav_2';                // 为class添加属性
                },
                closeNav(){
                    this.menuStyleObj.display= 'block';      // 隐藏菜单安按钮
                    this.navClass = 'nav_3';                // 为class添加属性
                    // this.navStyleObj.display= 'none';       // 隐藏导航栏
                },

                // 存放粒子效果
                newobject(x, y) {
                    var object = new Object;    // 生成一个对象用于存放粒子信息
                    object.x = x;               // 粒子x坐标
                    object.y = y;               // 粒子y坐标
                    object.r = Math.random() * 3;       // 粒子半径
                    object._mx = Math.random();
                    object._my = Math.random();
                    this.circles.push(object)           // 为数组尾部添加一个粒子对象
                },
                // 创建粒子并添加颜色
                drawCircle(obj) {
                    this.ctx.beginPath();
                    this.ctx.arc(obj.x, obj.y, obj.r, 0, 360);
                    this.ctx.closePath();
                    this.ctx.fillStyle = 'rgba(204, 204, 204, 0.3)';
                    this.ctx.fill();
                },
                // 粒子路线   添加线条
                drawLine(obj1, obj) {
                    let dx = obj1.x - obj.x;
                    let dy = obj1.y - obj.y;
                    let d = Math.sqrt(dx * dx + dy * dy);
                    if (d < 60) {
                        this.ctx.beginPath();
                        this.ctx.lineWidth = 0.5;
                        this.ctx.moveTo(obj1.x, obj1.y); //start
                        this.ctx.lineTo(obj.x, obj.y); //end
                        this.ctx.closePath();
                        this.ctx.strokeStyle = 'rgba(204, 204, 204, 0.3)';
                        this.ctx.stroke();
                    }
                },
                // 移动 改变下一次动画粒子出现的位置
                move(obj) {
                    obj._mx = (obj.x < this.w && obj.x > 0) ? obj._mx : (-obj._mx);
                    obj._my = (obj.y < this.h && obj.y > 0) ? obj._my : (-obj._my);
                    obj.x += obj._mx / 2;
                    obj.y += obj._my / 2;
                },
                draw() {
                    this.ctx.clearRect(0, 0, this.w, this.h);               // 清理画布
                    // console.log(this.circles[i]);
                    for (let i = 0; i < this.circles.length; i++) {
                        this.move.call(this.circles[i], this.circles[i]);   // 使用call()方法改变move方法中this的指向 更改为circles[i]对象    设置移动
                        this.drawCircle.call(this.circles[i], this.circles[i]); // 使用call()方法改变drawCircle方法中this的指向 更改为circles[i]对象  创建粒子
                        for (let j = i + 1; j < this.circles.length; j++) {
                            this.drawLine.call(this.circles[i], this.circles[i], this.circles[j])
                        }
                    }
                    requestAnimationFrame(this.draw);
                },
                init(num) {
                    for (var i = 0; i < num; i++) {
                        this.newobject(Math.random() * this.w, Math.random() * this.h);
                    }
                    this.draw()
                },
            },

            mounted(){  // 生命周期执行初始化
                window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
                this.canvas = document.getElementById('canvas');
                this.ctx = canvas.getContext('2d');
                this.w = canvas.width = canvas.offsetWidth;     // 设置画布宽度
                this.h = canvas.height = canvas.offsetHeight;   // 设置画布高度
                this.init(180);

                // this.initCanvas();
                // this.init();
            },
            created(){
                window.addEventListener('resize', this.getHeight);
                this.getHeight()
            },

            destroyed(){
                window.removeEventListener('resize', this.getHeight)
            }
        })
    </script>
@stop
