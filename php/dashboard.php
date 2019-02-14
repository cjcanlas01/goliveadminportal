<?php
include('server.php');
$res = array();

if(isset($_POST['action'])) {
	$action = $_POST['action'];
	switch($action) {
		case 'data_count':
			datacontainer('uc', "SELECT COUNT(Id) as uc_id FROM Users", false); //user count
			datacontainer('pc', "SELECT COUNT(PackageName) as pc_pc FROM PackageTypes", false); //package count
			datacontainer('vsc', "SELECT COUNT(Email) as vsc_e FROM UserVideoMappings", false); //video saved count
			datacontainer('rc', "SELECT COUNT(Id) as rc_id FROM RequestPackageRegistries", true); //requestcount
		break;

		case 'line_chart':
			datacontainer_linechart();
		break;
	}
}

function datacontainer($index, $query, $condition) {
	global $conn; global $res;
	$query = $conn->query($query);
	while($row = $query->fetch_assoc()){
		$res[$index] = $row;
	}
	if ($condition == true) { echo json_encode($res); }
} 

function datacontainer_linechart() {
	global $conn; $cur_year = date("Y"); $arr_output = array();
	date_default_timezone_set('Asia/Manila'); $x = 0; $res = 0;
	for($i=1; $i<=12; $i++) { //loop for 12 times

		$query = $conn->query("SELECT COUNT(Id) as c FROM Users WHERE YEAR(DateCreated) = '$cur_year' AND MONTH(DateCreated) = '$i';");
		while($row = $query->fetch_assoc()){
			$res = $res + (int) $row['c']; //get count
		}

		if($i==3 || $i==6 || $i==9 || $i==12) { //separate every computed count every quarter (3 months)
			$arr_output[$x] = $res; //insert into final array
			$x++; $res = 0;
		}
	}
	$arr_output['year'] = $cur_year;
	echo json_encode($arr_output);		
}

?>