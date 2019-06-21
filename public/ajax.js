
var $={};
$.ajax=function($opt) {

    $option={
        url   : "",
        type  : 'get',
        async : true,
        data  : null,
        dataType:"text",
        timeout:0,
        ProcessData:true,
        success : function(data){},
        error : function(error){},
        complete: function(){},
        expire: function(){},
        beforeSend: function(obj){}
    };

    $option=Object.assign($option,$opt);

    //实例化一个xmlhttprequest对象
    var xhr = new XMLHttpRequest();

    //处理数据
    if($option.ProcessData == true){
        var dt=[];
        // console.log($option.data);
        if('string' !== typeof $option.data){
            for (var i in $option.data){
                dt.push(i+'='+$option.data[i])
            }
        }
        if($option.type.toUpperCase()=='POST'){
            $option.data=dt.join('&');
        }else if($option.type.toUpperCase() == "GET"){
            $sep='&';
            if($option.url.indexOf('?') === '-1'){
                $sep='?';
            }
            $option.url=$option.url+$sep+dt.join('&');
        }
    }
    //打开一个连接
    xhr.open($option.type,$option.url,$option.async);

    // xhr.responseType=$option.dataType;
    //设置参数
    $option.beforeSend(xhr);
    //设置响应数据类型


    //设置时间
    if($option.timeout){
        xhr.timeout=$option.timeout;
    }

    //不论成功或失败都调用
    xhr.onloadend=$option.complete;
    //网络错误时调用
    xhr.onerror=$option.error;

    //超时
    xhr.ontimeout=$option.expire;
    //成功时调用
    xhr.onload=function () {
        if( (this.status>=200 && this.status<300) || this.status==304 ){
            xhr.success=$option.success(this.response);
        }
    }
    xhr.send($option.data);

}

$.jsonp=function(url,callback){
    var sep="&";
    if(url.indexOf('?') == '-1'){
        sep="?";
    }

    url = url+sep+'callback='+callback;

    var sc = document.createElement('script');
    sc.src=url;
    document.body.appendChild(sc);
};