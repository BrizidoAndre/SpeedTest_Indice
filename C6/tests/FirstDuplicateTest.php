<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class FirstDuplicateTest extends TestCase
{
    public static function solutionProvider(): array
    {
        return [
            [
                [2, 1, 3, 5, 3, 2],
                3
            ],
            [
                [2, 2],
                2
            ],
            [
                [2, 4, 3, 5, 1],
                -1
            ],
            [
                [1],
                -1
            ],
            [
                [5, 5, 5, 5, 5],
                5
            ],
            [
                [2, 1],
                -1
            ],
            [
                [2, 1, 3],
                -1
            ],
            [
                [2, 3, 3],
                3
            ],
            [
                [3, 3, 3],
                3
            ],
            [
                [8, 4, 6, 2, 6, 4, 7, 9, 5, 8],
                6
            ],
            [
                [10, 6, 8, 4, 9, 1, 7, 2, 5, 3],
                -1
            ],
            [
                [1, 1, 2, 2, 1],
                1
            ]
        ];
    }

    #[DataProvider('solutionProvider')]
    public function testSolution(array $arrProvided, int $valueExpected): void
    {
        $this->assertSame($valueExpected, \App\FirstDuplicate::solution($arrProvided));
    }
}
