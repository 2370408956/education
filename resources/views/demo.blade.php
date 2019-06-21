<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/jq.js"></script>
</head>
<body>
<input type="text" onkeydown="demo()" >
</body>
</html>
<script>

    // function test(){
    //     message=123;
    // }
    // test();
    // console.log(message);

    // var str='123';
    // console.log(parseInt('000123.0011'));
    // console.log(Number(str));
    // console.log(parseFloat('00123.0011'));
    // console.log(typeof '123');

    // console.log(isNaN('a'));


    // var obj={file:'张三',age:18,sex:'男'};
    // for (var i in obj){
    //     console.log(obj[i]);
    // }

    //匿名函数()
    // (function () {
    //     alert('测试代码');
    // })();

    // var demo=new Function('return 1');
    // // console.log(demo);
    // console.log(demo);
    // function $a() {
    //     alert(1);
    // }
    // var $a;
    //
    // console.log($a);

    //函数的预编译
    // function demo(){
    //     console.log($a);
    //     var $a=123;
    // }
    // demo();


    // function demo()

    //定义一个add 方法
    // function add(x, y) {
    //     return x + y;
    // }
    //
    // //用call 来调用 add 方法
    // function myAddCall(x, y) {
    //     //调用 add 方法 的 call 方法
    //     return add.apply(this,[ x, y]);
    // }
    //
    // console.log(myAddCall(10,20));


    // var name = '小白';
    //
    // var obj = {name:'小红'};
    //
    // function sayName() {
    //     return this.name;
    // }
    //
    // console.log(sayName.call(this));    //输出小白
    //
    // console.log(sayName. call(obj));    //输入小红

    // var str='a';
    // //拼接字符串
    // str.concat('bbb');
    // console.log(str);
    // console.log(str.charAt('b'));//charAt  返回输入的字符串，如果字符串中没有，返回字符串中的第一个字符

    // console.log(str.charCodeAt());//返回字符的编码


    // var str='abcdefg';
    // console.log(str.slice(0,5));//第五位，不包括第五位
    // console.log(str.substring(0,5))//第五位，不包括第五位
    // console.log(str.substr(0,6));//第二个参数是截取几位
    // console.log(str.indexOf('a')); //返回字符在字符串中的位置
    // console.log(str.toLowerCase());//小写
    // console.log(str.toUpperCase());//大写

    // console.log(str.search('d')); //返回字符在字符串中的位置

    // console.log(str.replace('a','b')); //替换，将a替换为b
    // console.log(str.split('b',3)); //切割字符串，第一个参数是根据什么来切割，第二个是切割的大小或个数，默认所有


    // function test()
    // {
    //     console.log(12345);
    // }
    // test();
    // test='aaaa';
    // console.log(typeof  test);
    // console.log(test);

    // var url='http://www.api.com/demo  /demo?a=1234';
    // var _url=encodeURI(url) //对网址的特殊字符进行编码 例如冒号、正斜杠、问号、井号
    // console.log(_url);
    // console.log(decodeURI(_url));//解码

    // console.log(Math.min(1,20)) //输出最小值
    // console.log(Math.max(1,20))//输出最大值
    // console.log(Math.ceil(1.01));//向上取整
    // console.log(Math.floor(1.92));//向下取整
    // console.log(Math.random());//返回随机数，0-1
    // var date=new Date(2018,4-1);
    // console.log(Date.now()+new Date());

    // var obj={username:'张三',age:18,demo:function () {
    //         alert(1);
    //     }};
    //
    // obj.demo();


    //排序
//     function compare(value1,value2){
//         return (value1-value2);
//     }
//     var values = [0,17,5,10,15];
// values.sort(compare);
// console.log((values)); // 0,1,5,10,15


    // console.log(screen.availWidth);//屏幕可用宽度
    // console.log(screen.availHeight);//屏幕可用高度
    // console.log(screen.width);
    // console.log(screen.height);

    //删除数组值或替换
    // var arr=[1,2,3,4,5,6,7];
    // arr.splice(2,2,8,8,2);
    // console.log(arr);
    // var str='adefsgrwfq';
    // console.log(str);
    // console.log(JSON.stringify(str));

    document.onkeyup=function (e) {
        e= e || window.event;
        console.log(e);
    }














</script>