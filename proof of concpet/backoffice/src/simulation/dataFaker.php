<?php
class HomemadeRum_Simulation_DataFaker
{

    const UPPER_LIMIT = 8000;

    /**
     * @return array
     */
    public function generateBounceRate()
    {
        // Generate bounce rate
        $bounceRateGroupsCount = self::UPPER_LIMIT / 50;
        $bounceRateGroupRangeVsPercentage = [];

        for ($i = 0; $bounceRateGroupsCount > $i; $i++) {
            $group = $i * 50;

            $bounceRate = 0;

            if ($group >= 0 && $group <= 200) {
                $bounceRate = rand(25, 30);
            }

            if ($group > 200 && $group <= 700) {
                $bounceRate = rand(28, 35);
            }

            if ($group > 700 && $group <= 1000) {
                $bounceRate = rand(20, 27);
            }

            if ($group > 1000 && $group <= 1300) {
                $bounceRate = rand(22, 27);
            }

            if ($group > 1000 && $group <= 1300) {
                $bounceRate = rand(22, 27);
            }


            if ($group > 1300 && $group <= 1700) {
                $bounceRate = rand(25, 29);
            }

            if ($group > 1700 && $group <= 2100) {
                $bounceRate = rand(27, 33);
            }

            if ($group > 2100 && $group <= 2400) {
                $bounceRate = rand(30, 35);
            }

            if ($group > 2400 && $group <= 3000) {
                $bounceRate = rand(34, 41);
            }

            if ($group > 3000 && $group <= 4000) {
                $bounceRate = rand(40, 50);
            }

            if ($group > 4000 && $group <= 5500) {
                $bounceRate = rand(45, 55);
            }

            if ($group > 5500 && $group <= 7000) {
                $bounceRate = rand(42, 58);
            }

            if ($group > 7000 && $group <= 8000) {
                $bounceRate = rand(58, 65);
            }

            if ($bounceRate === 0) {
                $bounceRate = rand(1, 30);
            }

            $bounceRateGroupRangeVsPercentage[$group] = $bounceRate;
        }

        return $bounceRateGroupRangeVsPercentage;
    }

    /**
     * @return array
     */
    public function generateFirstPaint()
    {
        // Generate bounce rate
        $firstPaintGroupsCount = self::UPPER_LIMIT / 50;
        $firstPaintsArr = [];

        for ($i = 0; $firstPaintGroupsCount > $i; $i++) {
            $group = $i * 50;

            $firstPaints = 0;

            if ($group >= 0 && $group <= 200) {
                $firstPaints = rand(25, 30);
            }

            if ($group > 200 && $group <= 700) {
                $firstPaints = rand(18, 24);
            }

            if ($group > 700 && $group <= 1000) {
                $firstPaints = rand(20, 25);
            }

            if ($group > 1000 && $group <= 1300) {
                $firstPaints = rand(22, 28);
            }

            if ($group > 1000 && $group <= 1300) {
                $firstPaints = rand(23, 25);
            }


            if ($group > 1300 && $group <= 1700) {
                $firstPaints = rand(22, 24);
            }

            if ($group > 1700 && $group <= 2100) {
                $firstPaints = rand(27, 33);
            }

            if ($group > 2100 && $group <= 2400) {
                $firstPaints = rand(30, 35);
            }

            if ($group > 2400 && $group <= 3000) {
                $firstPaints = rand(31, 38);
            }

            if ($group > 3000 && $group <= 4000) {
                $firstPaints = rand(24, 37);
            }

            if ($group > 4000 && $group <= 5500) {
                $firstPaints = rand(13, 22);
            }

            if ($group > 5500 && $group <= 7000) {
                $firstPaints = rand(11, 18);
            }

            if ($group > 7000 && $group <= 8000) {
                $firstPaints = rand(9, 17);
            }

            if ($firstPaints === 0) {
                $firstPaints = rand(1, 5);
            }

            if ($group >= 700 && $group <= 5200) {
                $firstPaints *= 3;
            }

            $firstPaintsArr[$group] = $firstPaints * 27;
        }

        return $firstPaintsArr;
    }

}