@extends('education.public')
@section('body')
<div class="panel-heading">
    @if(!isset($arr[0]['catname']))
        <a href="/curriculum/index">查看所有课程</a>
        @else
        <a href="/curriculum/index">查看所有课程</a>
        /
        <a href="javascript:;">{{$arr[0]['catname']}}</a>
    @endif
</div>
<div class="panel-body">
    <table class="table table-hover table-bordered">
        <tr>
            <th>
                
            </th>
            <th>课程id</th>
            <th>课程名称</th>
            <th>所属分类</th>
            <th>录制者</th>
            <th>难度</th>
            <th>章节数</th>
            <th>
                操作
            </th>
        </tr>
        @foreach($arr as $k=>$v)
        <tr cid="{{$v['cid']}}">
            <td><input type="checkbox"></td>
            <th>{{$v['cid']}}</th>
            <td>{{$v['cname']}}</td>
            <td>{{$v['catname']}}</td>
            <td>川川</td>
            <td>{{$v['degree']}}</td>
            <td>{{$v['chapters']}}</td>
            <td>
                {{--<a href="" title="查看"><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>--}}
                <a href="/curriculum/edit/{{$v['cid']}}" title="查看/修改"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href="javascript:;" title="删除"><i class="fa fa-window-close delone" aria-hidden="true"></i></a>
                <a href="/chapter/add" title="添加章节"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                <a href="/education/chapter" title="查看章节"><i class="fa fa-eye" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="row">
    <div class="col-md-7">
        <button type="button" class="btn btn-link all">全选</button>
        /
        <button type="button" class="btn btn-link noall">反选</button>
        <a href="/curriculum/add"><button type="button" class="btn btn-success">添加</button></a>
        <button type="button" class="btn btn-warning del">删除</button>
    </div>
    <div class="col-md-5">
        {{$arr->links()}}
    </div>
</div>
@endsection
@section('js')
    <script>
        //单个删除
        $(document).on('click','.delone',function(){
            var res=window.confirm('你确定要删除吗');
            var that=$(this);
            if(res){
                var cid=$(this).parents('tr').attr('cid');
                $.ajax({
                    url:"/curriculum/del",
                    data:{cid:cid,_token:"{{csrf_token()}}"},
                    type:'post',
                    success:function(res){
                        if(res=='OK'){
                            alert('删除成功');
                            that.parents('tr').remove();
                        }else{
                            alert('删除失败');
                        }
                    }
                });

            }
        })

        //多个删除
        $(document).on('click','.del',function () {
            var res=window.confirm('你确定要删除吗');

            var str='';
            if(res){
                $(":checkbox").each(function(){
                    if(this.checked){
                        str+=$(this).parents('tr').attr('cid')+",";
                        // that.parents('tr').remove();
                    };

                })
                var str=str.substr(0,str.length-1);

                //ajax传输
                $.ajax({
                    url:'/curriculum/delMore',
                    data:{cid:str,_token:"{{csrf_token()}}"},
                    type:'post',
                    success:function(res){
                        console.log(res=='OK');
                        if(res=='OK'){
                            alert('删除成功');
                            history.go(0);
                        }else{
                            alert('删除失败');
                        }
                    }
                })
            }

        });

    </script>
@endsection