<!DOCTYPE html>
<html lang="en">
<?php include( 'php/session.php'); ?>

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
                    <h3 style="padding-left: 15px;">Package Management</h3>
                    <span class="btn btn-primary" style="right: 30px; position: absolute;">Tools</span>
                </div>

                <div class="row" style="padding-left: 15px;">
                    <section class="content-header">
                        <ol class="breadcrumb">
                            <li><a href="index-dashboard.php">Home</a>
                            </li>
                            <li class="active">/ Package Management</li>
                        </ol>
                    </section>
                </div>

                <!-- Tab links -->
                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'TopUp')" id="defaultOpen"><b>TOP UP</b>
                    </button>
                    <button class="tablinks" onclick="openTab(event, 'Customize')"><b>CUSTOMIZE</b>
                    </button>
                </div>

                <!-- Tab content -->
                <div id="TopUp" class="tabcontent">
                    <div style="background-color: white; padding: 15px 15px 15px 15px;">
						<table style="width: 100%;" id="requests">
							<thead>
								<tr>
									<th>Email Address</th>
									<th>Business Name</th>
									<th>Package Type</th>
									<th>Duration (Minutes)</th>
									<th>Price</th>
                                    <th></th>
                                    <th>Action</th>
								</tr>
							</thead>
						</table>
                    </div>
                </div>

                <div id="Customize" class="tabcontent">
                    <div style="background-color: white; padding: 15px 15px 15px 15px;">
                        <div class="row" style="align-content: center; padding-left: 1px; margin: 1% 1% 1% 0%;">
                            <span class="btn btn-primary fas fa-plus" id="btn_addpackage" data-toggle="modal" data-target="#mp-inputmodal">
                            </span>
                        </div>
                        <table style="width: 100%;" id="packages">
							<thead>
								<tr>
	                        		<th>Package Name</th>
                                    <th>Duration (Minutes)</th>
                                    <th>Price</th>
	                        		<th>Customize</th>
                        		</tr>
							</thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BASA!!!: Modal for Alert -->
            <div class="modal fade" id="mp-confirmmodal" tabindex="-1" role="dialog" aria-labelledby="mp-cm-label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mp-cm-label">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body" id="mp-cm-body" style="display: flex; justify-content: center; align-items: center;">
                                <h2>Are you sure?</h2>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="mp-cm-confirm"><a></a>Yes</button>
                                <button class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- BASA!!!: Modal for Alert -->
            <div class="modal fade" id="mp-confirmmodal" tabindex="-1" role="dialog" aria-labelledby="mp-cm-label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mp-cm-label">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <displayiv class="modal-body" id="mp-cm-body" style="display: flex; justify-content: center; align-items: center;">
                                <h2>Are you sure?</h2>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="mp-cm-confirm"><a></a>Yes</button>
                                <button class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- BASA!!!: Modal for Customizing and Adding a Package -->
            <div class="modal fade" id="mp-inputmodal" tabindex="-1" role="dialog" aria-labelledby="mp-im-label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mp-im-label"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="mp-im-body">
                            <div class="form-group">
                                <label for="">Package Name:</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="">Duration (Minutes):</label>
                                <input type="text" class="form-control" id="duration" name="duration">
                            </div>
                            <div class="form-group">
                                <label for="">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="mp-im-confirm" class="btn btn-primary">Create</button>
                            <button class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="datatables/datatables.min.js"></script>
            <script src="js/managepackages.js"></script>
            <script src="js/sweetalert2.all.min.js"></script>
            <script src="js/accounting.js"></script>
            <script>
                function maskNum(elem, value){
                  var inputElement = elem;
                  inputElement.value = accounting.formatNumber(value, 2);
                }
                
                function unmaskNum(elem, value){
                    var inputElement = elem;
                    inputElement.value = accounting.unformat(value);
                }
            </script>
</body>
</html>