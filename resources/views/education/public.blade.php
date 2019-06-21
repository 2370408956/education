<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @yield('link')
    <link rel="stylesheet" href="/statics/css/bootstrap.css">
    <link rel="stylesheet" href="/css/other.css">
    <link rel="stylesheet" href="/statics/css/font-awesome.min.css">

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nv class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">后台管理系统</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">视频</a></li>
                            <li><a href="#">文章</a></li>
                            <li><a href="#">赞助我们</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">个人操作<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">个人中心</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">修改密码</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </div>
        </nv>
    </div>
    <div class="row">
        <div class="list-group content col-md-4 col-md-offset-1">
            {{--<a href="/education/direction" class="list-group-item"><img src="/statics/images/课程方向.png"  class='list' alt="">课程类型</a>--}}
            <a href="/cate/index" class="list-group-item"><img src="/statics/images/cate.png" class='list' alt="">分类管理</a>
            <a href="/curriculum/index" class="list-group-item"><img src="/statics/images/课程.png" class='list' alt="">课程管理</a>
            <a href="/chapter/index" class="list-group-item"><img src="/statics/images/章节.png" class='list' alt="">章节管理</a>
            {{--<a href="/education/video" class="list-group-item"><img src="/statics/images/视频.png" class='list' alt="">视频管理</a>--}}
            <a href="/user/index" class="list-group-item"><img src="/statics/images/用户.png" class='list' alt="">用户管理</a>
        </div>
        <div class="content col-md-6 ">
            <div class="panel panel-default">
                @yield('body')
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="/statics/js/jquery-3.2.1.min.js"></script>
<script src="/statics/js/bootstrap.js"></script>
<script src="/statics/js/other.js"></script>
@yield('js')