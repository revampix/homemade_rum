<?php
ini_set('display_errors', 1);

$conn = new mysqli();
$conn->connect('127.0.0.1', 'root', 'root', 'rum', 3306);

/**
 * Time to first PAINT
 */
$query = 'SELECT `navigation_timings`.`page_view_id`, `navigation_timings`.`nt_nav_st`, `navigation_timings`.`nt_first_paint`
FROM `navigation_timings`
INNER JOIN `resource_timings` ON `navigation_timings`.`page_view_id` = `resource_timings`.`page_view_id`
GROUP BY `navigation_timings`.`guid`
ORDER BY `navigation_timings`.`page_view_id` DESC;';

$res = $conn->query($query);

for($out = array(); $row = $res->fetch_assoc(); $out[] = $row);

$firstPaintArr = [];
$firstPaintArrPrevPeriod = [];

$groupMultiplier = 50;

$upperLimit = 8000;

for($i = $groupMultiplier; $i <= $upperLimit; $i += $groupMultiplier) {
    $firstPaintArr[$i] = 0;
    $firstPaintArrPrevPeriod[$i] = 0;
}

foreach ($out as $pageData) {
    $firstPaint = $pageData['nt_first_paint'] - $pageData['nt_nav_st'];
    if ($firstPaint < 0 || $firstPaint > $upperLimit) continue;

    $paintGroup = $groupMultiplier * (int) ($firstPaint / $groupMultiplier);

    $firstPaintArr[$paintGroup] += 8;

    //Originally should be because this will be when we have more real data
    //$firstPaintArr[$paintGroup]++;
}

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

/**
 * Time to first BYTE
 */
/**
 * Time to first PAINT
 */
$query = 'SELECT `navigation_timings`.`page_view_id`, `navigation_timings`.`nt_nav_st`, `navigation_timings`.`nt_res_st`
FROM `navigation_timings`
INNER JOIN `resource_timings` ON `navigation_timings`.`page_view_id` = `resource_timings`.`page_view_id`
GROUP BY `navigation_timings`.`guid`
ORDER BY `navigation_timings`.`page_view_id` DESC;';

$res = $conn->query($query);

for($out = array(); $row = $res->fetch_assoc(); $out[] = $row);

$firstByteArr = [];
$firstByteArrPrevPeriod = [];

$groupMultiplier = 50;

$upperLimit = 8000;

for($i = $groupMultiplier; $i <= $upperLimit; $i += $groupMultiplier) {
    $firstByteArr[$i] = 0;
    $firstByteArrPrevPeriod[$i] = 0;
}

foreach ($out as $pageData) {
    $firstByte = $pageData['nt_res_st'] - $pageData['nt_nav_st'];
    if ($firstByte < 0 || $firstByte > $upperLimit) continue;

    $byteGroup = $groupMultiplier * (int) ($firstByte / $groupMultiplier);

    $firstByteArr[$byteGroup] += 5;

    //Originally should be because this will be when we have more real data
    //$firstByteArr[$byteGroup]++;
}

//Fill the array for prev period just demo purpose we fill this array with random data
foreach ($firstByteArr as $key => $value) {
    if ($key > 50 && $value > 0) {
        $fakeValue = abs($value - rand(0, 7));
        if ($fakeValue > $value) {
            $fakeValue = $value;
        }
        $firstByteArrPrevPeriod[$key - 50] = $fakeValue;
    }
}

?>
<div id="timeToFirstPaint"></div>
<div id="timeToFirstByte"></div>
<script>
(function(){
    var x1 = <?php echo json_encode(array_keys($firstPaintArr)); ?>;
    var y1 = <?php echo json_encode(array_values($firstPaintArr)); ?>;

    var x2 = <?php echo json_encode(array_keys($firstPaintArrPrevPeriod)); ?>;
    var y2 = <?php echo json_encode(array_values($firstPaintArrPrevPeriod)); ?>;

    var prevPeriod = {
        x: x1,
        y: y1,
        type: 'bar',
        name: 'Prev Period',
        marker : {
            color: 'rgb(31, 119, 180)'
        }
    };

    var nextPeriod = {
        x: x2,
        y: y2,
        type: 'bar',
        opacity: 0.7,
        name: 'Next Period',
        marker: {
            color: 'rgb(255, 127, 14)'
        }
    };

    var layout = {
        barmode: "overlay",
        title: "Time To First Paint",
        xaxis: {
            rangemode: 'tozero',
            title: 'First Paint',
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
    Plotly.newPlot('timeToFirstPaint', data, layout);
})();
</script>
<script>
(function(){
    var x1 = <?php echo json_encode(array_keys($firstByteArr)); ?>;
    var y1 = <?php echo json_encode(array_values($firstByteArr)); ?>;

    var x2 = <?php echo json_encode(array_keys($firstByteArrPrevPeriod)); ?>;
    var y2 = <?php echo json_encode(array_values($firstByteArrPrevPeriod)); ?>;

    var prevPeriod = {
        x: x1,
        y: y1,
        type: 'bar',
        name: 'Prev Period',
        marker : {
            color: 'rgb(31, 119, 180)'
        }
    };

    var nextPeriod = {
        x: x2,
        y: y2,
        type: 'bar',
        opacity: 0.7,
        name: 'Next Period',
        marker: {
            color: 'rgb(255, 127, 14)'
        }
    };

    var layout = {
        barmode: "overlay",
        title: "Time To First Byte",
        xaxis: {
            rangemode: 'tozero',
            title: 'First Paint',
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
    Plotly.newPlot('timeToFirstByte', data, layout);
})();
</script>