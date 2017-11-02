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