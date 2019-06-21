<?php

$arr=[1,10,13,2,5,100,23];
usort($arr,function ($v1,$v2){
     return $v1-$v2;
});
var_dump($arr);