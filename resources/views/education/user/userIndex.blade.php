@extends('education.public')
@section('body')
    <div class="panel-heading">分类列表</div>
    <div class="panel-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    
                </th>
                <th>id</th>
                <th>用户昵称</th>
                {{--<th>头像</th>--}}
                <th>用户手机</th>
                <td>
                    操作
                </td>
            </tr>
            @foreach($info as $k=>$v)
            <tr uid="{{$v['uid']}}">
                <td><input type="checkbox"></td>
                <td>{{$v['uid']}}</td>
                <td>{{$v['username']}}</td>
                {{--<td>--}}
                    {{--<img src="/images/{{$v['avatar']}}" width="20%" height="100px" alt="">--}}
                {{--</td>--}}
                <td>{{$v['mobile']}}</td>
                <td>
                    <a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
                    <a href="/user/edit/{{$v['uid']}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href="javascript:;" class="del"><i class="fa fa-window-close delone" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="row foot">
        <div class="col-md-7">
            <button type="button" class="btn btn-link all">全选</button>
            /
            <button type="button" class="btn btn-link noall">反选</button>
            <a href="/user/add"><button type="button" class="btn btn-success">添加</button></a>
            <button type="button" class="btn btn-warning delMore">删除</button>
        </div>
        <div class="col-md-5">
            {{$info->links()}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        //单个删除
        $(".del").click(function(){
            var re=window.confirm('你确定要删除吗？');
            if(re){
                var uid=$(this).parents('tr').attr('uid');
                $.ajax({
                    url:"/user/del",
                    data:{uid:uid},
                    type:'get',
                    success:function(res){
                        if(res=="OK"){
                            alert('删除成功');
                            history.go(0)
                        }else{
                            alert('删除失败');
                        }
                    }
                })
            }
        })

        //多个删除
        $(document).on('click','.delMore',function () {
            var res=window.confirm('你确定要删除吗');

            var str='';
            if(res){
                $(":checkbox").each(function(){
                    if(this.checked){
                        str+=$(this).parents('tr').attr('uid')+",";
                        // that.parents('tr').remove();
                    };

                })
                var str=str.substr(0,str.length-1);

                //ajax传输
                $.ajax({
                    url:'/user/delMore',
                    data:{uid:str,_token:"{{csrf_token()}}"},
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