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
        <td>申请名称</td>
        <td>结果</td>
        <td>app_key</td>
        <td>app_secret</td>
    </tr>

    <tbody id="tbody">

    </tbody>
</table>
</body>
</html>
<script>
    $.ajax({
        url:"http://www.api.com/demo/applyfor1",
        dataType:'json',
        data:{type:1},
        success:function (res) {
            var str='';
            for (var i in res){
                str+="<tr>\n" +
                    "        <td>"+res[i]['username']+"</td>\n" +
                    "        <td>"+res[i]['status']+"</td>\n" +
                    "        <td>"+res[i]['app_key']+"</td>\n" +
                    "        <td>"+res[i]['app_secret']+"</td>\n" +
                    "    </tr>";
            }
            $("#tbody").html(str);

        }
    })
</script>