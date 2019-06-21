@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>

    <div class="panel-body">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">小节名称</label>
                <input type="email" class="form-control" value="php基础" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">所属课程</label>
                <select class="form-control">
                    <option >css基础</option>
                    <option selected>php从入门到删库</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">所属章节</label>
                <select class="form-control">
                    <option >css基础</option>
                    <option selected>php从入门到删库</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">选择视频</label>
                <input type="file" id="exampleInputFile">
                {{--<p class="help-block">Example block-level help text here.</p>--}}
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