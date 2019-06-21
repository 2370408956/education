@extends('education.public')
@section('body')
    <div class="panel-heading">章节列表</div>
    <div class="panel-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th>

                </th>
                <th>id</th>
                <th>章节名称</th>
                <td>type</td>
                <th>所属章节</th>
                <th>
                    操作
                </th>
            </tr>
            @foreach($arr as $k=>$v)
                <tr chapterid="{{$v['chapterid']}}">
                    <td><input type="checkbox"></td>
                    <th>{{$v['chapterid']}}</th>
                    <td>{{$v['chaptername']}}</td>
                    <td>{{$v['type']}}</td>
                    <td>{{$chaptername}}</td>

                    <td>
                        <a href="/chapter/knobbleList/{{$v['chapterid']}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
                        <a href="/chapter/edit/{{$v['chapterid']}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="javascript:;" class="delOne"><i class="fa fa-window-close delone" aria-hidden="true"></i></a>
                        @if($v['type']=='章')
                            <a href="/chapter/index/{{$v['chapterid']}}" title="查看小节"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @else

                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="row foot">
        <div class="col-md-7">
            &nbsp;
            <button type="button" class="btn btn-success back">返回</button>
            <button type="button" class="btn btn-link all">全选</button>
            /
            <button type="button" class="btn btn-link noall">反选</button>
            <a href="/chapter/add"><button type="button" class="btn btn-success">添加</button></a>
            <button type="button" class="btn btn-warning del">删除</button>
        </div>
        <div class="col-md-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li ><a href="">2 <span class="sr-only">(current)</span></a></li>
                    <li ><a href="#">3 <span class="sr-only">(current)</span></a></li>
                    <li ><a href="#">4 <span class="sr-only">(current)</span></a></li>
                    <li ><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //单个删除
        $(".delOne").click(function(){
            var res=window.confirm('你确定要删除吗?');
            var chapterid=$(this).parents('tr').attr('chapterid');
            if(res){
                $.ajax({
                    url:'/chapter/del',
                    data:{chapterid:chapterid,_token:'{{csrf_token()}}'},
                    type:'post',
                    success:function (res) {
                        if(res=='OK'){
                            alert('删除成功');
                            history.go(0);
                        }else{
                            alert('删除失败');
                        }
                    }
                })
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