<?php
ini_set('display_errors', 1);

$pageViewId = !empty($_GET) ? $_GET : $_POST;

$conn = new mysqli();
$conn->connect('127.0.0.1', 'root', 'root', 'rum', 3306);

$query = 'SELECT `navigation_timings`.`page_view_id`, `navigation_timings`.`url`
FROM `navigation_timings`
INNER JOIN `resource_timings` ON `navigation_timings`.`page_view_id` = `resource_timings`.`page_view_id`
GROUP BY `navigation_timings`.`page_view_id`
ORDER BY `navigation_timings`.`page_view_id` DESC';

$res = $conn->query($query);

for($out = array(); $row = $res->fetch_assoc(); $out[] = $row);
?>
<!--Start Breadcrumb-->
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="#">Dashboard</a></li>
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
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div id="dashboard-header" class="row">
	<div class="col-xs-12 col-sm-4 col-md-5">
		<h3>All Page Views</h3>
	</div>
	<div class="clearfix visible-xs"></div>
	<div class="col-xs-12 col-sm-8 col-md-7 pull-right"></div>
</div>
<!--End Dashboard 1-->
<!--Start Dashboard 2-->
<div class="row-fluid">
	<div id="dashboard" class="col-xs-12 col-sm-12">
		<!--Start Dashboard Tab 1-->
		<div id="dashboard-overview" class="row">
			<div id="becons-list" class="col-sm-12 col-md-6">
                <div id="beacons-list">
                    <h3>Page Views</h3>
                    <div id="table-scroll">
                        <table>
                            <?php
                                $i = 1;
                                foreach ($out as $resTiming) : ?>
                                <tr class="<?php echo ($i % 2) === 0 ? 'even' : 'odd'; ?>">
                                    <td><?php echo $i++; ?></td>
                                    <td>
                                        <a class="becon-link"
                                           href="/src/waterfall/view.php?page_view_id=<?php echo $resTiming['page_view_id'] ?>"><?php echo $resTiming['url'] ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
			    </div>
		    </div>
            <div class="col-sm-12 col-md-6">
                <div id="waterfall-container">
                    <h3>Waterfall digramm</h3>
                    <div id="legend-holder">
                        <ul class="resource-legend">
                            <li class="legend-blocked" title="Time spent in a queue waiting for a network connection.">Blocked</li>
                            <li class="legend-dns" title="DNS resolution time.">DNS</li>
                            <li class="legend-connect" title="Time required to create TCP connection.">Connect</li>
                            <li class="legend-ssl" title="Time required for SSL/TLS negotiation.">SSL (TLS)</li>
                            <li class="legend-send" title="Time required to send HTTP request to the server.">Send</li>
                            <li class="legend-wait" title="Waiting for a response from the server.">Wait</li>
                            <li class="legend-receive" title="Time required to read entire response from the server (or cache).">
                                Receive
                            </li>
                        </ul>
                    </div>
                    <div id="waterfall-view"></div>
                </div>
            </div>
	    </div>
	</div>
	<div class="clearfix"></div>
</div>
<!--End Dashboard 2 -->
<div style="height: 40px;"></div>

<script src="../plugins/perf-cascade/init.js"></script>