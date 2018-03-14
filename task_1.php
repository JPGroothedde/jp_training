<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/12
 * Time: 12:24 PM
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
