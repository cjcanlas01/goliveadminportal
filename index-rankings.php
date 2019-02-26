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
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
    <style>
        .centerVal {
            width: 100%; 
            display: flex; 
            justify-content: center; 
            align-items: center;
        }
    </style>
</head>

<body>
	<?php include('addons/navbar.php') ?>

	<div class="container-fluid" id="side">
		<div class="row" id="sidenavbar">
			<?php include('addons/sidenav.html') ?>

		<div class="col-lg-10 col-md-9" id="mainarea">
			<div class="row">
				<h3 style="padding-left: 15px;">Rankings</h3>
			</div>

			<div class="row" style="padding-left: 15px;">
				 <section class="content-header">
				     <ol class="breadcrumb">
				        <li><a href="index-dashboard.php">Home</a></li>
				        <li class="active">/ Rankings</li>
				     </ol>
				</section>
			</div>

		    <!-- Tab links -->
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Subscriptions')" id="defaultOpen"><b>SUBSCRIPTIONS</b>
                </button>
                <button class="tablinks" onclick="openTab(event, 'Viewers')"><b>VIEWERS</b>
                </button>
                <button class="tablinks" onclick="openTab(event, 'Ratings')"><b>RATINGS</b>
                </button>
            </div>

         	<!-- Tab content -->
            <div id="Subscriptions" class="tabcontent">
                <div style="background-color: white; padding: 15px 15px 15px 15px;">
                    <div class="row" style="width: 600px;">
                        <div class='col-md-5'>
                            <p><b>Date Range:</b></p>
                            <input class="form-control" type="text" name="daterange" id="dr-subs"/>
                        </div>
                        <div class="col-md-5" style="padding-top: 35px;">
                            <button class="btn btn-primary form-control" id="dr-gen-subs" value="SUBSCRIPTIONS" style="font-size: 15px; margin-top: 5px; width: 150px;">GENERATE</button>
                        </div>
                    </div>
                    <br />
                    <div class="row centerVal">
                        <h3><b>SUBSCRIPTIONS RANK</b></h3>
                    </div>
                    <div class="row centerVal">
                        <p id="p-subs"></p>
                    </div>
                    <br />
                    <div class="centerVal">
                        <table border="0" style="width: 700px;">
                            <thead>
                                <tr>
                                    <td style="text-align: center;"><b>Email Address</b></td>
                                    <td></td>
                                    <td style="text-align: center;"><b>Count</b></td>
                                </tr>
                            </thead>
                            <tbody id="SubsRankContainer">
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>

            <div id="Viewers" class="tabcontent">
                <div style="background-color: white; padding: 15px 15px 15px 15px;">
                    <div class="row" style="width: 600px;">
                        <div class='col-md-5'>
                            <p><b>Date Range:</b></p>
                            <input class="form-control" type="text" name="daterange" id="dr-v"/>
                        </div>
                        <div class="col-md-5" style="padding-top: 35px;">
                            <button class="btn btn-primary form-control" id="dr-gen-v" value="VIEWERS" style="font-size: 15px; margin-top: 5px; width: 150px;">GENERATE</button>
                        </div>
                    </div>
                    <br />
                    <div class="row centerVal">
                        <h3><b>VIEWERS RANK</b></h3>
                    </div>
                    <div class="row centerVal">
                        <p id="p-views"></p>
                    </div>
                    <br />
                    <div class="centerVal">
                        <table border="0" style="width: 700px;">
                            <thead>
                                <tr>
                                    <td style="text-align: center;"><b>Email Address</b></td>
                                    <td></td>
                                    <td style="text-align: center;"><b>Count</b></td>
                                </tr>
                            </thead>
                            <tbody id="ViewsRankContainer">
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>

            <div id="Ratings" class="tabcontent">
                <div style="background-color: white; padding: 15px 15px 15px 15px;">
                    <div class="row" style="width: 600px;">
                        <div class='col-md-5'>
                            <p><b>Date Range:</b></p>
                            <input class="form-control" type="text" name="daterange" id="dr-r"/>
                        </div>
                        <div class="col-md-5" style="padding-top: 35px;">
                            <button class="btn btn-primary form-control" id="dr-gen-r" value="RATINGS" style="font-size: 15px; margin-top: 5px; width: 150px;">GENERATE</button>
                        </div>
                    </div>
                    <br />
                    <div class="row centerVal">
                        <h3><b>RATINGS RANK</b></h3>
                    </div>
                    <div class="row centerVal">
                        <p id="p-rates"></p>
                    </div>
                    <br />
                    <div class="centerVal">
                        <table border="0" style="width: 700px;">
                            <thead>
                                <tr>
                                    <td style="text-align: center;"><b>Email Address</b></td>
                                    <td></td>
                                    <td style="text-align: center;"><b>Count</b></td>
                                </tr>
                            </thead>
                            <tbody id="RatesRankContainer">
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/daterangepicker.js"></script>
		<script src="js/rankings.js"></script>
</body>

</html>