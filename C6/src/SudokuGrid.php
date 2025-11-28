<?php

namespace App;
final class SudokuGrid
{
    public static function solution($a)
    {
        $countRow = count($a);
        $countCol = count($a[0]);
        $duplicate = [];
        for ($i = 0; $i < $countRow; $i++) {
            for ($j = 0; $j < $countCol; $j++) {
                $item = $a[$i][$j];
                foreach ($duplicate as $dup) {
                    if ($item !== '.' && $item === $dup) {
                        return $item;
                    }
                }
                $duplicate[] = $a[$i][$j];
            }
            $duplicate = [];
        }

        return true;
    }

}

echo SudokuGrid::solution([
    [".", ".", ".", "1", "4", ".", ".", "2", "."],
    [".", ".", "6", ".", ".", ".", ".", ".", "."],
    [".", ".", ".", ".", ".", ".", ".", ".", "."],
    [".", ".", "1", ".", ".", ".", ".", ".", "."],
    [".", "6", "7", ".", ".", ".", ".", ".", "9"],
    [".", ".", ".", ".", ".", ".", "8", "1", "."],
    [".", "3", ".", ".", ".", ".", ".", ".", "6"],
    [".", ".", ".", ".", ".", "7", ".", ".", "."],
    [".", ".", ".", "5", ".", ".", ".", "7", "."]
]);
