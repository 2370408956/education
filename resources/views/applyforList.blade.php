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
        <td>id</td>
        <td>申请名称</td>
        <td>操作</td>
    </tr>
    <tbody id="tbody"></tbody>
</table>
</body>
</html>

<script>
    $.ajax({
        url:'http://www.api.com/demo/applyfor',
        type:'get',
        success:function (res) {
            var str='';
            for (var i in res){
                str+="<tr>\n" +
                    "        <td>"+res[i]['username']+"</td>\n" +
                    "        <td>"+res[i]['idnum']+"</td>\n" +
                    "        <td><a href='javascript:;' class='ok' value="+res[i]['id']+">通过</a></td>\n" +
                    "        <td><a href='javascript:;' class='no' value="+res[i]['id']+">不通过</a></td>\n" +
                    "    </tr>"
            }
            $("#tbody").html(str);
        }
    })

    $(document).on('click',".ok,.no",function () {
        var id=$(this).attr('value');
        var status=$(this).prop('class');
        if(status=='ok'){
            var content='';
        }else{
            var content=prompt();
        }
        if(content){
            $.ajax({
                url:'http://www.api.com/demo/operation',
                type:'get',
                data:{id:id,status:status,content:content},
                success:function (res) {
                    sessionStorage.setItem('hh','123');
                    console.log(res);
                }
            })
        }


    })
</script>