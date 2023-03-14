<?php declare(strict_types = 1);

final class Solution
{
    private int $leftBoundary;
    private int $rightBoundary;

    /** @param int[] $nums */
    public function searchInsert(array $nums, int $target): int
    {
        $this->leftBoundary = 0;
        $this->rightBoundary = count($nums) - 1;
        $index = $this->calculateNextIndex();

        // check edge cases
        if (empty($nums)) {
            return 0;
        }
        if ($target <= $nums[$this->leftBoundary]) {
            return $this->leftBoundary;
        }
        if ($target > $nums[$this->rightBoundary]) {
            return $this->rightBoundary + 1;
        }

        // binary search through $nums such $index that: $nums[$index - 1] < $target <= $nums[$index]
        do {
            if ($this->compare($nums, $target, $index)) {
                return $index;
            }

            $index = $this->calculateNextIndex();
        } while ($this->rightBoundary - $this->leftBoundary > 1);

        return $index;
    }

    private function calculateNextIndex(): int
    {
        return $this->leftBoundary + ((int) round(($this->rightBoundary - $this->leftBoundary) / 2));
    }

    private function compare(array $nums, int $target, int $index): bool
    {
        $num = $nums[$index];

        if ($target > $num) {
            $this->leftBoundary = $index;
        } elseif ($target === $num) {
            return true;
        } elseif ($target < $num) {
            $this->rightBoundary = $index;
        }

        return false;
    }
}


/* Client code below */

$solution = new Solution();

$nums = [3,9];
$testCases = [
    [
        'nums' => [3,9],
        'target' => 3,
        'expectedIndex' => 0,
    ],
    [
        'nums' => [3,9],
        'target' => 9,
        'expectedIndex' => 1,
    ],

    [
        'nums' => [3,9],
        'target' => -1,
        'expectedIndex' => 0,
    ],
    [
        'nums' => [3,9],
        'target' => 5,
        'expectedIndex' => 1,
    ],
    [
        'nums' => [3,9],
        'target' => 10,
        'expectedIndex' => 2,
    ],
];
$nums = [1,3,5,6];
$testCases = array_merge($testCases, [
    [
        'nums' => $nums,
        'target' => 5,
        'expectedIndex' => 2,
    ],
    [
        'nums' => $nums,
        'target' => 2,
        'expectedIndex' => 1,
    ],
    [
        'nums' => $nums,
        'target' => 7,
        'expectedIndex' => 4,
    ],
    [
        'nums' => $nums,
        'target' => 3411414327,
        'expectedIndex' => 4,
    ],
    [
        'nums' => $nums,
        'target' => -3411414327,
        'expectedIndex' => 0,
    ],

    // 'results floats' => [
    //     'nums' => [1,2,3,4,4,4,4,4,4,4,4,5],
    //     'target' => 4,
    //     'expectedIndex' => 4,5,6,
    // ],
]);

foreach ($testCases as $i => $t) {
    $expectedIndex = $t['expectedIndex'];

    $index = $solution->searchInsert($t['nums'], $t['target']);

    assert($expectedIndex === $index, "$i: $expectedIndex !== $index" . PHP_EOL);
    echo "$expectedIndex === $index" . PHP_EOL;
}
