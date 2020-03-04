<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a {
            color: #212121;
            text-shadow: none;
            text-decoration:none;
        }
        a:hover{
            color: #00A1D6;
        }
        input {
            background: none;
            outline: none;
            border: none;
        }

        #top{
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            background: #fff;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
        }
        .top_interval{
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
        }
        .nav_search{
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 500px;
            transition: 0.3s width;
        }
        .top_interval li{
            list-style-type:none;
            margin-right: 26px;
        }
        #nav_fromsearch{
            background: #F4F4F4;
            border: 1px solid #E7E7E7;
            display: block;
            padding: 0 38px 0 16px;
        }
        #nav_fromsearch input{
            height: 34px;
        }

        /*会员头像*/
        .head_img{
            width: 26px;
            height: 24px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div id="top">
    <div>
        <ul class="top_interval">
            <li>
                <a href="">bilibili</a>
            </li>
            <li>
                <a href="">游戏</a>
            </li>
            <li>
                <a href="">小说</a>
            </li>
            <li>
                <a href="">漫画</a>
            </li>
            <li>
                <a href="">番剧</a>
            </li>
        </ul>
    </div>
    <div class="nav_search">
        <from id="nav_fromsearch">
            <input type="text" placeholder="请输入">
        </from>
    </div>
    <div>
        <ul class="top_interval">
            <li>
                <div>
                    <img class="head_img" src="/imgs/home_index/head.webp" alt="">
                </div>
            </li>
            <li>
                <a href="">会员</a>
            </li>
            <li>
                <a href="">消息</a>
            </li>
            <li>
                <a href="">动态</a>
            </li>
            <li>
                <a href="">收藏</a>
            </li>
            <li>
                <a href="">历史</a>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
