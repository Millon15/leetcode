<?php declare(strict_types = 1);

class Solution
{
    private int $leftBoundary;
    private int $rightBoundary;

    /** @param int[] $nums */
    public function search(array $nums, int $target): int
    {
        $this->leftBoundary = 0;
        $this->rightBoundary = count($nums) - 1;

        if ($this->compare($nums, $target, $this->leftBoundary)) {
            return $this->leftBoundary;
        }

        do {
            $index = $this->calculateNextIndex();

            if ($this->compare($nums, $target, $index)) {
                return $index;
            }
        } while ($this->rightBoundary - $this->leftBoundary > 1);

        if ($this->compare($nums, $target, $this->rightBoundary)) {
            return $this->rightBoundary;
        }

        return -1;
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

$nums = [-1,0,3,5,9,12,13,123,3246,89235,253452];
$testCases = [
    [
        'nums' => $nums,
        'target' => 9,
        'expectedIndex' => 4,
    ],
    [
        'nums' => $nums,
        'target' => 3,
        'expectedIndex' => 2,
    ],
    [
        'nums' => [2,5],
        'target' => 2,
        'expectedIndex' => 0,
    ],
    [
        'nums' => [2,5],
        'target' => 5,
        'expectedIndex' => 1,
    ],
    [
        'nums' => [-1,0,5],
        'target' => 5,
        'expectedIndex' => 2,
    ],
    [
        'nums' => [-1,0,5],
        'target' => -1,
        'expectedIndex' => 0,
    ],
    [
        'nums' => [-1,0,5],
        'target' => 0,
        'expectedIndex' => 1,
    ],
];

foreach ($testCases as $t) {
    $expectedIndex = $t['expectedIndex'];

    $index = $solution->search($t['nums'], $t['target']);

    assert($expectedIndex === $index, "$expectedIndex !== $index" . PHP_EOL);
    echo "$expectedIndex === $index" . PHP_EOL;
}
