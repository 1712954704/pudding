<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>back</title>
    <script src="{{ asset('js/vue.js') }}"></script>
    <style>
        body{
            margin:0;
        }

        #main{
            background: url("/imgs/header-bg.jpg") no-repeat center;
            display: flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }

        .login{
            display: flex;
            flex-direction: column;
            border:1px solid #fdfff8;
            padding: 70px;
            background-color: #fdfff8;
            opacity: 0.6;
            border-radius: 5px;
        }

        .import{
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .enter{
            cursor:pointer;
            /* placeholder颜色  */
            color: #aab2bd;
            /* placeholder字体大小  */
            font-size: 14px;
            /* placeholder位置  */
            text-align: center;
            background-color: #cacaca;
        }

        input{
            background:none;
            outline:none;
            border:1px solid #b8ce6c;
        }
        input:focus{
            border:none;
        }

        input::-webkit-input-placeholder {
            /* placeholder颜色  */
            color: #aab2bd;
            /* placeholder字体大小  */
            font-size: 14px;
            /* placeholder位置  */
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="main" :style="mainStyleObj">
        <div class="login">
            <h2 style="margin-bottom: 60px;">后台管理系统</h2>
            <input class="import" type="text" v-model="user" placeholder="请输入用户名">
            <input class="import" type="text" v-model="pwd" placeholder="请输入密码">
            <a class="enter" v-on:click="login">登录</a>
        </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var back = new Vue({
            el: "#main",
            data(){
                return{
                    mainStyleObj:{
                        height:"",
                        width:"",
                    },
                    user:"",
                    pwd:"",
                }
            },
            methods:{
                // 获取浏览器高度 宽度
                getHeight(){
                    // this.contentStyleObj.height=window.innerHeight-70+'px';
                    this.mainStyleObj.height=document.documentElement.clientHeight+'px';
                    this.mainStyleObj.width=document.documentElement.clientWidth+'px';
                },
                login(){
                    // 发送 POST 请求
                    axios({
                        method: 'post',
                        url: '/admin/register',
                        data: {
                            user: this.user,
                            pwd: this.pwd,
                        },
                        headers:{ '_token':'{{csrf_token()}}'},
                    }).then(function(response) {
                        console.log(response);
                    }).catch(function (error) {
                        console.log(error);
                    });
                },
            },
            created(){
                window.addEventListener('resize', this.getHeight);
                this.getHeight()
            },

            destroyed(){
                window.removeEventListener('resize', this.getHeight)
            }
        });
    </script>
</body>
</html>