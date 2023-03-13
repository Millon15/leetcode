<?php declare(strict_types = 1);

class Solution
{
    /** @param int[]& $nums */
    public function rotate(array &$nums, int $k): void
    {
        $numsLenght = count($nums);

        $k %= $numsLenght;
        if ($k < 0) {
            $k += $numsLenght;
        }

        if ($k === 0) {
            return;
        } elseif ($numsLenght % $k) {
            $this->rotateNonMultiple($nums, $k, $numsLenght);
        } else {
            $this->rotateMultiple($nums, $k, $numsLenght);
        }
    }

    private function rotateNonMultiple(array &$nums, int $k, int $numsLenght): void
    {
        $limit = $numsLenght;
        $iteration = 0;
        $index = 0;

        do {
            $stack = null;
            $i = $index + 1;

             do {
                $index = $i % $numsLenght;
                [$nums[$index], $stack] = [$stack, $nums[$index]];

                $i += $k;
                ++$iteration;
            } while (null !== $stack);
        } while ($iteration < $limit++);
    }

    private function rotateMultiple(array &$nums, int $k, int $numsLenght): void
    {
        $limit = $numsLenght / $k;
        $initialIndex = 0;

        while ($initialIndex < $k) {
            $stack = null;
            $i = $initialIndex;
            $iteration = 0;

            while ($iteration <= $limit) {
                $index = $i % $numsLenght;
                [$nums[$index], $stack] = [$stack, $nums[$index]];

                $i += $k;
                ++$iteration;
            }

            ++$initialIndex;
        }
    }
}


/* Client code below */
$solution = new Solution();

$testCases = [
    [
        'nums' => [0],
        'k' => 1,
        'result' => [0],
    ],
    [
        'nums' => [-5,5],
        'k' => 0,
        'result' => [-5,5],
    ],
    [
        'nums' => [0,1,2],
        'k' => 7,
        'result' => [2,0,1],
    ],
    [
        'nums' => [1,2],
        'k' => 3,
        'result' => [2,1],
    ],


    [
        'nums' => [0,1,2],
        'k' => 1,
        'result' => [2,0,1],
    ],
    [
        'nums' => [0,1,2],
        'k' => 2,
        'result' => [1,2,0],
    ],

    [
        'nums' => [0,1,2,3,5],
        'k' => 1,
        'result' => [5,0,1,2,3],
    ],
    [
        'nums' => [0,1,2,4,5],
        'k' => 2,
        'result' => [4,5,0,1,2],
    ],
    [
        'nums' => [0,1,2,4,5],
        'k' => 3,
        'result' => [2,4,5,0,1],
    ],

    [
        'nums' => [0,1,2,3,4,5,6,7,8,9,10],
        'k' => 2,
        'result' => [9,10,0,1,2,3,4,5,6,7,8],
    ],
    [
        'nums' => [0,1,2,3,4,5,6,7,8,9],
        'k' => 3,
        'result' => [7,8,9,0,1,2,3,4,5,6],
    ],

    [
        'nums' => [0,1,2,3],
        'k' => 3,
        'result' => [1,2,3,0],
    ],
    [
        'nums' => [0,1,2,3],
        'k' => 2,
        'result' => [2,3,0,1],
    ],
    [
        'nums' => [0,1,2,3,4,5],
        'k' => 2,
        'result' => [4,5,0,1,2,3],
    ],
    [
        'nums' => [0,1,2,3,4,5],
        'k' => 3,
        'result' => [3,4,5,0,1,2],
    ],
    [
        'nums' => [0,1,2,3,4,5,6,7,8,9,10,11],
        'k' => 4,
        'result' => [8,9,10,11,0,1,2,3,4,5,6,7],
    ],
    [
        'nums' => [0,1,2,3,4,5,6,7,8],
        'k' => 3,
        'result' => [6,7,8,0,1,2,3,4,5],
    ],
    [
        'nums' => [0,1,2,3,4,5],
        'k' => 4,
        'result' => [2,3,4,5,0,1],
    ],
    [
        'nums' => [0,1,2,3,4,5,6],
        'k' => 4,
        'result' => [3,4,5,6,0,1,2],
    ],
    [
        'nums' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54],
        'k' => 45,
        'result' => [10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,1,2,3,4,5,6,7,8,9],
    ],
];

foreach ($testCases as $i => $t) {
    $solution->rotate($t['nums'], $t['k']);

    $errorMessage = "$i: "
        . var_export($t['result'], true)
        . PHP_EOL . PHP_EOL . '!== ' . PHP_EOL . PHP_EOL
        . var_export($t['nums'], true) . PHP_EOL . PHP_EOL;
    assert($t['result'] === $t['nums'], $errorMessage);

    echo "$i: GOOD" . PHP_EOL;
}
