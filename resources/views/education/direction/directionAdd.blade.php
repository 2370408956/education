@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>
    <div class="panel-body">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">课程类型名称</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> 是否展示
                </label>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
@endsection