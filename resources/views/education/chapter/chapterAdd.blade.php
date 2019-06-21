@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>

    <div class="panel-body">
        <form action="/chapter/addDo" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">章节名称</label>
                <input type="text" class="form-control" name="chaptername" placeholder="添加章节名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">选择课程</label>
                <select class="form-control" id="cid" name="cid">
                    @foreach($arr as $k=>$v)
                        <option value="{{$v['cid']}}">{{$v['cname']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" >
                <label for="exampleInputEmail1">选择分类</label>
                <select class="form-control" id="type" name="type">
                    <option value="1">章</option>
                    <option value="2">节</option>
                </select>
            </div>

            <div class="form-group" style="display: none">
                <label for="exampleInputEmail1">选择章节</label>
                <select class="form-control" id="pid" name="pid">

                </select>
            </div>
            <div class="form-group" style="display: none">
                <label for="exampleInputFile">选择视频</label>
                {{--<input type="file" name="file" id="file" >--}}
                <button type="button" id="file">上传文件</button>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">章节简介</label>
                <textarea  id="desp" name="desp" rows="3"></textarea>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="status" value="1" checked> 是否展示
                </label>
            </div>
            <button type="button" class="btn btn-default">提交</button>
        </form>
        <video src="" style="display: none" id="video"></video>
    </div>
@endsection

@section('js')
    <script src="/utf8-php/ueditor.config.js"></script>
    <script src="/utf8-php/ueditor.all.js"></script>
    <script src="/utf8-php/lang/zh-cn/zh-cn.js"></script>
    <script src="/statics/js/plupload.full.min.js"></script>
    {{--<script src="https://unpkg.com/qiniu-js@2.5.4/dist/qiniu.min.js"></script>--}}
    <script>

        $(function(){
            var isUploadFile=0;
            var videourl='';
            //视频时长
            var duration=0;
            var uploader=new plupload.Uploader({
                browse_button:"file",
                url:'/chapter/uploadfile',
                chunk_size:'10mb',
                multipart:true,
            });

            uploader.init();
            uploader.bind('FilesAdded',function () {
                isUploadFile=1;
            });
            //文件上传成功之后触发
            uploader.bind('FileUploaded',function(uploader,file,responseObject){
                videourl=responseObject.response;
                $("#video").prop('src',videourl);
                $("#video")[0].addEventListener('loadedmetadata',function(){
                    duration = this.duration;
                    saveInfo();
                });

                //
            });
            uploader.bind('UploadProgress',function(uploader,file){
                var percent = file.percent;
                $('.btn').text('正在上传，'+percent+'%');
            })
            $('.btn').click(function(){
                var type=$("#type").val();
                if(type==1){
                    saveInfo();
                    $(this).prop('disabled',true);
                }else if(type==2 && isUploadFile){
                    uploader.start();
                    $(this).prop('disabled',true);
                }else{
                    alert('没有上传文件')
                }
            });

            function saveInfo(){
                var chaptername=$("input[name='chaptername']").val();
                var pid=$("#pid").val();
                var type=$("#type").val();
                var cid=$("#cid").val();
                var status=$("input[name='status']")[0].checked;
                var desp=$("textarea[name='desp']").val();
                status = status ?1 :2;
                pid = type == 1 ? 0 : pid;
                $.ajax({
                    url:'/chapter/addDo',
                    data:{chaptername:chaptername,duration:duration,pid:pid,desp:desp,type:type,cid:cid,status:status,_token:"{{csrf_token()}}",videourl:videourl},
                    type:'post',
                    success:function (res) {
                        if(res=='OK'){
                            alert('添加成功');
                            history.go(0);
                        }else{
                            history.go(0);
                        }
                    }
                })
            }
            //富文本编辑器
            var ue = UE.getEditor('desp',{
                toolbars: [[
                    'fullscreen', 'source', '|', 'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                    'rowspacingtop']],
                initialFrameWidth:500,
                initialFrameHeight:200
            });
            $("#type").change(function(){
                getchapter();
            });
            $("#cid").change(function(){
                getchapter();
            });

            function getchapter(){
                var str="<option value=\"0\">请选择</option>\n";
                if($("#type").val()==2){
                    var cid=$("#cid").val();
                    $.ajax({
                        url:'/chapter/getchapter',
                        data:{cid:cid,_token:"{{csrf_token()}}"},
                        type:'post',
                        dataType:'json',
                        success:function (res) {
                            for(var i in res){
                                str+="<option value="+res[i]['chapterid']+">"+res[i]['chaptername']+"</option>";
                            }
                            $("#pid").html(str);
                        }
                    })
                    $("#pid").parent().show();
                    $("#file").parent().show();
                }else{
                    console.log(1);
                    $("#pid").parent().hide();
                    $("#file").parent().hide();
                }
            }
        })

    </script>

@endsection