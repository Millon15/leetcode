<?php declare(strict_types = 1);

class Solution
{
    /**
     * @param Integer[] $temperatures
     *
     * @return Integer[]
     */
    public function dailyTemperatures(array $temperatures): array
    {
        // TODO complitely rewrite the algo
        return $this->dailyTemperaturesExponent($temperatures);
    }

    /**
     * @param Integer[] $temperatures
     *
     * @return Integer[]
     */
    private function dailyTemperaturesExponent(array $temperatures): array
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
    private function dailyTemperaturesWrong(array $temperatures): array
    {
        $descendingTemperatures = $temperatures;
        $temperaturesLen = count($temperatures);
        $hotForecast = array_fill(0, $temperaturesLen, 0);

        arsort($descendingTemperatures);

        $hottestDays = [
            'earliest' => ['temperature' => current($descendingTemperatures), 'day' => key($descendingTemperatures)],
            'latest' => ['temperature' => current($descendingTemperatures), 'day' => key($descendingTemperatures)],
        ];
        $prevHottestDays = $hottestDays;

        foreach ($descendingTemperatures as $currentDay => $currentTemperature) {
            if ($currentTemperature < $hottestDays['latest']['temperature']) {
                if ($currentDay > $hottestDays['latest']['day']) {
                    $prevHottestDays['latest'] = $hottestDays['latest'];

                    $hottestDays['latest']['day'] = $currentDay;
                    $hottestDays['latest']['temperature'] = $currentTemperature;
                }

                $latestHotterDay = $prevHottestDays['latest']['day'];
            } else {
                $latestHotterDay = $hottestDays['latest']['day'];
            }

            if ($currentTemperature < $hottestDays['earliest']['temperature']) {
                if ($currentDay < $hottestDays['earliest']['day']) {
                    $prevHottestDays['earliest'] = $hottestDays['earliest'];

                    $hottestDays['earliest']['day'] = $currentDay;
                    $hottestDays['earliest']['temperature'] = $currentTemperature;
                }

                $earliestHotterDay = $prevHottestDays['earliest']['day'];
            } else {
                $earliestHotterDay = $hottestDays['earliest']['day'];
            }

            // Main algo
            if ($currentDay < $earliestHotterDay) {
                $hotForecast[$currentDay] = $earliestHotterDay - $currentDay;
            } elseif ($earliestHotterDay < $currentDay && $currentDay < $latestHotterDay) {
                $hotForecast[$currentDay] = $latestHotterDay - $currentDay;
            } elseif ($currentDay >= $latestHotterDay) {
                $hotForecast[$currentDay] = 0;
            }
        }

        return $hotForecast;
    }
}


/* Client code below */

$solution = new Solution();
$testCases = [
    [
        'temperatures' => [75,71,69,72],
        'expectedHotForecast' => [0,2,1,0],
    ],
    [
        'temperatures' => [80,90,73,74,75,71,69,69,69,69,72,76,76,76,73],
        'expectedHotForecast' => [1,0,1,1,6,5,4,3,2,1,1,0,0,0,0],
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
