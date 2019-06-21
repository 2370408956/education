<?php
namespace App\Tools;

class Rsa
{

    private static $priv_key;
    private static $pub_key;
    protected static $private_path='D:\phpStudy\PHPTutorial\WWW\laravel5.8\app\Tools\Crypt\private.pem';
    protected static $public_path='D:\phpStudy\PHPTutorial\WWW\laravel5.8\app\Tools\Crypt\public.pem';

    public static function encrypt($data,$type='public')
    {
        self::checkType($type);
        if($type=='public'){
            openssl_public_encrypt($data,$crypt,self::$pub_key);
        }else{
            openssl_private_encrypt($data,$crypt,self::$priv_key);
        }
        return base64_encode($crypt);
    }

    public static function decrypt($data,$type='private')
    {
        self::checkType($type);
        if($type=='private'){
            openssl_private_decrypt(base64_decode($data),$crypt,self::$priv_key);
        }else{
            openssl_public_decrypt(base64_decode($data),$crypt,self::$pub_key);
        }
        return $crypt;
    }

    public static function checkType($type)
    {
        if($type=='public'){
            $pub_key=file_get_contents(self::$public_path);
            if(!openssl_pkey_get_public($pub_key) || !$pub_key){
                self::saveKey();
            }
            self::$pub_key=$pub_key;
        }else{
            $private_key=file_get_contents(self::$private_path);
            if(!$private_key || !openssl_pkey_get_private($private_key)){
                self::saveKey();
            }
            self::$priv_key=$private_key;
        }
    }

    //返回私钥
    public function getPrivKey()
    {
        return self::$priv_key;
    }

    //返回公钥
    public function getPubKey()
    {
        return self::$pub_key;
    }

    //判断秘钥是否可用
    public function checkPrivKey($privkey)
    {
        return openssl_pkey_get_private($privkey);
    }

    public static function saveKey()
    {
        $config=[
            'config'=>'D:\phpStudy\PHPTutorial\Apache\conf\openssl.cnf',
            'private_key_bits'=>2048
        ];
        $res=openssl_pkey_new($config);
        openssl_pkey_export($res,$priv_key,null,$config);
        $private_path='D:\phpStudy\PHPTutorial\WWW\laravel5.8\app\Tools\Crypt\private.pem';
        $public_path='D:\phpStudy\PHPTutorial\WWW\laravel5.8\app\Tools\Crypt\public.pem';
        if(!file_get_contents($private_path)){
            file_put_contents($private_path,$priv_key);
        }
        self::$priv_key=$priv_key;

        $arr=openssl_pkey_get_details($res);
        if(!file_get_contents($public_path)){
            file_put_contents($public_path,$arr['key']);
        }
        self::$pub_key=$arr['key'];
    }

}