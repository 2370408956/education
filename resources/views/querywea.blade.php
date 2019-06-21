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
        <td><input type="text" id="wea"></td>
        <td><input type="button" value="查询天气" id="btn"></td>
    </tr>
    <tbody id="info">

    </tbody>
</table>
</body>
</html>
<script>
    var btn=$("#btn");
    btn.click(function () {

        var wea=$("#wea").val();
        var str='';
        $.ajax({
            url:"http://www.api.com/demo/getsign",
            async:false,
            success:function (res) {
                str=res;
            }
        });

        $.ajax({
            beforeSend:function(xhr){
                xhr.setRequestHeader('Authorization',sessionStorage.getItem('jwt'));
            },
            url:'http://www.api.com/api/exam?'+str,
            type:'get',
            datatype:'json',
            data:{wea:wea},
            success:function (res) {
                if(res.success==1){
                    str="<tr>\n" +
                        "        <td>"+res.result.citynm+"</td>\n" +
                        "        <td>"+res.result.weather+"</td>\n" +
                        "    </tr>";
                    $("#info").html(str);
                }else{
                    alert('请输入正确的城市名称');
                }

            }
        })
    })
</script>