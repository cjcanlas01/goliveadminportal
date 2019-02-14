<!DOCTYPE html>
<html lang="en">
<?php include('php/session.php'); ?>
<head>
	<meta charset="UTF-8">
	<title>GoLive: Admin Portal</title>
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="resources/logoopt5.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
</head>

<body>
	<?php include('addons/navbar.php') ?>

	<div class="container-fluid" id="side">
		<div class="row" id="sidenavbar">
		<?php include('addons/sidenav.html') ?>

		<div class="col-lg-10" id="mainarea">
			<div class="row">
				<h3 style="padding-left: 15px;">Account Registry</h3>
			</div>

			<div class="row" style="padding-left: 15px;">
				 <section class="content-header">
				     <ol class="breadcrumb">
				        <li><a href="index-dashboard.php">Home</a></li>
				        <li class="active">/ Account Registry</li>
				     </ol>
				</section>
			</div>

			<!-- Tab links -->
			<div class="tab">
			  <button class="tablinks" onclick="openTab(event, 'AccApproval')" id="defaultOpen"><b>USER ACCOUNT APPROVAL</b></button>
			  <button class="tablinks" onclick="openTab(event, 'AdminAcc')"><b>ADMIN ACCOUNT</b></button>
			  <!-- <button data-toggle="modal" data-target="#processmodal"><b>Create Admin Account</b></button> -->
			</div>

			<!-- Tab content -->
			<div id="AccApproval" class="tabcontent">
				<div style="background-color: white; padding: 15px 15px 15px 15px;">
					<table style="width: 100%;" id="accounts">
						<tr>
							<thead>
								<th>Email</th>
								<th>Business Name</th>
								<th>Address</th>
								<th>Phone Number</th>
								<th>Date</th>
								<th>Action</th>
							</thead>
						</tr>
					</table>
				</div> 
			</div>

			<div id="AdminAcc" class="tabcontent">
				<div style="background-color: white; padding: 15px 15px 15px 15px;">
				    <div class="row" style="align-content: center; padding-left: 1px; margin: 1% 1% 1% 0%;">
                        <span class="btn btn-primary fas fa-plus" id="btn_addadmin" data-toggle="modal" data-target="#ar-inputmodal">
                        </span>
                    </div>
                    <table style="width: 100%;" id="adminaccounts">
						<thead>
							<tr>
								<th>Email</th>
								<th>Passcode</th>
								<th>Action</th>
                    		</tr>
						</thead>
                    </table>
				</div> 
			</div>

		<!-- MODAL FOR ALERT ONLY -->
		<div class="modal fade" id="ar-confirmmodal" tabindex="-1" role="dialog" aria-labelledby="ar-cm-label" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="ar-cm-label">Confirmation</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" id="ar-cm-body" style="display: flex; justify-content: center; align-items: center;">
		      	<h2>Are you sure?</h2>
		      </div>
			  <div class="modal-footer">
			    <button class="btn btn-primary" type="submit" id="ar-cm-confirm"><a></a>Yes</button>
			    <button class="btn btn-secondary" data-dismiss="modal">No</button>
			  </div>
		    </div>
		  </div>
		</div>
	
		<!-- MODAL FOR PROCESS IMPLEMENTATION -->
		<div class="modal fade" id="ar-inputmodal" tabindex="-1" role="dialog" aria-labelledby="ar-im-label" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="ar-im-label"></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form>
		      		<div id="ar-im-body">
		      			<div class="form-group">
		      				<label for="">Email Address</label>
		      				<input type="email" class="form-control" id="emailadd">
		      			</div>
		      			<div class="form-group">
		      				<label for="">Password</label>
		      				<input type="password" class="form-control" id="password">
		      			</div>'
		      		</div>
		      	</form>
		      </div>
			  <div class="modal-footer">
			    <button class="btn btn-primary" type="submit" id="ar-im-confirm">Create</button>
			    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			  </div>
		    </div>
		  </div>
		</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="datatables/datatables.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="js/accountregistry.js.php"></script>
</body>
</html>