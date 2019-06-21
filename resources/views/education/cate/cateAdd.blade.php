@extends('education.public')
@section('body')
    <div class="panel-heading">分类添加</div>
    <div class="panel-body">
        <form action="{{url('cate/addDo')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="catname" class="form-control" >
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">选择分类</label>
                <select class="form-control" name="type" id="changeCate">
                    <option value="1">一级分类</option>
                    <option selected value="2">二级分类</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">顶级分类</label>
                <select class="form-control" name="cateid" id="topCate">
                    @foreach($arr as $v)
                    <option value="{{$v['cateid']}}">{{$v['catname']}}</option>
                    @endforeach
                </select>
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
        $("#changeCate").change(function(){
            var val=$(this).val();
            if(val==1){
                $("#topCate").hide();
            }else{
                $("#topCate").show();
            }
        })
    </script>
@endsection