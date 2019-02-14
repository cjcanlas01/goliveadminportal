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
	<link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="css/general.css">

</head>

<body>
	<?php include('addons/navbar.php') ?>

	<div class="container-fluid" id="side">
		<div class="row" id="sidenavbar">
			<?php include('addons/sidenav.html') ?>

		<div class="col-lg-10" id="mainarea">
			<div class="row">
				<h3 style="padding-left: 15px;">Video Stream Deletion</h3>
			</div>

			<div class="row" style="padding-left: 15px;">
				 <section class="content-header">
				     <ol class="breadcrumb">
				        <li><a href="index-dashboard.php">Home</a></li>
				        <li class="active">/ Video Stream Deletion</li>
				     </ol>
				</section>
			</div>

			<div class="row" style="background-color: #ecf0f1; padding: 15px 15px 15px 15px;">
				<table width="100%">
					<tr>
						<th>User Email Address</th>
						<th>Title</th>
						<th>Size</th>
						<th>Confirmation</th>
					</tr>
					<tr>
						<td>cjcanlas78@gmail.com</td>
						<td>RUSH SELLING: TITAN GEL (SLIGHTLY USED)</td>
						<td>69mb</td>
						<td>
							<div><button class="btn btn-primary"><i class="fa fa-check"></i></button></div>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/popper.min.js"></script>
</body>

</html>