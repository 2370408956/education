@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>
    <div class="panel-body">
        <form action="{{url('cate/editDo')}}" method="post">
            @csrf
            <input type="hidden" name="cateid" value="{{$arr['cateid']}}">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" class="form-control" name="catname" value={{$arr['catname']}} id="exampleInputEmail1" placeholder="Email">
            </div>

            {{--<div class="form-group">--}}
                {{--<label for="exampleInputEmail1">选择分类</label>--}}
                {{--<select class="form-control">--}}
                    {{--<option selected >一级分类</option>--}}
                    {{--<option >二级分类</option>--}}
                {{--</select>--}}
            {{--</div>--}}

            <div class="form-group">
                <label for="exampleInputEmail1">所属分类</label>
                <select class="form-control" name="pid">
                    @foreach($info as $k=>$v)
                        @if($arr['pid']==$v['cateid'])
                            <option selected value="{{$v['cateid']}}">{{$v['catname']}}</option>
                        @else
                            <option value="{{$v['cateid']}}">{{$v['catname']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="checkbox">
                <label>
                    @if($arr['status']=='展示')
                    <input type="checkbox" checked name="status" value="1"> 是否展示
                    @else
                        <input type="checkbox" name="status" value="1"> 是否展示
                    @endif
                </label>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
@endsection