<?php

namespace App;
final class RotateArray
{
    public static function solution($a)
    {
        $copy = [];
        $count = count($a) -1;
        $countInside = count($a[0]);
        for ($i = $count; $i >= 0; $i--) {
            for ($j = 0; $j < $countInside; $j++) {
            }
        }
        return $copy;
    }

}

$a = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
echo '<pre>';
echo print_r(RotateArray::solution($a), true);
echo '</pre>';
