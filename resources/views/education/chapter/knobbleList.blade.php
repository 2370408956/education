@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>

    <div class="panel-body">
        <form action="/chapter/addDo" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">章节名称</label>
                <input type="text" class="form-control" readonly value="{{$chapterInfo['chaptername']}}" name="chaptername" placeholder="添加章节名称">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">所属课程</label>
                <input type="text" class="form-control" readonly value="{{$chapterInfo['chaptername']}}" name="chaptername" placeholder="添加章节名称">
            </div>
            <div class="form-group demo" >
                <label for="exampleInputEmail1">所属章节</label>
                <input type="text" class="form-control" readonly value="{{$chaptername}}" name="chaptername" placeholder="添加章节名称">
            </div>

            <div class="form-group" >
                <label for="exampleInputEmail1">所属分类</label>
                    <input type="text" class="form-control" readonly value="{{$chapterInfo['type']}}" name="chaptername" placeholder="添加章节名称">

            </div>


            <div class="form-group" >
                <label for="exampleInputFile">选择视频</label>
                <embed src="{{$chapterInfo['videourl']}}" widht=播放显示宽度 height=播放显示高度 autostart=true/false loop=true/false></embed>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">章节简介</label>
                <textarea  id="desp" name="desp" rows="3" >{{$chapterInfo['desp']}}</textarea>
            </div>
            <input type="hidden" value="{{$chapterInfo['chapterid']}}" id="chapterid">
        </form>
    </div>
@endsection

@section('js')
    <script src="/utf8-php/ueditor.config.js"></script>
    <script src="/utf8-php/ueditor.all.js"></script>
    <script src="/utf8-php/lang/zh-cn/zh-cn.js"></script>
    <script src="/statics/js/plupload.full.min.js"></script>
    <script>
        $(function () {
            var type=$("#type").val();
            if(type==2){
                $("#pid").parent().show();
                $("#file").parent().show();
            }
        })
    </script>
    <script>
        //是否上传文件
        var isUploadFile=0;
        //上传成功之后返回的路径
        var videourl='';
        //实例化Uploader，设置参数
        var uploader=new plupload.Uploader({
            //触发事件的标签的id
            browse_button:"file",
            //服务器的地址
            url:'/chapter/uploadfile',
            //切片的大小，每一片大小
            chunk_size:'10mb',
            //为true，传送方式为multipart/form-data
            multipart:true,
        });
        //实例初始化
        uploader.init();
        //当选择文件时，isUploadFile改为1
        uploader.bind('FilesAdded',function () {
            isUploadFile=1;
        })
        //文件上传成功之后触发
        //文件上传成功之后再将数据添加到数据库
        uploader.bind('FileUploaded',function(uploader,file,responseObject){
            videourl=responseObject.response;
            saveInfo();
        });
        //文件上传过程中触发，显示文件上传的进度,file.percent
        uploader.bind('UploadProgress',function(uploader,file){
            var percent = file.percent;
            $('.btn').text('正在上传，'+percent+'%');
        });
        //点击之后，uploader实例执行，判断修改是否为章，章不上传文件，判断isUploadFile是否为1，1为已选择文件，需要上传文件，不满足以上2点，为单纯的修改数据
        $('.btn').click(function(){
            var type=$("#type").val();
            if(type==1){
                saveInfo();
            }else if(type==2 && isUploadFile){
                uploader.start();
            }else{
                saveInfo();
            }
            $(this).prop('disabled',true);
        });

        //获取数据，传送给控制器
        function saveInfo(){
            var chaptername=$("input[name='chaptername']").val();
            var pid=$("#pid").val();
            var type=$("#type").val();
            var cid=$("#cid").val();
            var status=$("input[name='status']")[0].checked;
            var desp=$("textarea[name='desp']").val();
            status = status ?1 :2;
            pid = type == 1 ? 0 : pid;
            var chapterid=$("#chapterid").val();
            $.ajax({
                url:'/chapter/editDo',
                data:{chaptername:chaptername,chapterid:chapterid,pid:pid,desp:desp,type:type,cid:cid,status:status,_token:"{{csrf_token()}}",videourl:videourl},
                type:'post',
                success:function (res) {
                    if(res=='OK'){
                        alert('修改成功');
                        location.href="/chapter/index";
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

        //选择章节
        function getchapter(){
            var str="<option value=\"0\">请选择</option>\n";
            //选择节
            //获取当前课程下的章
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
                });
                $("#pid").parent().show();
                $("#file").parent().show();
            }else{
                //选择节
                //隐藏视频和选择章的下拉框
                console.log(1);
                $("#pid").parent().hide();
                $("#file").parent().hide();
            }
        }
    </script>


@endsection