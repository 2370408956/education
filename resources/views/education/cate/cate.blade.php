@extends('education.public')
@section('link')
<link rel="stylesheet" href="/statics/css/jquery.treeview.css">
<link rel="stylesheet" href="/statics/css/screen.css">
@endsection
@section('body')
<div class="panel-heading">
    分类列表
    /
    <a href="/cate/add">添加分类</a>
</div>

<div class="panel-body">

    <ul id="browser" class="filetree treeview-famfamfam">
        @foreach($info as $k=>$v)
        <li><span class="folder">{{$v['catname']}}</span>
            <ul>
                @foreach($v['son'] as $val)
                    <li class="hang">
                        <span class="file">{{$val['catname']}}</span>

                        <div style="float: right">
                            <a href="/curriculum/index/{{$val['cateid']}}" title="查看课程"><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
                            <a href="/cate/edit/{{$val['cateid']}}" title="修改分类"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a class="delcate" cateid="{{$val['cateid']}}" title="删除" ><i class="fa fa-window-close" aria-hidden="true"></i></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>

    {{--<div class="panel-body">--}}
        {{--<table class="table table-hover table-bordered filetree treeview-famfamfam">--}}
            {{--<tr>--}}
                {{--<th class="hang">--}}

                {{--</th>--}}
                {{--<th>id</th>--}}
                {{--<th>方向名称</th>--}}
                {{--<td>--}}
                    {{--操作--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td><input type="checkbox"></td>--}}
            {{--<td>1</td>--}}
            {{--<td>前端</td>--}}
            {{--<td>--}}
            {{--<a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>--}}
            {{--<a href="/cate/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
            {{--<a href="javascript:;"><i class="fa fa-window-close delone" aria-hidden="true"></i></a>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td><input type="checkbox"></td>--}}
            {{--<td>2</td>--}}
            {{--<td>后端</td>--}}
            {{--<td>--}}
            {{--<a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>--}}
            {{--<a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
            {{--<a href="javascript:;"><i class="fa fa-window-close delone" aria-hidden="true"></i></a>--}}
            {{--</td>--}}
            {{--</tr>--}}
        {{--</table>--}}
    {{--</div>--}}


</div>
<div class="row foot">
    <div class="col-md-3 col-md-offset-1">
        {{--<button type="button" class="btn btn-link all">全选</button>--}}
        {{--/--}}
        {{--<button type="button" class="btn btn-link noall">反选</button>--}}
        {{--<a href="/cate/add"><button type="button" class="btn btn-success">添加</button></a>--}}
        {{--<button type="button" class="btn btn-warning del">删除</button>--}}
    </div>
    {{--<div class="col-md-5">--}}
        {{--<nav aria-label="Page navigation">--}}
            {{--<ul class="pagination">--}}
                {{--<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>--}}
                {{--<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li ><a href="">2 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li ><a href="#">3 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li ><a href="#">4 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li ><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>--}}
            {{--</ul>--}}
        {{--</nav>--}}
    {{--</div>--}}
</div>
@endsection
@section('js')
<script src="/statics/js/jquery.treeview.js"></script>
<script src="/statics/js/jquery.cookie.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#browser").treeview({
            toggle: function() {
                console.log("%s was toggled.", $(this).find(">span").text());
            }
        });
    });

    $(".delcate").click(function(){
        $re=window.confirm('你确定要删除吗？');
        if($re){
            var cateid=$(this).attr('cateid');
            $.ajax({
                url:'/cate/del',
                data:{cateid:cateid,_token:'{{csrf_token()}}'},
                type:'post',
                success:function (res) {
                    if(res=='ok'){
                        alert('删除成功');
                        history.go(0);
                    }else{
                        alert('删除失败');
                    }
                }
            })
        }
        return false;
    })
</script>
@endsection
