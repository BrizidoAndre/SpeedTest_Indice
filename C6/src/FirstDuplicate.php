<?php
namespace App;
final class FirstDuplicate
{
    public static function solution($a)
    {
        $copy = [];
        foreach ($a as $item) {
            foreach ($copy as $itemCopy) {
                if ($item === $itemCopy) {
                    return $itemCopy;
                }
            }
            $copy[] = $item;
        }
        return -1;
    }

}
