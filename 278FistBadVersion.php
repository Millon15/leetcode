<?php declare(strict_types = 1);

/* The isBadVersion API is defined in the parent class VersionControl.
      public function isBadVersion($version) {}
*/

abstract class VersionControl
{
    public function __construct(
        private int $badVersion
    ) {}

    protected function isBadVersion(int $version): bool
    {
        return $version >= $this->badVersion;
    }

    abstract public function firstBadVersion($n): int;
}

final class Solution extends VersionControl
{
    private int $leftBoundary;
    private int $rightBoundary;

    public function firstBadVersion($n): int
    {
        $this->leftBoundary = 1;
        $this->rightBoundary = $n;

        while ($this->rightBoundary - $this->leftBoundary > 1) {
            $this->compare($this->calculateNextVersion());
        }

        $this->compare($this->rightBoundary - 1);

        return $this->rightBoundary;
    }

    private function calculateNextVersion(): int
    {
        $center = ((int) round(($this->rightBoundary - $this->leftBoundary) / 2));

        return $this->leftBoundary + $center;
    }

    private function compare(int $ver): void
    {
        if ($this->isBadVersion($ver)) {
            $this->rightBoundary = $ver;
        } else {
            $this->leftBoundary = $ver;
        }
    }
}


/* Client code below */

$testCases = [
    [
        'startVersion' => 5,
        'badVersion' => 4,
    ],
    [
        'startVersion' => 5,
        'badVersion' => 3,
    ],
    [
        'startVersion' => 5,
        'badVersion' => 5,
    ],
    [
        'startVersion' => 1,
        'badVersion' => 1,
    ],
    [
        'startVersion' => 2,
        'badVersion' => 2,
    ],
    [
        'startVersion' => 2,
        'badVersion' => 1,
    ],
    [
        'startVersion' => 3,
        'badVersion' => 1,
    ],
    [
        'startVersion' => 3,
        'badVersion' => 3,
    ],
    [
        'startVersion' => 3,
        'badVersion' => 2,
    ],
    [
        'startVersion' => 12,
        'badVersion' => 10,
    ],
    [
        'startVersion' => 1212345,
        'badVersion' => 1012345,
    ],
];

foreach ($testCases as $t) {
    $startVersion = $t['startVersion'];
    $expectedBadVersion = $t['badVersion'];
    $solution = new Solution($expectedBadVersion);

    $badVersion = $solution->firstBadVersion($startVersion);

    assert($expectedBadVersion === $badVersion, "$expectedBadVersion !== $badVersion" . PHP_EOL);
    echo "$expectedBadVersion === $badVersion" . PHP_EOL;
}
