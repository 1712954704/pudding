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
        /*height:30%;*/
        height:100%;
        width:100%;
    }

    #wrapper{       /*书页*/
        display:flex;
        max-width: 892px;
        margin: 0 auto;
        padding: 0 10px;
        height: 800px;
    }

    #ribbon{
        position: absolute;
        height:100%;
        width:100%;
        z-index: -1;
    }

    #article{       /*文章*/
        /*margin: auto;*/
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
<div id="total">
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
    <div>
        <canvas id="ribbon">
        </canvas>
        <div id="wrapper">
            <div id="article">
                <p>测试居中</p>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    var app=new Vue({ // 创建Vue对象。Vue的核心对象。
        // el:'#subject', // el属性：把当前Vue对象挂载到 div标签上，#app是id选择器
        el:'#total', // el属性：把当前Vue对象挂载到 div标签上，#app是id选择器
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
                ctx: null,          // 画布2d
                w: 0,               // 画布宽
                h: 0,               // 画布高
                color: '',          // 粒子颜色
                step:0.5,           // 移动速度
                circles: [],        // 盛放粒子对象的数组

                // 配置彩带属性
                ribbon : null,      // 设置画布
                ribbonCtx:null,     // 设置画布属性2d
                ribbonW: 0,         // 画布宽
                ribbonH:0,          // 画布高
                ribbonColor: '',    // 彩带颜色
                ribbonStep: 150,     // 彩带移动速度
                ribbonVertical:200,  // 彩带上下幅度
                trigons: [],        // 盛放彩带对象的数组
                direction:null,     // 彩带方向
                length: 18,         // 彩带长度
                // mycars:[],       // 盛放点
                number:3,           // 彩带数量
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
            Particle(x,y){
                var object = new Object();      // 生成一个对象保存粒子属性
                object.x = x;              // 粒子x坐标
                object.y = y;              // 粒子y坐标
                object.r = Math.random()*6;     // 粒子半径
                let cr = Math.random() * 256;
                let cg = Math.random() * 256;
                let cb = Math.random() * 256;
                let alpha = (Math.floor(Math.random() * 10) + 1) / 10; //0.05-0.5 透明度--为了好看
                this.color = `rgba(${cr},${cg},${cb},${alpha})`;//颜色
                object.color = this.color;      // 存储粒子颜色
                this.circles.push(object);
            },
            // 创建粒子并添加颜色
            drawCircle(obj) {
                // console.log(obj.y);
                this.ctx.beginPath();
                this.ctx.arc(obj.x, obj.y, obj.r, 0, 2 * Math.PI);
                this.ctx.closePath();
                // this.ctx.fillStyle = 'rgba(204, 204, 204, 0.3)';
                this.ctx.fillStyle = obj.color;
                this.ctx.fill();
            },
            move(obj){     // 修改每次粒子移动的位置
                // console.log(this);
                obj.y = obj.y - this.step;
                if(obj.y <= -10){
                    obj.y = this.h+10;
                }
                // this.draw();    // 重绘
            },
            draw(){
                this.ctx.clearRect(0 ,0, this.w, this.h);   // 清理画布
                for(var i=0;i<this.circles.length;i++){
                    this.move.call(this.circles[i],this.circles[i]);    // 使用call() 改变this对象  改变圆的坐标
                    this.drawCircle(this.circles[i],this.circles[i]);   //  绘制圆
                }
                requestAnimationFrame(this.draw);
            },
            init(num){
                for(var i = 0;i < num;i++){
                    this.Particle(Math.random()*this.w,Math.random()*this.h);
                }
                this.draw();
            },
            // *****************************************************************************************************
            begin(){      // 初始化生成彩带
                console.log(this.trigons);
                for(var i=0;i<this.number;i++){
                    if(Math.random() > 0.5){
                        this.ribbons(0,Math.random()*this.ribbonH);
                    }else{
                        this.ribbons(this.ribbonW,Math.random()*this.ribbonH);
                    }
                }
                this.sketch();
            },
            ribbons(x,y){       // 生成彩带对象,并保存参数
                if(x == 0){
                    this.direction = 1;
                }else{
                    this.direction = -1;
                }
                var object = new Object();
                // 三角形必须存储 三个点
                object.x = x;
                object.y = y;
                // object.x1 = x;
                // object.x1 = 0;
                object.x1 = x - Math.random() *50;
                object.y1 = y - Math.random() * 30;
                object.direction = this.direction; // 存储彩带方向
                object.arr = [];        // 存储点
                let cr = Math.random() * 256;
                let cg = Math.random() * 256;
                let cb = Math.random() * 256;
                let alpha = (Math.floor(Math.random() * 10) + 1) / 10; //0.05-0.5 透明度--为了好看
                this.ribbonColor = `rgba(${cr},${cg},${cb},${alpha})`;//颜色
                object.color = this.ribbonColor;      // 存储粒子颜色
                this.trigons.push(object);
            },
            sketch(){       // 清理画布并生成图像
                this.ribbonCtx.clearRect(0 ,0, this.ribbonW, this.ribbonH);   // 清理画布
                for(var i=0;i<this.trigons.length;i++){
                    this.shift.call(this.trigons[i],this.trigons[i]);    // 使用call() 改变this对象  改变圆的坐标
                    this.sketchRibbons(this.trigons[i],this.trigons[i]);   //  绘制圆
                }
                requestAnimationFrame(this.sketch);
                // requestAnimationFrame(this.begin);
            },
            shift(obj){     // 移动轨迹
                var mycars = [];
                mycars.splice(0,mycars.length);
                if(obj.y1 > this.ribbonH){
                    obj.y1 = this.ribbonH;
                }else if(obj.y1 < 0){
                    obj.y1 = 0;
                }
                // 判断移动轨迹
                if(obj.direction == 1){
                    // 到达顶点
                    if(obj.x > this.ribbonW){
                        obj.arr.splice(0,1);
                        obj.x = 0;
                        obj.y = this.ribbonH*Math.random();
                        obj.x1 = obj.x - Math.random() * 50;
                        obj.y1 = obj.y - Math.random() * 30;

                        let cr = Math.random() * 256;
                        let cg = Math.random() * 256;
                        let cb = Math.random() * 256;
                        let alpha = (Math.floor(Math.random() * 10) + 1) / 10; //0.05-0.5 透明度--为了好看
                        obj.color = `rgba(${cr},${cg},${cb},${alpha})`;
                    }else {
                        mycars.push([ obj.x , obj.y]);
                        mycars.push([ obj.x1 , obj.y1]);
                        // 替换第一点
                        obj.x = obj.x1;
                        obj.y = obj.y1;

                        // console.log(obj);
                        // console.log("*************************");
                        obj.x1 = obj.x + Math.random() *this.ribbonStep;
                        if (Math.random() > 0.5) {
                            obj.y1 = obj.y + Math.random() * this.ribbonVertical;
                        } else {
                            obj.y1 = obj.y - Math.random() * this.ribbonVertical;
                        }
                        mycars.push( [ obj.x1 , obj.y1]);
                        obj.arr.push(mycars);
                    }
                }else{
                    // 到达顶点
                    if(obj.x < 0){
                        obj.arr.splice(0,1);
                        obj.x = this.ribbonW;
                        obj.y = this.ribbonH*Math.random();
                        obj.x1 = obj.x - Math.random() * 50;
                        obj.y1 = obj.y - Math.random() * 30;

                        let cr = Math.random() * 256;
                        let cg = Math.random() * 256;
                        let cb = Math.random() * 256;
                        let alpha = (Math.floor(Math.random() * 10) + 1) / 10; //0.05-0.5 透明度--为了好看
                        obj.color = `rgba(${cr},${cg},${cb},${alpha})`;
                    }else{
                        // obj.x1 = obj.x - Math.random() *50;
                        mycars.push([ obj.x , obj.y]);
                        mycars.push([ obj.x1 , obj.y1]);

                        // 替换第一点
                        obj.x = obj.x1;
                        obj.y = obj.y1;

                        obj.x1 = obj.x - Math.random() *this.ribbonStep;
                        if (Math.random() > 0.5) {
                            obj.y1 = obj.y + Math.random() * this.ribbonVertical;
                        } else {
                            obj.y1 = obj.y - Math.random() * this.ribbonVertical;
                        }
                        mycars.push( [ obj.x1 , obj.y1]);

                        // mycars.push([ obj.x , obj.y]);
                        // for(var i = 1; i < 3 ;i++){
                        //     obj.x = obj.x - Math.random() *this.ribbonStep;
                        //     if(Math.random() > 0.5){
                        //         obj.y = obj.y + Math.random()*this.ribbonVertical;
                        //     }else{
                        //         obj.y = obj.y - Math.random()*this.ribbonVertical;
                        //     }
                        //     mycars.push([ obj.x , obj.y]);
                        // }
                        obj.arr.push(mycars);
                    }
                }
                if (obj.arr.length > this.length && obj.arr.length > 1){
                    obj.arr.splice(0,1);
                }
            },
            sketchRibbons(obj){     // 画线
                for(var i = 0;i < obj.arr.length; i++){
                    this.ribbonCtx.strokeStyle = obj.color;
                    this.ribbonCtx.beginPath();
                    this.ribbonCtx.lineTo(obj.arr[i][0][0],obj.arr[i][0][1]);
                    this.ribbonCtx.lineTo(obj.arr[i][1][0],obj.arr[i][1][1]);
                    this.ribbonCtx.lineTo(obj.arr[i][2][0],obj.arr[i][2][1]);
                    // this.ribbonCtx.fillStyle = 'rgba(204, 204, 204, 0.3)';
                    this.ribbonCtx.fillStyle = obj.color;
                    this.ribbonCtx.fill();
                    this.ribbonCtx.stroke();
                }
            }
        },

        mounted(){  // 生命周期执行初始化
            // 生成粒子效果
            this.canvas = document.getElementById('canvas');
            this.ctx = this.canvas.getContext('2d');
            this.w = this.canvas.width = this.canvas.offsetWidth;     // 设置画布宽度
            this.h = this.canvas.height = this.canvas.offsetHeight;   // 设置画布高度
            this.init(180);

            // 生成彩带效果
            this.ribbon = document.getElementById('ribbon');
            this.ribbonCtx = this.ribbon.getContext('2d');
            this.ribbonW = this.ribbon.width = this.ribbon.offsetWidth;     // 设置画布宽度
            this.ribbonH = this.ribbon.height = this.ribbon.offsetHeight;   // 设置画布高度
            this.begin();
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
