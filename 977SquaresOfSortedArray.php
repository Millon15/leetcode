<?php declare(strict_types = 1);

final class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int[]
     */
    public function sortedSquares(array $nums): array
    {
        if (empty($nums)) {
            return $nums;
        }

        $leftIndex = 0;
        $rightIndex = count($nums) - 1;
        $result = $nums;
        $resultIndex = $rightIndex;

        do {
            $left = abs($nums[$leftIndex]);
            $right = abs($nums[$rightIndex]);

            if ($left <= $right) {
                $result[$resultIndex] = $right ** 2;
                --$rightIndex;
            } else {
                $result[$resultIndex] = $left ** 2;
                ++$leftIndex;
            }

            --$resultIndex;
        } while ($resultIndex >= 0);

        return $result;
    }
}


/* Client code below */
$solution = new Solution();

$testCases = [
    [
        'nums' => [-4,-1,0,3,10],
        'result' => [0,1,9,16,100],
    ],
    [
        'nums' => [-4,3],
        'result' => [9,16],
    ],
    [
        'nums' => [1],
        'result' => [1],
    ],
];

foreach ($testCases as $i => $t) {
    $result = $solution->sortedSquares($t['nums']);

    $errorMessage = "$i: "
        . var_export($t['result'], true)
        . PHP_EOL . PHP_EOL . '!== ' . PHP_EOL . PHP_EOL
        . var_export($result, true) . PHP_EOL . PHP_EOL;
    assert($t['result'] === $result, $errorMessage);

    echo "$i: GOOD" . PHP_EOL;
}
