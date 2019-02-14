<?php
	//$conn = new mysqli('sql12.freemysqlhosting.net', 'sql12269676', 'UbXElwAKFq', 'sql12269676');
	// $conn = new mysqli('mysql5015.site4now.net', 'a45323_golive', 'golive123', 'db_a45323_golive');
	// $conn = new mysqli('localhost', 'root', '', 'golive');
	$conn = new mysqli('148.72.232.181', 'admin2019', 'KB!epe_2tAk::9r', 'GoLiveStreaming');

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
?>