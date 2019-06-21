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

<form action="">

    <input type="text" name="username" >
    <input type="password" name="pwd">
    <input type="button" value="提交" id="btn">

</form>

</body>
</html>

<script>
    var btn=$("#btn");
    btn.click(function(){
        var username=$("[name='username']").val();
        var pwd=$("[name='pwd']").val();
        var str='';
        $.ajax({
            url:'http://www.api.com/demo/addSign',
            data:{username:username,pwd:pwd,_token:'{{csrf_token()}}'},
            type:'post',
            async:false,
            success:function (res) {
                str=res;
            }
        });
        $.ajax({
            url:'http://www.api.com/demo1/test?'+str,
            data:{username:username,pwd:pwd,_token:'{{csrf_token()}}'},
            type:'post',
            success:function (res) {
                console.log(res);
            }
        })

    })
</script>