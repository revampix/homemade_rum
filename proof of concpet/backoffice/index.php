<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>(Home Made) RUM</title>
		<meta name="description" content="(Home Made) RUM - Backoffice">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="css/style_v1.css" rel="stylesheet">
		<link href="css/waterfall.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<!--Start Header-->
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="/index.php" style="font-weight: bold;">(Home Made) <span style="color: #159588">R</span><span style="color: #436E90">U</span><span style="color: #c141cd">M</span></a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-8">
                        <ul class="nav navbar-nav pull-left panel-menu">
                            <li>
                                <a href="ajax/dashboard.php" class="ajax-link">
                                    <i class="fa fa-dashboard"></i>
                                    <span class="hidden-xs">Dashboard</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bar-chart-o"></i>
                                    Histograms
                                    <span class="caret">
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/histograms/bounce-rate-vs-ttfp-histogram.php">Bounce Rate Vs. First Paint</a></li>
                                    <li><a class="ajax-link" href="ajax/histograms/conversion-rate-vs-ttfp-histogram.php">Conversion Rate Vs. First Paint</a></li>
                                    <li><a class="ajax-link" href="ajax/histograms/sprint-comparison-histograms.php">Release 92 Vs. Release 93</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="ajax-link" href="ajax/waterfalls.php">
                                    <i class="fa fa-align-left"></i>
                                    Waterfalls
                                </a>
                            </li>
                        </ul>
					</div>
					<div class="col-xs-4 col-sm-4 top-panel-right">
						<ul class="nav navbar-nav pull-right panel-menu">
							<li>
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<img src="img/avatar.jpg" class="img-circle" alt="avatar" />
									</div>
									<div class="user-mini pull-right">
										<span class="welcome">Welcome,</span>
										<span>Performance Meet-up</span>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-12">
			<div class="preloader">
				<img src="img/devoops_getdata.gif" class="devoops-getdata" alt="preloader"/>
			</div>
			<div id="ajax-content"></div>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/perf-cascade/perf-cascade.min.js"></script>
<script src="plugins/perf-cascade/perf-cascade-file-reader.min.js"></script>
<script src="plugins/plotly/plotly.1.31.2.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
</body>
</html>