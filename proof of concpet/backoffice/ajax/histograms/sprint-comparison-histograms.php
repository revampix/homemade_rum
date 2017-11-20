<?php
ini_set('display_errors', 1);

require_once __DIR__ . '/../../src/simulation/dataFaker.php';

$dataFaker = new HomemadeRum_Simulation_DataFaker();

$firstPaintArr = [];
$firstPaintArrPrevPeriod = [];

$groupMultiplier = 50;

$upperLimit = 8000;

for($i = $groupMultiplier; $i <= $upperLimit; $i += $groupMultiplier) {
    $firstPaintArr[$i] = 0;
    $firstPaintArrPrevPeriod[$i] = 0;
}

//foreach ($out as $pageData) {
//    $firstPaint = $pageData['nt_first_paint'] - $pageData['nt_nav_st'];
//    if ($firstPaint < 0 || $firstPaint > $upperLimit) continue;
//
//    $paintGroup = $groupMultiplier * (int) ($firstPaint / $groupMultiplier);
//
//    $firstPaintArr[$paintGroup] += 8;
//
//    //Originally should be because this will be when we have more real data
//    //$firstPaintArr[$paintGroup]++;
//}

$firstPaintArr = $dataFaker->generateFirstPaint();

//Fill the array for prev period just demo purpose we fill this array with random data
foreach ($firstPaintArr as $key => $value) {
    if ($key > 100 && $value > 0) {
        $fakeValue = $value;
        $firstPaintArrPrevPeriod[$key + 150] = $fakeValue;
    }
}

/**
 * Time to first BYTE
 */

$bounceRateGroupRangeVsPercentage = $dataFaker->generateBounceRate();
$conversionRateGroupRangeVsPercentage = $dataFaker->generateConversionRate();

?>
<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <ol class="breadcrumb pull-left">
            <li><a href="#">Release 92 Vs. Release 93</a></li>
        </ol>
        <div id="social" class="pull-right">
            <a target="_blank" href="https://github.com/revampix/homemade_rum"><i class="fa fa-github"></i></a>
            <a target="_blank" href="https://www.facebook.com/tsvetan.stoychev.9"><i class="fa fa-facebook"></i></a>
            <a target="_blank" href="https://twitter.com/ceckoslab"><i class="fa fa-twitter"></i></a>
            <a target="_blank" href="https://www.linkedin.com/in/tsvetanstoychev/"><i class="fa fa-linkedin"></i></a>
            <a target="_blank" href="https://www.youtube.com/user/ceckoslab/videos?sort=dd&view=0&shelf_id=0"><i class="fa fa-youtube"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-2"></div>
    <div class="col-xs-12 col-sm-8" style="text-align: center;">
        <span style="display: inline-block; border: 2px dashed dimgray; background: #ffff00; padding: 5px;">
            The graphics below are based on automatically generated data due to not enough real data from <a href="https://www.darvart.de">www.darvart.de</a>
        </span>
    </div>
    <div class="col-xs-12 col-sm-2"></div>
</div>
<br />
<div class="row">
    <form>
        <div class="col-xs-12 col-sm-4">
            <fieldset>
                <legend>Visitor Segmentation:</legend>
                <div class="form-group">
                    <label for="source">Traffic Source:</label>
                    <select class="form-control" id="source">
                        <option selected="selected">Organic</option>
                        <option disabled>Email Campaign</option>
                        <option disabled>AdSense</option>
                        <option disabled>Direct</option>
                    </select>
                </div>
            </fieldset>
        </div>
        <div class="col-xs-12 col-sm-4">
            <fieldset>
                <legend>Period</legend>
                <div class="form-group">
                    <label>Date Range:</label>
                    <br />
                    <input style="width: 80px" type="text" id="from_date" name="from" value="10/05/2017">
                    -
                    <input style="width: 80px" type="text" id="to_date" name="to" value="10/24/2017">
                    <label><input type="checkbox" checked /> Compare with previous period</label>
                    <br />
                    <input style="width: 80px" type="text" id="to_date_prev" name="from" value="9/15/2017">
                    -
                    <input style="width: 80px" type="text" id="from_date_prev" name="to" value="10/4/2017">
                </div>
            </fieldset>
        </div>
        <div class="col-xs-12 col-sm-4">
            <fieldset>
                <legend>GA Metrics</legend>
                <div class="form-group">
                    <label><input type="checkbox" disabled /> Bounce Rate</label>
                    <br />
                    <label><input type="checkbox" disabled /> Conversion Rate</label>
                    <br />
                </div>
            </fieldset>
        </div>
    </form>
    <script type="text/javascript">
        $( function() {
            $("#to_date, #from_date, #to_date_prev, #from_date_prev").datepicker();
        } );
    </script>
</div>
<div id="timeToFirstPaintPrevVsNextPeriod"></div>
<script>
(function(){
    var x1 = <?php echo json_encode(array_keys($firstPaintArrPrevPeriod)); ?>;
    var y1 = <?php echo json_encode(array_values($firstPaintArrPrevPeriod)); ?>;

    var x2 = <?php echo json_encode(array_keys($firstPaintArr)); ?>;
    var y2 = <?php echo json_encode(array_values($firstPaintArr)); ?>;

    var prevPeriod = {
        x: x1,
        y: y1,
        type: 'bar',
        name: 'Release 92',
        marker : {
            color: 'rgb(31, 119, 180)'
        }
    };

    var nextPeriod = {
        x: x2,
        y: y2,
        type: 'bar',
        opacity: 0.6,
        name: 'Release 93',
        marker: {
            color: 'rgb(255, 127, 14)'
        }
    };

    var layout = {
        barmode: "overlay",
        title: "Time To First Byte",
        xaxis: {
            rangemode: 'tozero',
            title: 'First byte',
            autotick: false,
            ticks: 'outside',
            tick0: 0,
            dtick: 200,
            ticklen: 5,
            tickwidth: 2,
            tickcolor: '#000'
        },
        yaxis: {
            title: 'Count'
        }
    };

    var data = [prevPeriod, nextPeriod];
    Plotly.newPlot('timeToFirstPaintPrevVsNextPeriod', data, layout);
})();
</script>