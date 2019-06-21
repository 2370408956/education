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
<form action="http://www.api.com/demo/add" method="post" id="myform" enctype="multipart/form-data">
    <input type="file" name="file" id="file">
    <button type="button" id="btn">添加</button>
</form>
</body>
</html>
<script>
    var btn=$("#btn");
    btn.click(function () {
        //获取form表单节点
        var data=$("#myform")[0];
        //获取formdata对象
        var myform=new FormData(data);
        //添加csrf_token
        myform.append('_token','{{csrf_token()}}');
        $.ajax({
            url: 'http://www.api.com/demo/add',
            type: 'POST',
            data: myform,
            //不处理数据
            processData: false,
            contentType: false,
            success:function (res) {
                console.log(res);
            }
        });
        return;
        $.ajax({
            url:"http://www.api.com/demo/add",
            type:'post',
            data:myform,
            datatype:'json',
            contentType:false,
            ProcessData:false,
            success:function (res) {
                console.log(res);
            }
        })
    })
</script>