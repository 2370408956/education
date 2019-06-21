@extends('education.public')
@section('body')
    <div class="panel-heading">课程类型</div>
    <div class="panel-body">
        <form action="/user/editDo" method="post" id="myform" enctype="multipart/form-data">
            <input type="hidden" value="{{$userinfo['uid']}}" name="uid">
            <div class="form-group">
                <label for="exampleInputEmail1">用户名</label>
                <input type="text" class="form-control" value="{{$userinfo['username']}}" name="username" required  placeholder="用户名必填">
                <span id="messageUser"></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">手机号</label>
                <input type="text" class="form-control" name="mobile" value="{{$userinfo['mobile']}}" required  placeholder="手机号必填">
                <span id="messagePhone"></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">个人简介</label>
                <textarea class="form-control" name="profile"  placeholder="可选" rows="3">{{$userinfo['profile']}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">选择头像</label>
                <input type="file" name="file" id="file" onchange="previewFile()">
                <img src="/images/{{$userinfo['avatar']}}" height="30%" width="30%" alt="Image preview..." id="demo">
            </div>
            @csrf
            <button type="button" class="btn btn-default">添加</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function previewFile(){
            var preview=$("#demo")[0];
            var file=$("#file")[0].files[0];
            var reader=new FileReader();
            //获取base64
            reader.readAsDataURL(file);
            //获取完成后执行
            reader.onload=function(){
                //创建一个img标签
                // var img=document.createElement('img');
                preview.src=this.result;
                //将img标签加到body后
                // document.body.appendChild(img);
            }
        }
        $(function () {
            $(".btn").click(function() {
                // var username = $("input[name='username']").val();
                // var pwd1 = $("input[name='password']").val();
                // var pwd2 = $("input[name='password2']").val();
                // var mobile = $("input[name='mobile']").val();
                // if (username == '') {
                //     $("#messageUser").text('用户名必填').css('color', 'red');
                //     return false;
                // } else {
                //     $("#messageUser").text('');
                // }
                // if (pwd1 == '') {
                //     $("#messagePwd").text('密码必填').css('color', 'red');
                //     return false;
                // } else if (pwd1.length < 6) {
                //     $("#messagePwd").text('密码6位');
                // } else {
                //     $("#messagePwd").text('');
                // }
                // if (pwd2 == '') {
                //     $("#messagePwd2").text('确认密码必填').css('color', 'red');
                //     return false;
                // } else if (pwd1 != pwd2) {
                //     $("#messagePwd2").text('2次密码不一致').css('color', 'red');
                //     return false;
                // } else {
                //     $("#messagePwd2").text('');
                // }
                // var reg=/^[1]([3-9])[0-9]{9}$/;
                //
                // if (mobile == '') {
                //     $("#messagePhone").text('手机号必填').css('color', 'red');
                //     return false;
                // }else if(!reg.test(mobile)){
                //     $("#messagePhone").text('手机号不正确').css('color', 'red');
                //     return false;
                // }else{
                //     $("#messagePhone").text('');
                // }

                var formdata=$("#myform")[0];
                $.ajax({
                    url:'/user/editDo',
                    data:new FormData(formdata),
                    type:'post',
                    processData:false,
                    contentType:false,
                    success:function(res){
                        if(res=="OK"){
                            alert('修改成功')
                            history.go(-1);
                        }else{
                            alert('修改失败')
                        }
                    }
                })

            })
        })

    </script>

@endsection