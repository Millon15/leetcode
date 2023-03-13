<?php declare(strict_types = 1);

class Solution
{
    /** @param int[] $nums */
    public function moveZeroes(array &$nums): void
    {
        $numsLength = count($nums);
        $zeroesCounter = 0;

        foreach ($nums as $i => $n) {
            if (0 === $n) {
                ++$zeroesCounter;
            } else {
                $nums[$i - $zeroesCounter] = $n;
            }
        }

        for ($j = $numsLength - $zeroesCounter; $j < $numsLength; $j++) {
            $nums[$j] = 0;
        }
    }
}

/* Client code below */
$solution = new Solution();

$testCases = [
    [
        'nums' => [],
        'result' => [],
    ],
    [
        'nums' => [0],
        'result' => [0],
    ],
    [
        'nums' => [1],
        'result' => [1],
    ],
    [
        'nums' => [1,0],
        'result' => [1,0],
    ],
    [
        'nums' => [0,1,0],
        'result' => [1,0,0],
    ],
    [
        'nums' => [0,1,0,3,12],
        'result' => [1,3,12,0,0],
    ],
];

foreach ($testCases as $i => $t) {
    $solution->moveZeroes($t['nums']);

    $errorMessage = "$i: "
        . var_export($t['result'], true)
        . PHP_EOL . PHP_EOL . '!== ' . PHP_EOL . PHP_EOL
        . var_export($t['nums'], true) . PHP_EOL . PHP_EOL;
    assert($t['result'] === $t['nums'], $errorMessage);

    echo "$i: GOOD" . PHP_EOL;
}
