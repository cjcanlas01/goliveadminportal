<?php
	require_once '../vendor/autoload.php';
	include('server.php');
	include('methodcontainer.php');
	include('php-mail/mail-component.php');
	
	if(isset($_POST['packageaction'])) {
		date_default_timezone_set('Asia/Manila'); //set timezone for ph
		$gen_date = date("Y-m-d h:i:s"); //get date in format = year month day hour minutes seconds

		$switch = $_POST['packageaction'];
		switch ($switch) {
			case 'approve':
				$id = $_POST['payload']['id'];
				$email = $_POST['payload']['email'];

				$result = $conn->query("SELECT RP.Email, RP.BusinessName, RP.Id, SR.Status, RP.PackageName, RP.Duration, RP.Price, RP.VoucherNumber, UPM.TimeRemaining FROM RequestPackageRegistries as RP INNER JOIN UserPackageMappings AS UPM ON RP.Email=UPM.Email INNER JOIN SessionRooms as SR ON RP.Email=SR.Email WHERE RP.Id = '$id'");

				if (mysqli_num_rows($result) == 1) {
					while($row = $result->fetch_assoc()) {
			        	if($row['Status'] == 0) { //0 means the user is not currently streaming

							$bname = mysqli_real_escape_string($conn, $row['BusinessName']);
							$packagename = $row['PackageName'];
							$duration = $row['Duration'];
							$price = $row['Price'];
							$vouchernumber = $row['VoucherNumber'];

			        		$time = (int) $row['TimeRemaining'] + (int) $row['Duration']; // computation for adding the approved top up requests

			        		$arr_query[0] = $conn->query("UPDATE UserPackageMappings SET TimeRemaining = '$time' WHERE Email = '$email'");
			        		$connection[0] = mysqli_error($conn);
			        		$arr_query[1] = $conn->query("INSERT INTO RecordRequestRegistries (Email, BusinessName, PackageName, Duration, Price, Time, Date, VoucherNumber) VALUES ('$email', '$bname', '$packagename', '$duration', '$price', '$gen_date', '$gen_date', '$vouchernumber')");
			        		$connection[1] = mysqli_error($conn);
			        		$arr_query[2]  = $conn->query("DELETE FROM RequestPackageRegistries WHERE Id = '$id'");
			        		$connection[2] = mysqli_error($conn);

			        		$order_sum = [$packagename, $duration, $price];

			        		$arr_query[3] = email_handler($email, 'GoLive: Order Summary', receipt_mail($order_sum));

			        		$response['msg_a'] = 'Request approval successful.';
			        		$response['msg_b'] = 'Request approval unsuccessful.';
			        		msg_response($arr_query, $response, $connection);
			        	}
					}
				}
				break;

			case 'delete':
				$id = $_POST['payload']['id'];

				$arr_query[0] = $conn->query("DELETE FROM RequestPackageRegistries WHERE Id = '$id'");

        		$connection[0] = mysqli_error($conn);

        		$response['msg_a'] = 'Package deleted successfully.';
        		$response['msg_b'] = 'Package deleted unsuccessfully.';
			    msg_response($arr_query, $response, $connection);
				break;

			case 'addpackage':
				$name = $_POST['payload']['name'];
				$price = $_POST['payload']['price'];
				$duration = $_POST['payload']['duration'];

				$arr_query[0] = $conn->query("INSERT INTO PackageTypes (PackageName, Duration, Price, Time, Date) VALUES ('$name', '$duration', '$price', '$gen_date', '$gen_date')");
        		$connection[0] = mysqli_error($conn);

        		$response['msg_a'] = 'Package addition successful.';
        		$response['msg_b'] = 'Package addition unsuccessful.';
			    msg_response($arr_query, $response, $connection);
				break;

			case 'updatepackage':
				$name = $_POST['payload']['name'];
				$price = $_POST['payload']['price'];
				$duration = $_POST['payload']['duration'];

				$arr_query[0] = $conn->query("UPDATE PackageTypes SET Duration = '$duration', Price = '$price' WHERE PackageName = '$name'");
				$connection[0] = mysqli_error($conn);

        		$response['msg_a'] = 'Package update successful.';
        		$response['msg_b'] = 'Package update unsuccessful.';
			    msg_response($arr_query, $response, $connection);
				break;

			case 'deletepackage':
				$name = $_POST['payload']['name'];

				$arr_query[0] = $conn->query("DELETE FROM PackageTypes WHERE PackageName = '$name'");
				$connection[0] = mysqli_error($conn);

        		$response['msg_a'] = 'Package deletion successful.';
        		$response['msg_b'] = 'Package deletion unsuccessful.';
			    msg_response($arr_query, $response, $connection);
				break;
		}
	}
	
	if (isset($_POST['action']) == 'loaddata') {
		datacontainer("SELECT Email, BusinessName, PackageName, Duration, Price, Id FROM RequestPackageRegistries", "requests", "false");
		datacontainer("SELECT PackageName, Price, Duration FROM PackageTypes", "packages", "true");
	}

?>