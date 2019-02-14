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

</head>

<body>
	<?php include('addons/navbar.php') ?>

	<div class="container-fluid" id="side">
		<div class="row" id="sidenavbar">
			<?php include('addons/sidenav.html') ?>

		<div class="col-lg-10 col-md-9" id="mainarea">
			<div class="row">
				<h3 style="padding-left: 15px;">Reports</h3>
			</div>

			<div class="row" style="padding-left: 15px;">
				 <section class="content-header">
				     <ol class="breadcrumb">
				        <li><a href="index-dashboard.php">Home</a></li>
				        <li class="active">/ Reports</li>
				     </ol>
				</section>
			</div>

		    <!-- Tab links -->
            <div class="tab">
                <button class="tablinks res" onclick="openTab(event, 'UserList')" id="defaultOpen"><b>USERS LIST</b>
                </button>
                <button class="tablinks res" onclick="openTab(event, 'PackageRequest')"><b>PACKAGE REQUESTS</b>
                </button>
                <button class="tablinks res" onclick="openTab(event, 'DataExports')"><b>DATA EXPORTS</b>
                </button>
            </div>

         	<!-- Tab content -->
            <div id="UserList" class="tabcontent">
                <div style="background-color: white; padding: 15px 15px 15px 15px;">
                	<div class="row">
                        <div class="col-10-md" style="padding: 5px 5px 5px 5px;">
                            <input class="form-control" type="text" name="daterange" id="in-ul-r-dr" style="width: 300px;"/>
                        </div> 
                        <div class="col-2-md">
                            <button class="btn btn-primary form-control" id="btn-ul-r-generate" style="font-size: 15px; margin-top: 5px;">GENERATE</button>
                        </div>     		
                	</div>
                    <div class="row col-12-md" id='test' style="padding: 20px 5px 5px 5px;">
                         <object id="s-ul-r-pdf-obj" data="" type="application/pdf" style="width: 100%; height: 1200px; display: none;">
                            <embed id="sT-ul-r-pdf-obj" src="" type="application/pdf" />
                        </object>
                    </div>
                </div>
            </div>
            <div id="PackageRequest" class="tabcontent">
                <div style="background-color: white; padding: 15px 15px 15px 15px;">
                    <div class="row">
                        <div class="col-10-md" style="padding: 5px 5px 5px 5px;">
                            <input class="form-control" type="text" name="daterange" id="in-pr-r-dr" style="width: 300px;"/>
                        </div> 
                        <div class="col-2-md">
                            <button class="btn btn-primary form-control" id="btn-pr-r-generate" style="font-size: 15px; margin-top: 5px;">GENERATE</button>
                        </div>          
                    </div>
                    <div class="row col-12-md" id='test' style="padding: 20px 5px 5px 5px;">
                         <object id="s-pr-r-pdf-obj" data="" type="application/pdf" style="width: 100%; height: 1200px; display: none;">
                            <embed id="sT-pr-r-pdf-obj" src="" type="application/pdf"/>
                        </object>
                    </div>
                </div>
            </div>

            <div id="DataExports" class="tabcontent">
                <div style="background-color: white; padding: 15px 15px 15px 15px;">
                    <table border="0" style="width: 100%; font-size: 17px;">
                        <tr>
                            <td><b>Table</b></td>
                            <td><b>Date Range</b></td>
                            <td><b>Action</b></td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td>
                                <input class="form-control" type="text" name="daterange"/>
                            </td>
                            <td>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>XLSX</span>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>CSV</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Packages</td>
                            <td>
                                <input class="form-control" type="text" name="daterange"/>
                            </td>
                            <td>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>XLSX</span>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>CSV</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Videos</td>
                            <td>
                                <input class="form-control" type="text" name="daterange"/>
                            </td>
                            <td>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>XLSX</span>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>CSV</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Rates</td>
                            <td>
                                <input class="form-control" type="text" name="daterange"/>
                            </td>
                            <td>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>XLSX</span>
                                <span class='btn btn-primary' style='height: 35px; width: 70px;'>CSV</span>
                            </td>
                        </tr>
                    </table>    
                </div>
            </div>

                </div>
            </div>
        </div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/daterangepicker.js"></script>
		<script src="js/reports.js"></script>
</body>

</html>