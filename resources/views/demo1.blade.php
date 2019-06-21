<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/chapter/qiniu" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="file">
    <input type="button" id="btn" value="立即添加">
</form>
</body>
</html>
<script src="/statics/js/qiniu.min.js"></script>
<script src="/statics/js/jquery-3.2.1.min.js"></script>

<script>
    $("#btn").click(function(){
        var token='';
        $.ajax({
            url:"/chapter/demo",
            data:{},
            async:false,
            success:function(res){
                token=res;
            }
        });
        var file=$("#file")[0].files[0];
        var key=file.name;
        var config = {
            useCdnDomain: true,
            region: qiniu.region.z1
        };
        var putExtra={};
        var observable = qiniu.upload(file, key, token, putExtra, config);
        var observer = {
            next(res){
                console.log(res.total.loaded)
            },
            error(err){
                console.log(err.code);
            },
            complete(res){
                console.log(res);
            }
        };

        var subscription = observable.subscribe(observer) // 上传开始

    })

</script>
