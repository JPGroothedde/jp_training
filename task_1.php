<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/12
 * Time: 12:24 PM
 */

//Task: Create a function "addAll()" that will take an array as input parameter.
//The function will sum all the elements in the array and then remove the first element of the array.
//The function should repeat this until the array is empty and then return the total.
//For example: For the array [1,1,1,1,1], the result should be 15 -> 5+4+3+2+1=15
//Optimize your solution as far as possible.
/*
 * function fibo($first,$second,$max){
    $fibo  = $first + $second;
    if($fibo < $max){
        echo $fibo.'<br/>';
        $first  = $second;
        $second = $fibo;
        fibo($first,$second,$max);
    }
}
 *
 */
function addAllRecursive($Array,$total = 0) {
    if(count($Array)==0){
        echo $total;
    }else{
        for($i=0;$i<count($Array);$i++){
            $total += $Array[$i];
        }
        array_shift($Array);
        addAllRecursive($Array,$total);
    }
}

function addAllLoop($Array) {
    $total = 0;
    while(count($Array) > 0) {
        foreach ($Array as $value) {
            $total += $value;
        }
        array_shift($Array);
    }
    return $total;
}

$Array = [1,1,1,1,1,2]; //5+4+3+2+1=15
//echo addAllLoop($Array) . ' ';
echo addAllRecursive($Array);
?>