<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/13
 * Time: 8:20 AM
 */
//Task:
//A palindrome is a word that reads the same backward or forward.
//Write a function that checks if a given word is a palindrome. Character case should be ignored.
//For example, isPalindrome("Never Odd Or Even") should return true as character case should be ignored, resulting in "Never Odd Or Even",
// which is a palindrome since it reads the same backward and forward.

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

if (Palindrome::isPalindrome('madam'))
    echo 'Palindrome';
else
    echo 'Not palindrome';

?>