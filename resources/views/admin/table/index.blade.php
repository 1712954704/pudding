@extends("admin.entire.index")
@section('title','表格')
@section('style')
    {{--阿里样式--}}
    .icon {
    width: 2em;
    height: 1em;
    vertical-align: -0.15em;
    fill: currentColor;
    overflow: hidden;
    }
    a {
        color: #212121;
        text-shadow: none;
        text-decoration:none;
        margin: auto;
        white-space: nowrap;
        font-size: 14px;
        text-decoration: none;
    }
    a:hover{
        color: #00A1D6;
    }
    .body{
    display:flex;
    flex-direction:column;
    margin:auto;
    max-width: 90%;
    }

    .self_inner{
    background-image:url("/imgs/home_index/self_bg.png");
    width: 90%;
    height: 200px;
    background-repeat: no-repeat;
    }

    .table_content{
        display:flex;
        flex-direction: row;
        width:90%;
        background: #fff;
        box-shadow: 0 0 0 1px #eee;
        border-radius: 4px;
        margin: 10px 0 0 0;
    }
    .table_lft{
        display:flex;
        flex-direction: column;
        width: 20%;
        border-right: 1px solid #eee;
    }
    .table_rgt{
        display: flex;
        flex-direction: column;
        width:80%;
    }
    .lft_folder{
        height: 54px;
        padding-left: 19px;
        line-height: 54px;
        font-size: 14px;
        color: #99a2aa;
    }
    .lft_folders{
        height: 54px;
        padding-left: 19px;
        line-height: 54px;
        font-size: 14px;
        color: #222;
        cursor: pointer;
    }
    .rgt_top{
        display:flex;
        flex-direction: row;
        padding: 20px 0;
        margin: 0 20px;
        box-sizing: border-box;
        border-bottom: 1px solid #e5e9ef;
    }
    .rgt_img{
        height: 119px;
        object-fit: cover;
        object-position: 50%;
        border-radius: 4px
    }
    .rgt_default{
        margin-left: 18px;
    }
    .rgt_default_name{
        display: block;
        margin-bottom: 14px;
    }
    .rgt_default_infor{
        display: flex;
        flex-direction: column;
        font-size: 12px;
        color: #99a2aa;
    }
    .infor_name{
        vertical-align: middle;
    }
    .rgt_detail{
        width: 120px;
        height: 32px;
        background: #00a1d6;
        border-radius: 2px;
        font-size: 14px;
        color: #fff;
        line-height: 32px;
        text-align: center;
        margin-right: 42px;
        cursor: pointer;
        position: absolute;
        bottom: 0;
    }
    .rgt_handle{
        display: flex;
        flex-direction: row-reverse;
    }
    .rgt_search{
        display:flex;
        height: 28px;
        margin: 0;
        border: 1px solid #ccd0d7;
        border-radius: 14px;
        white-space: nowrap;
        margin: 0 36px 0 0;
    }
    .rgt_search_color{
        height: 28px;
        margin: 0;
        border: 1px solid #ccd0d7;
        border-radius: 14px;
        white-space: nowrap;
        border-color:#00a1d6;
    }
    .rgt_search:focus-within{
        border-color:#00a1d6;
    }
    .choice{
        display: inline-block;
        position: relative;
        vertical-align: middle;
        padding: 0 0 0 6px;
        width: 16%;
        overflow: hidden;
        color: #555;
        text-shadow: none;
        transition: box-shadow 0.25s ease;
        z-index: 2;
        text-align: center;
        border-right: 1px solid #ccd0d7
    }
    .choice:hover{
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
    }
    choice:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border: 10px solid transparent;
        border-top-color: #ccc;
        top: 14px;
        right: 10px;
        cursor: pointer;
        z-index: -2;
    }
    .choice select{
        cursor: pointer;
        width: 100%;
        border: none;
        background: transparent;
        background-image: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    .choice select:focus {
        outline: none;
    }
    .import{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .rgt_table{
        margin: 20px 20px 20px;
    }
    .small_item{
        padding: 0;
        margin: 0 20px 20px 0;
        border-radius: 4px;
        border: 1px solid #fff;
        box-sizing: border-box;
        width:17%;
        {{--width: 190px;--}}
        float: left;
    }
    .small_item a img{
      width: 100%;
    }
@stop
@section('content')
    <div class="body" id="table">
        <div class="self_inner">
        </div>
        {{--表格内容--}}
        <div class="table_content">
            <div class="table_lft">
                <div class="lft_folder">
                    <span>我的文件夹</span>
                </div>
                <div class="lft_folders">
                    <span>新建文件夹</span>
                </div>
                <div class="lft_folders">
                    <a>默认文件夹</a>
                </div>
            </div>
            <div class="table_rgt">
                <div class="rgt_top">
                    <img src="/imgs/back/1.jpg" alt="" class="rgt_img">
                    <div class="rgt_default">
                        <a href="" class="rgt_default_name">默认收藏夹</a>
                        <div class="rgt_default_infor">
                            <span class="infor_name">创建者:徐振</span>
                            <span>0个内容 &nbsp; · &nbsp; 公开</span>
                            <div class="rgt_detail">
                                <span href="">查看全部</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rgt_handle">
                    <div class="rgt_search">
                        <div class="choice">
                            <select name="" id="">
                                <option value="1">当前</option>
                                <option value="2">所有</option>
                            </select>
                        </div>
                        <div class="import">
                            <input type="text" placeholder="输入关键词" style="margin: 0px 0px 0 3px;">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-sousuo2"></use>
                            </svg>
                        </div>
                    </div>
                    <span><a href="">批量操作</a></span>
                </div>
                <div class="rgt_table">
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="small_item">
                        <a href="">
                            <img src="/imgs/back/1.jpg" alt="">
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    var app = new Vue({
        el : '#table',
        data(){
            return {
            };
        },
        methods:{
        }
    })
@stop
