@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>

    <div class="panel-body">
        <form action="{{url('curriculum/editDo')}}" method="post">
            @csrf
            <input type="hidden" value="{{$cinfo['cid']}}" name="cid">
            <div class="form-group">
                <label for="exampleInputEmail1">课程名称</label>
                <input type="text" class="form-control" value={{$cinfo['cname']}} name="cname" id="exampleInputEmail1" placeholder="课程名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">顶级分类</label>
                <select class="form-control" name="topcateid"  id="topCate">
                    <option value="0">--请选择--</option>
                    @foreach($cateinfo as $k=>$v)
                        @if($cinfo['topcateid']==$v['cateid'])
                            <option value="{{$v['cateid']}}" selected>{{$v['catname']}}</option>
                        @else
                            <option value="{{$v['cateid']}}">{{$v['catname']}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">二级分类</label>
                <select class="form-control" name="cateid" id="secondSelect">
                    <option value="0">请选择</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">选择难度</label>
                <select class="form-control" name="degree">
                    <option value="1" @if($cinfo['degree']=='入门')selected @endif>入门</option>
                    <option value="2" @if($cinfo['degree']=='初级')selected @endif>初级</option>
                    <option value="3" @if($cinfo['degree']=='中级')selected @endif>中级</option>
                    <option value="4" @if($cinfo['degree']=='高级')selected @endif>高级</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课前准备</label>
                <input type="text" class="form-control" value="{{$cinfo['prepare']}}" name="prepare" id="exampleInputEmail1" placeholder="课前准备">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课程简介</label>
                <textarea class="form-control"  name="intro" rows="3">{{$cinfo['intro']}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课程知识</label>
                <textarea class="form-control"  name="knowledge" rows="3">{{$cinfo['knowledge']}}</textarea>
            </div>

            <div class="checkbox">
                <label>
                    @if($cinfo['status']=='展示')
                        <input type="checkbox" name="status" value="1" checked> 是否展示
                    @else
                        <input type="checkbox" name="status" value="1" > 是否展示
                    @endif
                </label>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        var cateid='{{$cinfo['topcateid']}}';
        $.ajax({
            url:"/cate/getSonInfo",
            data:{cateid:cateid,_token:'{{csrf_token()}}'},
            type:'post',
            dataType:'json',
            success:function(res){
                var str= '<option value="0">请选择</option>';
                for (var i in res){
                    if('{{$cinfo['cateid']}}'==res[i]['cateid']){
                        str+="<option value="+res[i]['cateid']+" selected>"+res[i]['catname']+"</option>"
                    }else{
                        str+="<option value="+res[i]['cateid']+">"+res[i]['catname']+"</option>"
                    }

                }
                $("#secondSelect").html(str);
            }
        });
        $(function(){
            $("#topCate").change(function () {
                var cateid=$(this).val();
                $.ajax({
                    url:"/cate/getSonInfo",
                    data:{cateid:cateid,_token:'{{csrf_token()}}'},
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        // console.log(res)
                        var str= '<option value="0">请选择</option>';
                        for (var i in res){
                            str+="<option value="+res[i]['cateid']+">"+res[i]['catname']+"</option>"
                        }
                        $("#secondSelect").html(str);
                    }
                })
            })
        })

    </script>
@endsection