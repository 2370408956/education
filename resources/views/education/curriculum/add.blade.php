@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>

    <div class="panel-body">
        <form action="{{url('curriculum/addDo')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">课程名称</label>
                <input type="text" class="form-control" name="cname" id="exampleInputEmail1" placeholder="课程名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">顶级分类</label>
                <select class="form-control" name="topcateid"  id="topCate">
                    <option value="0">--请选择--</option>
                    @foreach($cateinfo as $k=>$v)
                    <option value="{{$v['cateid']}}">{{$v['catname']}}</option>
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
                    <option value="1">入门</option>
                    <option value="2">初级</option>
                    <option value="3">中级</option>
                    <option value="4">高级</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课前准备</label>
                <input type="text" class="form-control" name="prepare" id="exampleInputEmail1" placeholder="课前准备">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课程简介</label>
                <textarea class="form-control" name="intro" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课程知识</label>
                <textarea class="form-control" name="knowledge" rows="3"></textarea>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="status" value="1" checked> 是否展示
                </label>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
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
    </script>
@endsection