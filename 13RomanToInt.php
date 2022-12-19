<?php declare(strict_types = 1);

class Solution {
    public const ROMAN_NUMBERS = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
    ];

    public function romanToInt(string $s): int
    {
        $result = 0;
        $previousNumber = 0;
        $len = strlen($s);
        $rev = strrev($s);

        for ($i = 0; $i < $len; $i++) {
            $romanNumber = $rev[$i];
            $number = self::ROMAN_NUMBERS[$romanNumber];

            if ($number >= $previousNumber) {
                $result += $number;
            } else {
                $result -= $number;
            }

            $previousNumber = $number;
        }

        return $result;
    }
}


/* Client code below */

$solution = new Solution();
$testCases = [
    'III' => 3,
    'IV' => 4,
    'MC' => 1100,
    'MMXXII' => 2022,
    'MCMXXII' => 1922,
];

foreach ($testCases as $romanNumber => $expectedNumber) {
    $result = $solution->romanToInt($romanNumber);

    assert($expectedNumber === $result, "$romanNumber == $expectedNumber not $result");
}
