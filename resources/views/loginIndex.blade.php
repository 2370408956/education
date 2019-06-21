<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/jquery-3.2.1.min.js"></script>
</head>
<body>

<table>
    <tr>
        <td>用户名</td>
        <td><input type="text" name="username"></td>
    </tr>
    <tr>
        <td>密码</td>
        <td><input type="password" name="password"></td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="button" id="btn">立即登录</button>
        </td>
    </tr>
</table>
</body>
</html>
<script>
    var btn = $("#btn");
    btn.click(function () {
        var username=$("[name='username']").val();
        var password=$("[name='password']").val();
        var str='';
        $.ajax({
            url:"http://www.api.com/demo/datacrypt",
            data:{_token:'{{csrf_token()}}',password:password},
            type:'post',
            async:false,
            success:function (res) {
                password=res;
            }
        });
        $.ajax({
            url:"http://www.api.com/demo/getsign",
            data:{_token:'{{csrf_token()}}',username:username,password:password},
            type:'post',
            async:false,
            success:function (res) {
                str=res;
            }
        });

        $.ajax({
            url:"http://www.api.com/api/exam?"+str,
            type:'post',
            data:{_token:'{{csrf_token()}}',username:username,password:password},
            success:function (res) {
                if(res==2){
                    alert('登录失败');
                }else{
                    sessionStorage.setItem('jwt',res);
                    alert('登录成功');
                    location.href="http://www.api.com/demo/querywea";
                }
            }
        })


    })
</script>
