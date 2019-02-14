<?php
	include('server.php');
	session_start();

	if(isset($_POST['UserName'])) {

		$response = array();
		$username = $_POST['UserName'];
		$password = $_POST['Passcode'];

		$result = $conn->query("SELECT * FROM Users WHERE Role = 'admin' AND Email = '$username' AND Passcode = '$password'");

		if (mysqli_num_rows($result) == 1) {
			while($row = $result->fetch_assoc()) {
				$_SESSION['account_record'] = $row['Email'];
			}	
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;

			$response['indicator'] = true;
			$response['msg'] = 'Log-in successful!';
		} else {
			$response['indicator'] = false;
			$response['msg'] = 'Log-in unsuccessful! Please try again.';
		}

		echo json_encode($response);
		$conn->close();
	}
	
?>