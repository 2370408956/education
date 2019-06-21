@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>
<div class="panel-body">
    <table class="table table-hover table-bordered">
        <tr>
            <th>
                
            </th>
            <th>id</th>
            <th>方向名称</th>
            <td>
                操作
            </td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td>1</td>
            <td>前端</td>
            <td>
                <a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
                <a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-window-close" aria-hidden="true"></i></a>
            </td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td>2</td>
            <td>后端</td>
            <td>
                <a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
                <a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-window-close" aria-hidden="true"></i></a>
            </td>
        </tr>
    </table>
</div>
<div class="row foot">
    <div class="col-md-7">
        <button type="button" class="btn btn-link all">全选</button>
        /
        <button type="button" class="btn btn-link noall">反选</button>
        <a href="/direction/add"><button type="button" class="btn btn-success">添加</button></a>
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