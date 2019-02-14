<!DOCTYPE html>
<html lang="en">
<?php
	include('php/session.php');
?>
<head>
	<meta charset="UTF-8">
	<title>GoLive: Admin Portal</title>
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="resources/logoopt5.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="stylesheet" href="morris/morris.css">
	<style type="text/css">
		#rightpan {
			padding-left: 40px;
		}
		
		#tab {
			padding: 20px 20px;
		}
		
		#accountset {
			padding: 20px 20px;
			font-size: 25px;
		}
		
		#profilecontent {
			margin: 10px;
		}
		
		#vid1 {
			height: 100%;
			width: 100%;
			border-radius: 3px;
			background-color: #ecf0f1;
		}
		
		#insideshape1 {
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
			background-color: #3498db;
			position: absolute;
		}
		#insideshape2 {
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
			background-color: #27ae60;
			position: absolute;
		}
		#insideshape3 {
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
			background-color: #e67e22;
			position: absolute;
		}
		#insideshape4 {
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
			background-color: #c0392b;
			position: absolute;
		}

		#datatop {
			padding-top: 5px;
			font-size: 15px;
			margin-left: 125px;
		}

		#databot {
			padding-top: 3px;
			font-size: 18px;
			font-weight: bold;
			margin-left: 125px;
		}

		#dashicon {
			color:white;
			font-size: 50px;
			margin-top: 50%;
			margin-left: 50%;
			transform: translate(-50%, -50%);
		}
	</style>
</head>

<body>
	<?php include('addons/navbar.php') ?>

	<div class="container-fluid">
		<div class="row" id="sidenavbar">
			<?php include('addons/sidenav.html') ?>

		<div class="col-lg-10" id="mainarea">
			<div class="row">
				<h3 style="padding-left: 15px;">Dashboard</h3>
			</div>

			<div class="row" style="padding-left: 15px;">
				 <section class="content-header" >
				     <ol class="breadcrumb">
				        <li><a href="index-dashboard.php">Home</a></li>
				        <li class="active">/ Dashboard</li>
				     </ol>
				</section>
			</div>

			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3" style=" height: 110px;">
						<div class="square" id="vid1">
							<div style=" height: 110px; width: 110px;" id="insideshape1">
								<i class='fas fa-user' id="dashicon"></i>
							</div>
							<div id="datatop"></i>USERS</div>
							<div id="databot"><span id="usercount"></span></div>
						</div>
					</div>
					<div class="col-lg-3" style=" height: 110px;">
						<div class="square" id="vid1">
							<div style=" height: 110px; width: 110px;" id="insideshape2">
								<i class='fas fa-box-open' id="dashicon"></i>
							</div>
							<div id="datatop">PACKAGES</div>
							<div id="databot"><span id="packagecount"></span></div>
						</div>
					</div>
					<div class="col-lg-3" style=" height: 110px;">
						<div class="square" id="vid1">
							<div style=" height: 110px; width: 110px;" id="insideshape3">
								<i class='fas fa-video' id="dashicon"></i>
							</div>
							<div id="datatop">VIDEOS SAVED</div>
							<div id="databot"><span id="videosaved"></div>
						</div>
					</div>
					<div class="col-lg-3" style=" height: 110px;">
						<div class="square" id="vid1">
							<div style=" height: 110px; width: 110px;" id="insideshape4">
								<i class='fas fa-file-alt' id="dashicon"></i>
							</div>
							<div id="datatop">REQUESTS</div>
							<div id="databot"><span id="requests"></div>
						</div>
					</div>
				</div>

				<div style="padding-top: 3%;">
					<h4>USER REGISTRATION</h4>
					<div class="row" style="background-color: #ecf0f1;">
						<div id="testChart" style="width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="raphael/raphael.min.js"></script>
		<script src="morris/morris.min.js"></script>
		<script src="js/sweetalert2.all.min.js"></script>
		<script src="js/dashboard.js"></script>
</body>
</html>