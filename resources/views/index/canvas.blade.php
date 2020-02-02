<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>canvas--随机粒子</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
            background-color:#000;
        }
    </style>
</head>

<body>

<canvas id='canvas'></canvas>

<script>

    const canvas = document.getElementById("canvas");


    const ctx = canvas.getContext("2d");

    const WIDTH = document.documentElement.clientWidth;
    const HEIGHT = document.documentElement.clientHeight;

    canvas.width = WIDTH;
    canvas.height = HEIGHT;


    // 创建粒子对象

    function Particle(x, y) {
        this.symbol = Symbol();//粒子标识 确保每个粒子不一样
        this.x = x;//x坐标
        this.y = y;//y坐标
        this.r = (Math.random() * 20) + 1;//半径
        let cr = Math.random() * 256;
        let cg = Math.random() * 256;
        let cb = Math.random() * 256;
        let alpha = (Math.floor(Math.random() * 10) + 1) / 10; //0.05-0.5 透明度--为了好看
        this.color = `rgba(${cr},${cg},${cb},${alpha})`;//颜色
    }

    //Particle原型上添加绘制方法 draw

    Particle.prototype.draw = function () {

        //开始新路径
        ctx.beginPath();
        //画⚪ x,y坐标 r半径 起始弧度 结束弧度
        ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI);
        //闭合路径
        ctx.closePath();
        //填充样式
        ctx.fillStyle = this.color;
        //模糊程度
        ctx.shadowBlur = this.r * 2;
        //填充
        ctx.fill();

    }



    // 通过改变粒子纵坐标位置 模拟粒子升降
    Particle.prototype.move = function (step=1.5) {
        this.y -= step;//运动速度
        //看不见了就再来一次
        if (this.y <= -10) {
            this.y = HEIGHT + 10;
        }
        //重绘
        this.draw();
    }
    let arr = [];

    function init(len = 100) {

        for (let i = 0; i < len; i++) {
            //填充粒子数组
            arr[i] = new Particle(Math.random() * WIDTH, Math.random() * HEIGHT);
            //批量绘制
            arr[i].draw();
        }
        console.log(arr);
        // console.log(Particle.prototype.move);
        animate();
    }


    // 粒子一起动起来
    function animate() {

        //每次运动前清空画布
        ctx.clearRect(0, 0, WIDTH, HEIGHT);

        arr.forEach(item => {

            item.move();

        })

        requestAnimationFrame(animate);
    }


    init();



</script>
</body>

</html>