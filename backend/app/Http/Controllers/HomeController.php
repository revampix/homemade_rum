<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PerfCascade;

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

        $res = DB::select('SELECT `navigation_timings`.`page_view_id`, `navigation_timings`.`nt_nav_st`, `navigation_timings`.`nt_first_paint`
FROM `navigation_timings`
INNER JOIN `resource_timings` ON `navigation_timings`.`page_view_id` = `resource_timings`.`page_view_id`
GROUP BY `navigation_timings`.`guid`, `navigation_timings`.`page_view_id`
ORDER BY `navigation_timings`.`page_view_id` DESC;');


        $data = array(
            'firstPaintArr' => array(),
            'firstPaintArrPrevPeriod' => array(),
            'firstByteArr' => array(),
            'firstByteArrPrevPeriod' => array()
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
