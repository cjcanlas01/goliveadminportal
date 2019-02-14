<?php 
	include('server.php'); //file where the connection for the db is in

	global $conn; //global variable for the connection in the server.php file
	$arrUsers = array(); //array storage for storing query data
	$query = "SELECT Email FROM Users WHERE EmailConfirmed = '1' AND PhoneNumberConfirmed = '1' AND Role <> 'admin'"; //query

	$result = $conn->query($query); //execute query
	if(mysqli_num_rows($result) > 0) { //check if the executed query returns data
		while($row = $result->fetch_assoc()) { //get all data
			$arrUsers[] = $row; //store the data in this array variable
		}
	}

	$arrUsersData = array(); 

	if(isset($_POST['Subs'])) {
		$varSwitch = $_POST['Subs'];
		$varstDate = $_POST['stDate'];
		$varenDate = $_POST['enDate'];
		switch($varSwitch) {
			case 'SUBSCRIPTIONS':
				$finalUsersList = processSubsRank($arrUsers, $varstDate, $varenDate);
				echo json_encode(array_slice($finalUsersList, 0, 5));
				break;
			case 'VIEWERS':
				$finalUsersList = proccessViewsRank($arrUsers, $varstDate, $varenDate);
				echo json_encode(array_slice($finalUsersList, 0, 5));
				break;
			case 'RATINGS':
				$finalUsersList = proccessRatesRank($arrUsers, $varstDate, $varenDate);
				echo json_encode(array_slice($finalUsersList, 0, 5));
				break;
		}
	}

	function processSubsRank($dataUsers, $dateA, $dateB) { //function for proccessing ranks
		global $conn;
		for($i=0; $i<sizeof($dataUsers); $i++) {
			$emailSelect =  json_encode($dataUsers[$i]['Email']);
			$query = "SELECT EmailSubscriber AS User, COUNT(EmailSubscriber) AS C FROM Subscriptions WHERE DATE(Date) BETWEEN '$dateA' AND '$dateB' AND EmailSubscriber = $emailSelect"; //query
			// echo $query;
			$result = $conn->query($query); //execute query
			if(mysqli_num_rows($result) > 0) { //check if the executed query returns data
				while($row = $result->fetch_assoc()) { //get all data
					$arrUsersData[$i]['User'] = $row['User']; //store the data in this array 
					$arrUsersData[$i]['Count'] = $row['C']; //store the data in this array variable
				}
			}
		}
		// echo print_r($arrUsersData);
		return array_sort($arrUsersData, 'Count', SORT_DESC);
	}

	function proccessViewsRank($dataUsers, $dateA, $dateB) {
		global $conn; $computeVal = 0; global $arrUsersData;
		for($i=0; $i<sizeof($dataUsers); $i++) {
			$emailSelect =  json_encode($dataUsers[$i]['Email']);

			$query = "SELECT Email AS User, Views AS V FROM UserVideoMappings WHERE DATE(Date) BETWEEN '$dateA' AND '$dateB' AND Email = $emailSelect"; //query
			$result = $conn->query($query); //execute query
			if(mysqli_num_rows($result) > 0) { //check if the executed query returns data
				while($row = $result->fetch_assoc()) { //get all data
					$arrUsersData[$i]['User'] = $row['User']; //store the data in this array 
					$computeVal = $computeVal + (int) $row['V'];
					$arrUsersData[$i]['Count'] = $computeVal; //store the data in this array variable
				}
			}
		}
		// echo print_r($arrUsersData);
		return array_sort($arrUsersData, 'Count', SORT_DESC);
	}

	function proccessRatesRank($dataUsers, $dateA, $dateB) {
		global $conn; $computeVal = 0; $valDivider = 0; global $arrUsersData;
		for($i=0; $i<sizeof($dataUsers); $i++) {
			$emailSelect =  json_encode($dataUsers[$i]['Email']);
			$query = "SELECT EmailRatee AS User, RateValue AS V FROM Ratings WHERE DATE(Date) BETWEEN '$dateA' AND '$dateB' AND  EmailRatee = $emailSelect"; //query
			// echo $query;
			$result = $conn->query($query); //execute query
			if(mysqli_num_rows($result) > 0) { //check if the executed query returns data
				while($row = $result->fetch_assoc()) { //get all data
					$arrUsersData[$i]['User'] = $row['User']; //store the data in this array 
					$computeVal = $computeVal + (int) $row['V']; //store the data in this array variable
					$valDivider++;
				}
			$finalVal = $computeVal / $valDivider;
			$arrUsersData[$i]['Count'] = $finalVal;	
			}
		}
		// echo print_r($arrUsersData);
		return array_sort($arrUsersData, 'Count', SORT_DESC);
	}

	function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}

?>