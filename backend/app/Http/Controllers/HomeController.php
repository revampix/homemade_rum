<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PerfCascade;
use App\DataFaker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        //Move fetch from db to a model
        $res = DB::select('SELECT `navigation_timings`.`page_view_id`, `navigation_timings`.`url`
FROM `navigation_timings`
INNER JOIN `resource_timings` ON `navigation_timings`.`page_view_id` = `resource_timings`.`page_view_id`
GROUP BY `navigation_timings`.`page_view_id`
ORDER BY `navigation_timings`.`page_view_id` DESC
LIMIT 20;');

        $out = array();
        foreach ($res as $response)
        {
            $out[] = (array) $response;
        }


        return view('dashboard', array('out' => $out));
    }

    public function histograms()
    {

        $dataFaker = new DataFaker();
        $firstPaintArr = [];
        $firstPaintArrPrevPeriod = [];
        $groupMultiplier = 50;
        $upperLimit = 8000;
        for($i = $groupMultiplier; $i <= $upperLimit; $i += $groupMultiplier) {
            $firstPaintArr[$i] = 0;
            $firstPaintArrPrevPeriod[$i] = 0;
        }

        $firstPaintArr = $dataFaker->generateFirstPaint();
        //Fill the array for prev period just demo purpose we fill this array with random data
        foreach ($firstPaintArr as $key => $value) {
            if ($key > 50 && $value > 0) {
                $fakeValue = abs($value - rand(1, 5));
                if ($fakeValue > $value) {
                    $fakeValue = $value;
                }
                $firstPaintArrPrevPeriod[$key - 50] = $fakeValue;
            }
        }

        $firstByteArr = [];
        $firstByteArrPrevPeriod = [];
        $bounceRateGroupRangeVsPercentage = $dataFaker->generateBounceRate();



        $data = array(
            'firstPaintArr' => $firstPaintArr,
            'firstPaintArrPrevPeriod' => $firstPaintArrPrevPeriod,
            'firstByteArr' => $firstByteArr,
            'firstByteArrPrevPeriod' => $firstByteArrPrevPeriod,
            'bounceRateGroupRangeVsPercentage' => $bounceRateGroupRangeVsPercentage
        );

        return view('histograms', $data);
    }

    public function waterfalls()
    {
        //Move fetch from db to a model
        $res = DB::select('SELECT `navigation_timings`.`page_view_id`, `navigation_timings`.`url`
FROM `navigation_timings`
INNER JOIN `resource_timings` ON `navigation_timings`.`page_view_id` = `resource_timings`.`page_view_id`
GROUP BY `navigation_timings`.`page_view_id`
ORDER BY `navigation_timings`.`page_view_id` DESC');

        $out = array();
        foreach ($res as $response)
        {
            $out[] = (array) $response;
        }

        $data = array(
            'out' => $out
        );

        return view('waterfalls', $data);
    }

    public function waterfallView($pageViewId)
    {
        $res = DB::select('SELECT * FROM `navigation_timings` where `page_view_id` = ' . $pageViewId);
        $navigationTimings = (array) current($res);

        $timingsResponse = DB::select('SELECT * FROM `resource_timings` where `page_view_id` = '  . $pageViewId);

        $resourceTimings = array();
        foreach ($timingsResponse as $response)
        {
            $resourceTimings[] = (array) $response;
        }
        $navigationTimings['restiming'] = $resourceTimings;


        $perfCascade = new PerfCascade();


        return response()->json($perfCascade->boomerangToPerfCascade($navigationTimings));

    }
}
