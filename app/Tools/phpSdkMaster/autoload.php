<?php
namespace App\Tools\phpSdkMaster;

class qiniu{
    public function __construct ()
    {
        spl_autoload_register([$this,'classLoader']);
        require_once __DIR__ . '/src/Qiniu/functions.php';
    }

    public function classLoader ($class)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = __DIR__ . '/src/' . $path . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }

}
new qiniu();

//function classLoader($class)
//{
//    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
//    $file = __DIR__ . '/src/' . $path . '.php';
//
//    if (file_exists($file)) {
//        require_once $file;
//    }
//}



