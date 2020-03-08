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
            padding: 40px;
            background-color: #fdfff8;
            opacity: 0.6;
            border-radius: 5px;
            width: 25%;
            height: 50%;
            text-align: center;
        }

        .import{
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .enter{
            cursor:pointer;
            /* placeholder颜色  */
            color: #616161;
            /* placeholder字体大小  */
            font-size: 14px;
            /* placeholder位置  */
            text-align: center;
            background-color: #cacaca;
            border-radius: 5px;
            height: 50px;
            display: table;
            position: relative;
            bottom: -10%;
        }

        input{
            background:none;
            /*outline:none;*/
            border:1px solid #d4d4d4;
            height: 50px;
            padding: 0px 16px;
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

        .login_center{
            display:flex;
            flex-direction: column;
            justify-content:center;
        }

        .field_center{
            display: table-cell;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div id="main" :style="mainStyleObj">
        <div class="login">
            <div class="login_center">
                <h2 style="margin-bottom: 60px;">管理登录</h2>
                <input class="import" type="text" v-model="user" placeholder="请输入用户名">
                <input class="import" type="password" v-model="pwd" placeholder="请输入密码">
                <div class="enter" v-on:click="login"><div class="field_center">登录</div></div>
            </div>
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
                    // console.log('ceshi');
                    // 发送 POST 请求
                    axios({
                        method: 'post',
                        url: '/admin/register',
                        data: {
                            user: this.user,
                            pwd: this.pwd,
                        },
                        headers:{ '_token':'{{csrf_token()}}'},
                    }).then(function(data) {
                        console.log(data);
                        if(data.data.code == 200){
                            window.location.href="/admin/entire";
                        }else{
                            alert(data.data.msg);
                        }
                    }).catch(function (error) {
                        // console.log('失败');
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
