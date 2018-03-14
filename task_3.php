<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/13
 * Time: 8:20 AM
 */
class Palindrome {
    public static function isPalindrome($word) {
//TODO: Implement this
        $word = strtolower($word);
        $word = str_replace(' ','',$word);
        if ($word == strrev($word)) {
            return true;
        }else {
            return false;
        }
    }
}

if (Palindrome::isPalindrome('Never Odd Or Even'))
    echo 'Palindrome';
else
    echo 'Not palindrome';

?>
