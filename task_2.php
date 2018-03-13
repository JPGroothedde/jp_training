<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/12
 * Time: 8:45 AM
 */
$first  = 0;
$second = 1;
$max    = 80;
$fibo   = 0;

while($fibo < $max){
    $fibo = $first + $second;
    echo $fibo.'<br />';
    $first = $second;
    $second = $fibo;
}


function fibo($first,$second,$max){
    $fibo  = $first + $second;
    if($fibo < $max){
        echo $fibo.'<br/>';
        $first  = $second;
        $second = $fibo;
        fibo($first,$second,$max);
    }
}
fibo($first,$second,$max);
?>