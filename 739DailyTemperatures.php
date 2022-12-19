<?php
declare(strict_types = 1);

class Solution
{
    /**
     * @param Integer[] $temperatures
     *
     * @return Integer[]
     */
    public function dailyTemperaturesExponent(array $temperatures): array
    {
        $temperaturesLen = count($temperatures);
        $hotForecast = array_fill(0, $temperaturesLen, 0);
        $hotForecastStatus = array_fill(0, $temperaturesLen, false);

        foreach ($temperatures as $day => $currentDayTemperature) {
            for ($forecastDay = 0; $forecastDay <= $day; ++$forecastDay) {
                if ($hotForecastStatus[$forecastDay]) {
                    continue;
                }

                if ($temperatures[$forecastDay] >= $currentDayTemperature) {
                    ++$hotForecast[$forecastDay];
                } else {
                    $hotForecastStatus[$forecastDay] = true;
                }
            }
        }

        for ($forecastDay = $temperaturesLen - 1; $forecastDay >= 0; --$forecastDay) {
            if (false === $hotForecastStatus[$forecastDay]) {
                $hotForecast[$forecastDay] = 0;
            }
        }

        return $hotForecast;
    }

    /**
     * @param Integer[] $temperatures
     *
     * @return Integer[]
     */
    public function dailyTemperatures(array $temperatures): array
    {

    }
}


/* Client code below */

$solution = new Solution();
$testCases = [
    [
        'temperatures' => [73,74,75,71,69,72,76,73],
        'expectedHotForecast' => [1,1,4,2,1,1,0,0],
    ],
    [
        'temperatures' => [30,40,50,60],
        'expectedHotForecast' => [1,1,1,0],
    ],
    [
        'temperatures' => [30,60,90],
        'expectedHotForecast' => [1,1,0],
    ],
    [
        'temperatures' => [55,38,53,81,61,93,97,32,43,78],
        'expectedHotForecast' => [3,1,1,2,1,1,0,1,1,0],
    ],
];

foreach ($testCases as $testCase) {
    $temperatures = $testCase['temperatures'];
    $expectedHotForecast = $testCase['expectedHotForecast'];

    $hotForecast = $solution->dailyTemperatures($temperatures);

    $errorMessage = PHP_EOL
        . '$temperatures = '
        . var_export($temperatures, true)
        . PHP_EOL
        . '$expectedHotForecast = '
        . var_export($expectedHotForecast, true)
        . PHP_EOL
        . '$hotForecast = '
        . var_export($hotForecast, true)
        . PHP_EOL
    ;
    assert($expectedHotForecast === $hotForecast, $errorMessage);
}
