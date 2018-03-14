<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/13
 * Time: 8:21 AM
 */
class ItemOwners {
    public static function groupByOwners($items) {
//TODO: Implement this
    $Array = array();
        array_walk($items, function($value, $key) use (&$Array) {
            if(!isset($Array[$value]) || !is_array($Array[$value])) {
                $Array[$value] = [];
            }
            $Array[$value][] = $key;
        });
        return $Array;
    }
}

$items = array(
    "Baseball Bat" => "John",
    "Golf ball" => "Stan",
    "Tennis Racket" => "John"
);

echo json_encode(ItemOwners::groupByOwners($items));
?>