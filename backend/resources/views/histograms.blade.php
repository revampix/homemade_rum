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
                    <label><input type="checkbox" checked /> Bounce Rate</label>
                    <br />
                    <label><input type="checkbox" checked /> Conversion Rate</label>
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
            name: '9/15/2017 - 10/4/2017',
            marker : {
                color: 'rgb(31, 119, 180)'
            }
        };
        var nextPeriod = {
            x: x2,
            y: y2,
            type: 'bar',
            opacity: 0.7,
            name: '10/05/2017 - 10/24/2017',
            marker: {
                color: 'rgb(255, 127, 14)'
            }
        };
        var bounceRate = {
            x: <?php echo json_encode(array_keys($bounceRateGroupRangeVsPercentage)); ?>,
            y: <?php echo json_encode(array_values($bounceRateGroupRangeVsPercentage)); ?>,
            type: 'scatter',
            name: 'Bounce Rate',
            marker: {
                color: 'rgb(255, 127, 14)'
            },
            xaxis: 'x2',
            yaxis: 'y2'
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
                tickcolor: '#000',
                range: [0, 8000]
            },
            yaxis: {
                title: 'Count',
                domain: [0, 0.65]
            },
            xaxis2: {
                anchor: 'y2',
                rangemode: 'tozero',
                title: 'Bounce Rate',
                //autotick: false,
                //ticks: 'outside',
                tick0: 0,
                dtick: 200,
                ticklen: 5,
                tickwidth: 2,
                tickcolor: '#000',
                range: [0, 8000],
//            autorange: true,
                showgrid: false,
                zeroline: false,
                showline: false,
                autotick: true,
                ticks: '',
                showticklabels: false
            },
            yaxis2: {
                domain: [0.7, 1]
            }
        };
        var defaultPlotlyConfiguration = { modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d'], displaylogo: false, showTips: true };
        var data = [prevPeriod, bounceRate];
        Plotly.newPlot('timeToFirstPaint', data, layout, defaultPlotlyConfiguration);
    })();
</script>