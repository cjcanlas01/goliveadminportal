<?php
	require_once '../vendor/autoload.php';
	include('server.php');
	include('methodcontainer.php');
	include('php-mail/mail-component.php');

	if(isset($_POST['accountaction'])) {
		$switch = $_POST['accountaction'];
		switch ($switch) {
			case 'approve':
				$email = $_POST['payload']['email'];
				$result = $conn->query("SELECT Id, PhoneNumberConfirmed, EmailConfirmed, BusinessName, PhoneNumber FROM Users WHERE Email = '$email'");
				if(mysqli_num_rows($result) == 1) {
					while($row = $result->fetch_assoc()) {
						if ($row['PhoneNumberConfirmed'] == 1) {
							date_default_timezone_set('Asia/Manila');
							$gen_date = date("Y-m-d h:i:s");
							$businessname = mysqli_real_escape_string($conn, $row['BusinessName']);;
							$userpackagemappingsid = str_replace("-", "", $row['Id']);
							$arr_query[0] = $conn->query("UPDATE Users SET EmailConfirmed = '1', DateCreated = '$gen_date' WHERE Email = '$email'");
							$connection[0] = mysqli_error($conn);
							$arr_query[1] = $conn->query("INSERT INTO UserPackageMappings (Email, TimeRemaining, Views, TotalTime) VALUES ('$email', '0', '0', '0')");
							$connection[1] = mysqli_error($conn);
							$arr_query[2] = $conn->query("INSERT INTO SessionRooms (SessionRoomID, Email, Status, Title, Category, Description, Time, Date, ProfilePicture, BusinessName, CurrentViewers) VALUES ('$userpackagemappingsid', '$email', '0', '', '', '', '$gen_date', '$gen_date', null, '$businessname', '0')");
							$connection[2] = mysqli_error($conn);
							//online nexmo sms api, building query
							$url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
							    'api_key' => 'ee29ec52',
							    'api_secret' => 'Zfwuh7AFQLDzxEYb',
							    'to' => $row['PhoneNumber'],
							    'from' => 'GoLive',
							    'text' => 'Your GoLive account has been confirmed! Watch and enjoy! (Sent By: GoLive)'
							]);
							//end
							//trigger link to execute the sms nexmo api
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $url); 
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
							$result = curl_exec ($ch); 
							curl_close ($ch);
							//end
							$arr_query[3] = $result;
							$arr_query[4] = email_handler($email, 'GoLive: Account Confirmation', confirm_email());
							$response['msg_a'] = 'User request approved successfully.';
							$response['msg_b'] = 'User request approved unsuccessfully.';
							msg_response($arr_query, $response, $connection);
							
						}
					}
				}
				break;

			case 'delete':
				$emailadd = $_POST['payload']['email'];
				$arr_query[0]  = $conn->query("DELETE FROM Users WHERE Email = '$emailadd'");
				$connection[0] = mysqli_error($conn);
				$response['msg_a'] = 'User request deleted successfully.';
				$response['msg_b'] = 'User request deleted unsuccessfully.';
				msg_response($arr_query, $response, $connection);
				break;

			case 'addadmin':
				$emailadd = $_POST['payload']['email'];
				$password = $_POST['payload']['password'];
				$unique_id = date('m-d-y-h-i-s'); //for unique id of admin account - to be revised.
				$arr_query[0]  = $conn->query("INSERT INTO Users (Id, Email, EmailConfirmed, BusinessName, Address, ProfilePicture, Role, SMSCode, PasswordHash, SecurityStamp, PhoneNumber, PhoneNumberConfirmed, TwoFactorEnabled, LockoutEndDateUtc, LockoutEnabled, AccessFailedCount, UserName, Description, Passcode) VALUES ('$unique_id', '$emailadd',  1,  NULL,  NULL,  NULL,  'admin',  NULL, NULL,  NULL, NULL, 1, 0, NULL, 0, 0, '$emailadd', '', '$password')");
				$connection[0] = mysqli_error($conn);
				$response['msg_a'] = 'Admin account creation successful.';
				$response['msg_b'] = 'Admin account creation unsuccessful.';
				msg_response($arr_query, $response, $connection);
				break;

			case 'updateadmin':
				$emailadd = $_POST['payload']['email'];
				$password = $_POST['payload']['password'];
				$arr_query[0]  = $conn->query("UPDATE Users SET Passcode = '$password' WHERE Email = '$emailadd'");
				$connection[0] = mysqli_error($conn);
				$response['msg_a'] = 'Admin account update successful.';
				$response['msg_b'] = 'Admin account update unsuccessful.';
				msg_response($arr_query, $response, $connection);
				break;

			case 'deleteadmin':
				$emailadd = $_POST['payload']['email'];
				$arr_query[0]  = $conn->query("DELETE FROM Users WHERE Email = '$emailadd'");
				$connection[0] = mysqli_error($conn);
				$response['msg_a'] = 'Admin account deletion successful.';
				$response['msg_b'] = 'Admin account deletion unsuccessful.';
				msg_response($arr_query, $response, $connection);
				break;
		}
	}

	//for data retrieveal for datatables
	if (isset($_POST['action']) == 'loaddata') {
		datacontainer("SELECT Email, BusinessName, Address, PhoneNumber, DATE(DateCreated) As DC FROM Users WHERE PhoneNumberConfirmed = '1' AND EmailConfirmed = '0' AND Role = 'user'", "useracc", "false");
		datacontainer("SELECT Email, Passcode FROM Users WHERE Role = 'admin'", "adminacc", "true");
	}
	//end
?>