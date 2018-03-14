<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/13
 * Time: 8:24 AM
 */
/*
Modify your Foundation Task 2 (https://trello.com/c/rXQogHiZ) result to do the following:

Your php script should accept a POST variable that will serve as the maximum number for the Fibonacci sequence.
Create a new html file that will have an input box where the user can specify the maximum number for the Fibonacci sequence.
Add a button to the html file that will, when clicked take the user input and post it (using javascript)
to the php script and then output the result on the screen
*/
$first  = 0;
$second = 1;
$max    = $_REQUEST['fiboMax'];
$fibo   = 0;
function fibo($first,$second,$max){
    $fibo  = $first + $second;
    if($fibo < $max){
        echo $fibo.' ';
        $first  = $second;
        $second = $fibo;
        fibo($first,$second,$max);
    }
}
fibo($first,$second,$max);