<?php
namespace App\Tools;

class Http
{

    /*
	* 缺少HTTPS请求的curl方法
	*/
    public static function getSchema($url){
        $info = parse_url($url);
        if($info['scheme'] == "https"){
            return true;
        }
        return false;
    }
    /*
    * curl实现post请求
    * @param url 请求的地址
    * @param data post传输的参数
    */
    public static function httpPost($url,$data=[],$params=[],$multi=false)
    {
        //设置post参数
        if(self::getSchema($url)){
            $param[CURLOPT_SSL_VERIFYPEER] = false;
            $param[CURLOPT_SSL_VERIFYHOST] = false;
        }
        $data=$multi ? $data :http_build_query($data);
        $param=$params+[
                CURLOPT_URL=>$url,
                CURLOPT_POST=>true,
                CURLOPT_POSTFIELDS=>$data
            ];

        return self::httpDo($param);

    }

    public  static function httpGet($url,$option=[])
    {
        $param=[];
        if(self::getSchema($url)){
            $param[CURLOPT_SSL_VERIFYPEER] = false;
            $param[CURLOPT_SSL_VERIFYHOST] = false;
        }
        $param=$param+[
            CURLOPT_URL=>$url
        ];
        $param=$param+$option;

        return self::httpDo($param);
    }
    /*
    * 运行curl
    * @param param 设置curl的参数
    */
    private static function httpDo($param=[])
    {
        $ch=curl_init();//curl初始化
        $defaultParam=[
            CURLOPT_RETURNTRANSFER=>true,//
            CURLOPT_FOLLOWLOCATION=>true,
        ];
        $params=$defaultParam + $param;
        curl_setopt_array($ch,$params);
        $res=curl_exec($ch);
        if(!$res){
            return curl_error($ch);
        }
        return $res;
    }

    public function demo()
    {
        return 'method';
    }
}