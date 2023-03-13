<?php declare(strict_types = 1);

class Solution
{
    /** @param int[][] $edges */
    public function validPath(int $n, array $edges, int $source, int $destination): bool
    {
        // TODO complete this algo :)
        return true;
    }
}


/* Client code below */

$solution = new Solution();
$testCases = [
    [
        'n' => 3,
        'edges' => [[0,1],[1,2],[2,0]],
        'source' => 0,
        'destination' => 2,
        'isValid' => true,
    ],
    [
        'n' => 6,
        'edges' => [[0,1],[0,2],[3,5],[5,4],[4,3]],
        'source' => 0,
        'destination' => 5,
        'isValid' => false,
    ],
];

foreach ($testCases as $testCase) {
    $isValid = $solution->validPath($testCase['n'], $testCase['edges'], $testCase['source'], $testCase['destination']);

    assert($testCase['isValid'] === $isValid);
}
